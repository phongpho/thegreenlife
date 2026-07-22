<?php
/**
 * send-contact.php
 *
 * Xử lý form liên hệ từ trang contact.php qua AJAX.
 * Gửi email qua Brevo API (HTTPS) — không bị Render free tier chặn.
 * Trả về JSON — giữ nguyên API để contact.js không cần sửa.
 *
 * Yêu cầu: Composer + Brevo API key trong .env hoặc env vars.
 *
 * Bảo mật:
 *   - CSRF token verification
 *   - Honeypot field chống bot
 *   - Rate limiting (60 giây / lần)
 *   - Input sanitize + validate
 */

declare(strict_types=1);

// ── Autoload ──────────────────────────────────────────────────
$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloadPath)) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server configuration error. Please contact administrator.',
    ]);
    exit;
}
require_once $autoloadPath;

// ── Includes ──────────────────────────────────────────────────
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/email-template.php';
require_once __DIR__ . '/includes/brevo-mailer.php';

// ── Chỉ chấp nhận POST ───────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed.']);
    exit;
}

// ══════════════════════════════════════════════════════════════
// 1. CSRF VERIFICATION
// ══════════════════════════════════════════════════════════════
$csrfToken = $_POST['csrf_token'] ?? '';
if (!csrf_verify($csrfToken)) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'message' => 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại. / Session expired. Please reload and try again.',
    ]);
    exit;
}

// ══════════════════════════════════════════════════════════════
// 2. HONEYPOT CHECK — chặn bot
// ══════════════════════════════════════════════════════════════
if (!empty($_POST['website'])) {
    // Bot đã điền field ẩn → từ chối âm thầm (giả vờ thành công)
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Cảm ơn bạn! Tin nhắn đã được gửi thành công. / Thank you! Your message has been sent successfully.',
    ]);
    exit;
}

// ══════════════════════════════════════════════════════════════
// 3. RATE LIMITING — tối đa 1 lần / 60 giây
// ══════════════════════════════════════════════════════════════
$now = time();
$lastSubmit = $_SESSION['contact_last_submit'] ?? 0;
if ($now - $lastSubmit < 60) {
    $wait = 60 - ($now - $lastSubmit);
    http_response_code(429);
    echo json_encode([
        'success' => false,
        'message' => "Vui lòng đợi {$wait} giây trước khi gửi lại. / Please wait {$wait} seconds.",
    ]);
    exit;
}
$_SESSION['contact_last_submit'] = $now;

// ══════════════════════════════════════════════════════════════
// 4. INPUT SANITIZE
// ══════════════════════════════════════════════════════════════
$rawName       = $_POST['name']       ?? '';
$rawPhone      = $_POST['phone']      ?? '';
$rawEmail      = $_POST['email']      ?? '';
$rawDepartment = $_POST['department'] ?? '';
$rawMessage    = $_POST['message']    ?? '';
$userLang      = $_POST['lang']       ?? 'vi';

// Xác thực ngôn ngữ
if (!in_array($userLang, ['vi', 'en'], true)) {
    $userLang = 'vi';
}

// Strip tags & trim
$name       = trim(strip_tags($rawName));
$phone      = trim(strip_tags($rawPhone));
$email      = trim(strip_tags($rawEmail));
$department = trim(strip_tags($rawDepartment));
$message    = trim(strip_tags($rawMessage));

// ══════════════════════════════════════════════════════════════
// 5. VALIDATE
// ══════════════════════════════════════════════════════════════
$errors = [];

if ($name === '') {
    $errors[] = 'Vui lòng nhập họ tên. / Please enter your name.';
} elseif (mb_strlen($name) > 100) {
    $errors[] = 'Họ tên không được vượt quá 100 ký tự. / Name must not exceed 100 characters.';
}

if ($phone === '') {
    $errors[] = 'Vui lòng nhập số điện thoại. / Please enter your phone number.';
} elseif (!preg_match('/^[0-9+\-\s()]{7,20}$/', $phone)) {
    $errors[] = 'Số điện thoại không hợp lệ. / Invalid phone number format.';
}

if ($email === '') {
    $errors[] = 'Vui lòng nhập email. / Please enter your email address.';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email không hợp lệ. / Please enter a valid email address.';
}

// Chống Email Header Injection
if (preg_match('/[\r\n]/', $email) || preg_match('/[\r\n]/', $name)) {
    $errors[] = 'Dữ liệu không hợp lệ. / Invalid input detected.';
}

if ($message === '') {
    $errors[] = 'Vui lòng nhập nội dung tin nhắn. / Please enter your message.';
} elseif (mb_strlen($message) > 5000) {
    $errors[] = 'Tin nhắn không được vượt quá 5000 ký tự. / Message must not exceed 5000 characters.';
}

// Validate department — whitelist
$allowedDepartments = ['business', 'import-export', 'procurement', 'support', ''];
if (!in_array($department, $allowedDepartments, true)) {
    $department = '';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => implode(' ', $errors),
    ]);
    exit;
}

// ══════════════════════════════════════════════════════════════
// 6. CHUẨN BỊ CẤU HÌNH + DỮ LIỆU EMAIL
// ══════════════════════════════════════════════════════════════
$mailConfig = mail_config();

// ── Map tên bộ phận ──────────────────────────────────────────
$deptLabels = [
    'business'      => 'Kinh doanh / Business',
    'import-export' => 'Xuất nhập khẩu / Import-Export',
    'procurement'   => 'Thu mua nguyên liệu / Procurement',
    'support'       => 'Hỗ trợ chung / General Support',
];
$deptLabel = $deptLabels[$department] ?? 'Không chọn / Not selected';

// ── Dữ liệu cho email template ───────────────────────────────
$emailData = [
    'name'       => $name,
    'phone'      => $phone,
    'email'      => $email,
    'dept_label' => $deptLabel,
    'message'    => $message,
    'time'       => date('d/m/Y H:i:s'),
    'lang'       => $userLang,
];

// ── Sender info (từ config) ──────────────────────────────────
$senderEmail = $mailConfig['from_address'] ?: 'noreply@thegreenlife.com';
$senderName  = $mailConfig['from_name']    ?: 'The Green Life';
$adminEmail  = $mailConfig['to_address']   ?: $senderEmail;

// ── Brevo config ─────────────────────────────────────────────
$brevoConfig = ['api_key' => $mailConfig['brevo_api_key']];

// ══════════════════════════════════════════════════════════════
// 7. GỬI EMAIL QUA BREVO API (HTTPS, không bị Render chặn)
// ══════════════════════════════════════════════════════════════
$emailSent = false;

if (!empty($brevoConfig['api_key'])) {
    // ── 7a. Gửi email cho Admin ──────────────────────────────
    $adminSubject = sprintf('[The Green Life] Liên hệ mới từ %s — %s', $name, $deptLabel);
    $result = brevo_send(
        $brevoConfig,
        ['email' => $senderEmail, 'name' => $senderName],
        ['email' => $adminEmail, 'name' => $senderName],
        $adminSubject,
        email_template_admin_html($emailData),
        email_template_admin_plain($emailData),
        ['email' => $email, 'name' => $name]  // Reply-To: email khách
    );

    if ($result['success']) {
        $emailSent = true;
        error_log('[The Green Life] Admin email sent via Brevo.');
    } else {
        error_log('[The Green Life] Brevo admin email failed: ' . $result['message']);
    }

    // ── 7b. Gửi email Auto-reply cho khách ───────────────────
    $replySubject = $userLang === 'vi'
        ? 'The Green Life — Đã nhận được tin nhắn của bạn'
        : 'The Green Life — We received your message';

    $replyResult = brevo_send(
        $brevoConfig,
        ['email' => $senderEmail, 'name' => $senderName],
        ['email' => $email, 'name' => $name],
        $replySubject,
        email_template_reply_html($emailData),
        email_template_reply_plain($emailData)
    );

    if ($replyResult['success']) {
        error_log("[The Green Life] Auto-reply sent via Brevo to: {$email}");
    } else {
        error_log('[The Green Life] Brevo auto-reply failed: ' . $replyResult['message']);
    }

} else {
    error_log('[The Green Life] BREVO_API_KEY not configured. Skipping email send.');
}

// ══════════════════════════════════════════════════════════════
// 8. FALLBACK: Nếu Brevo không gửi được → lưu log
// ══════════════════════════════════════════════════════════════
if (!$emailSent) {
    write_contact_log($name, $email, $phone, $department, $message, $userLang);
}

// ══════════════════════════════════════════════════════════════
// 9. THÀNH CÔNG (luôn trả success, đã có fallback log)
// ══════════════════════════════════════════════════════════════
echo json_encode([
    'success' => true,
    'message' => 'Cảm ơn bạn! Tin nhắn đã được gửi thành công. Chúng tôi sẽ phản hồi trong 24 giờ. / Thank you! Your message has been sent. We will respond within 24 hours.',
]);


// ══════════════════════════════════════════════════════════════
// HELPER: Ghi fallback log khi SMTP không hoạt động
// ══════════════════════════════════════════════════════════════

/**
 * Ghi dữ liệu form contact vào file log khi không gửi được email.
 */
function write_contact_log(
    string $name,
    string $email,
    string $phone,
    string $department,
    string $message,
    string $userLang
): void {
    $deptLabels = [
        'business'      => 'Kinh doanh / Business',
        'import-export' => 'Xuất nhập khẩu / Import-Export',
        'procurement'   => 'Thu mua nguyên liệu / Procurement',
        'support'       => 'Hỗ trợ chung / General Support',
    ];
    $deptLabel = $deptLabels[$department] ?? 'Không chọn / Not selected';

    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        if (!mkdir($logDir, 0755, true) && !is_dir($logDir)) {
            error_log('[The Green Life] Cannot create log directory: ' . $logDir);
            return;
        }
    }

    $logFile = $logDir . '/contact-' . date('Y-m-d') . '.log';
    $logEntry = sprintf(
        "[%s] Lang: %s | From: %s <%s>, Phone: %s, Dept: %s\nMessage: %s\n---\n",
        date('Y-m-d H:i:s'),
        $userLang,
        $name,
        $email,
        $phone,
        $deptLabel,
        $message
    );

    $result = file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);
    if ($result === false) {
        error_log('[The Green Life] Cannot write to log file: ' . $logFile);
    }
}
