<?php
/**
 * send-contact.php
 *
 * Xử lý form liên hệ từ trang contact.php qua AJAX.
 * Gửi email bằng PHPMailer qua SMTP (Gmail).
 * Trả về JSON — giữ nguyên API để contact.js không cần sửa.
 *
 * Yêu cầu: Composer + PHPMailer + .env đã cấu hình.
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

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
    // TODO DEBUG: xóa debug này sau khi fix xong
    $debug = [
        'session_id'   => session_id() ?: 'NONE',
        'session_keys' => isset($_SESSION) ? implode(', ', array_keys($_SESSION)) : 'SESSION_NOT_SET',
        'cookie_exists' => isset($_COOKIE[session_name()]) ? 'YES' : 'NO',
        'post_token_len' => strlen($csrfToken),
        'sess_token_set' => isset($_SESSION['csrf_token']) ? 'YES' : 'NO',
        'sess_expires' => $_SESSION['csrf_expires'] ?? 'NOT_SET',
        'time_now' => time(),
        'php_session_path' => session_save_path(),
    ];
    error_log('[CSRF DEBUG] ' . json_encode($debug));

    http_response_code(403);
    echo json_encode([
        'success' => false,
        'message' => 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại. / Session expired. Please reload and try again.',
        // TODO DEBUG: xóa dòng debug này sau khi fix xong
        '_debug' => $debug,
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
// 6. KIỂM TRA CẤU HÌNH SMTP
// ══════════════════════════════════════════════════════════════
$mailConfig = mail_config();

if (empty($mailConfig['host']) || empty($mailConfig['username']) || empty($mailConfig['from_address'])) {
    // Fallback: lưu log nếu chưa cấu hình SMTP
    write_contact_log($name, $email, $phone, $department, $message, $userLang);
    error_log('[The Green Life] SMTP not configured — contact saved to log file.');

    http_response_code(200);
    echo json_encode([
        'success' => true,
        'message' => 'Cảm ơn bạn! Tin nhắn đã được ghi nhận. / Thank you! Your message has been recorded.',
    ]);
    exit;
}

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

// ══════════════════════════════════════════════════════════════
// 7. GỬI EMAIL CHO ADMIN (HTML + Plain Text)
// ══════════════════════════════════════════════════════════════
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = $mailConfig['host'];
    $mail->Port       = (int) $mailConfig['port'];
    $mail->SMTPSecure = $mailConfig['encryption'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailConfig['username'];
    $mail->Password   = $mailConfig['password'];
    $mail->CharSet    = PHPMailer::CHARSET_UTF8;
    $mail->Timeout    = 30;

    // Người gửi: địa chỉ website (KHÔNG phải email người dùng)
    $mail->setFrom($mailConfig['from_address'], $mailConfig['from_name']);

    // Reply-To: email người dùng (để admin có thể reply trực tiếp)
    $mail->addReplyTo($email, $name);

    // Người nhận
    $toAddress = $mailConfig['to_address'] ?: $mailConfig['from_address'];
    $mail->addAddress($toAddress, $mailConfig['from_name']);

    // Tiêu đề
    $mail->Subject = sprintf('[The Green Life] Liên hệ mới từ %s — %s', $name, $deptLabel);

    // Nội dung HTML
    $mail->Body = email_template_admin_html($emailData);

    // Plain text fallback
    $mail->AltBody = email_template_admin_plain($emailData);

    $mail->send();

    error_log('[The Green Life] Contact email sent successfully to admin.');

} catch (PHPMailerException $e) {
    // Lỗi gửi email → trả lỗi THẬT cho user + ghi fallback log
    error_log('[The Green Life] PHPMailer error: ' . $e->getMessage());
    write_contact_log($name, $email, $phone, $department, $message, $userLang);

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Không thể gửi tin nhắn lúc này. Vui lòng thử lại sau ít phút. / Unable to send right now. Please try again in a few minutes.',
    ]);
    exit;
} catch (\Exception $e) {
    error_log('[The Green Life] Unexpected error: ' . $e->getMessage());
    write_contact_log($name, $email, $phone, $department, $message, $userLang);

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Không thể gửi tin nhắn lúc này. Vui lòng thử lại sau ít phút. / Unable to send right now. Please try again in a few minutes.',
    ]);
    exit;
}

// ══════════════════════════════════════════════════════════════
// 8. GỬI EMAIL XÁC NHẬN CHO KHÁCH HÀNG (Auto-reply)
// ══════════════════════════════════════════════════════════════
// Chạy trong try-catch riêng — nếu fail vẫn trả success cho user
try {
    $replyMail = new PHPMailer(true);

    $replyMail->isSMTP();
    $replyMail->Host       = $mailConfig['host'];
    $replyMail->Port       = (int) $mailConfig['port'];
    $replyMail->SMTPSecure = $mailConfig['encryption'];
    $replyMail->SMTPAuth   = true;
    $replyMail->Username   = $mailConfig['username'];
    $replyMail->Password   = $mailConfig['password'];
    $replyMail->CharSet    = PHPMailer::CHARSET_UTF8;
    $replyMail->Timeout    = 15;

    $replyMail->setFrom($mailConfig['from_address'], $mailConfig['from_name']);
    $replyMail->addAddress($email, $name);

    $replyMail->Subject = $userLang === 'vi'
        ? 'The Green Life — Đã nhận được tin nhắn của bạn'
        : 'The Green Life — We received your message';

    $replyMail->Body    = email_template_reply_html($emailData);
    $replyMail->AltBody = email_template_reply_plain($emailData);

    $replyMail->send();
    error_log("[The Green Life] Auto-reply sent to: {$email}");
} catch (\Exception $e) {
    // Auto-reply fail không ảnh hưởng đến kết quả chính
    error_log('[The Green Life] Auto-reply failed: ' . $e->getMessage());
}

// ══════════════════════════════════════════════════════════════
// 9. THÀNH CÔNG
// ══════════════════════════════════════════════════════════════
echo json_encode([
    'success' => true,
    'message' => 'Cảm ơn bạn! Tin nhắn đã được gửi thành công. Chúng tôi sẽ phản hồi trong 24 giờ. / Thank you! We will respond within 24 hours.',
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
