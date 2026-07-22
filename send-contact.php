<?php
/**
 * send-contact.php
 *
 * Xử lý form liên hệ từ trang contact.php qua AJAX.
 * Gửi email bằng PHPMailer qua SMTP.
 * Trả về JSON — giữ nguyên API để contact.js không cần sửa.
 *
 * Yêu cầu: Composer + PHPMailer (chạy `composer install` trước).
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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

// ── Chỉ chấp nhận POST ───────────────────────────────────────
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.',
    ]);
    exit;
}

// ── Lấy & sanitize dữ liệu đầu vào ────────────────────────────
$rawName       = $_POST['name']       ?? '';
$rawPhone      = $_POST['phone']      ?? '';
$rawEmail      = $_POST['email']      ?? '';
$rawDepartment = $_POST['department'] ?? '';
$rawMessage    = $_POST['message']    ?? '';

// Strip tags & trim
$name       = trim(strip_tags($rawName));
$phone      = trim(strip_tags($rawPhone));
$email      = trim(strip_tags($rawEmail));
$department = trim(strip_tags($rawDepartment));
$message    = trim(strip_tags($rawMessage));

// ── Validate ──────────────────────────────────────────────────
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

// Chống Email Header Injection: chặn ký tự \r, \n trong email và name
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

// ── Nạp cấu hình SMTP ────────────────────────────────────────
$mailConfig = mail_config();

if (empty($mailConfig['host']) || empty($mailConfig['username']) || empty($mailConfig['from_address'])) {
    error_log('[The Green Life] SMTP configuration is incomplete. Check your .env file.');
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Không thể gửi tin nhắn lúc này. Vui lòng thử lại sau. / Unable to send your message right now. Please try again later.',
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

// ── Chuẩn bị PHPMailer ───────────────────────────────────────
$mail = new PHPMailer(true);

try {
    // SMTP
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

    // Reply-To: email người dùng
    $mail->addReplyTo($email, $name);

    // Người nhận
    $toAddress = $mailConfig['to_address'] ?: $mailConfig['from_address'];
    $mail->addAddress($toAddress, $mailConfig['from_name']);

    // Tiêu đề
    $mail->Subject = sprintf('[The Green Life] Liên hệ mới từ %s', $name);

    // Nội dung (plain text)
    $body = "=== THÔNG TIN LIÊN HỆ ===\n\n";
    $body .= "Họ tên       : {$name}\n";
    $body .= "Số điện thoại: {$phone}\n";
    $body .= "Email        : {$email}\n";
    $body .= "Bộ phận      : {$deptLabel}\n\n";
    $body .= "=== NỘI DUNG TIN NHẮN ===\n";
    $body .= $message . "\n\n";
    $body .= "---\n";
    $body .= "Email này được gửi tự động từ form liên hệ trên website The Green Life.\n";
    $body .= 'Thời gian: ' . date('d/m/Y H:i:s') . "\n";

    $mail->Body = $body;

    // Gửi
    $mail->send();

    // ── Thành công ────────────────────────────────────────────
    echo json_encode([
        'success' => true,
        'message' => 'Cảm ơn bạn! Tin nhắn đã được gửi thành công. / Thank you! Your message has been sent successfully.',
    ]);

} catch (PHPMailerException $e) {
    // Ghi log chi tiết cho admin — không trả về cho client
    error_log('[The Green Life] PHPMailer error: ' . $e->getMessage());

    // Fallback: ghi log ra file
    write_contact_log($name, $email, $phone, $deptLabel, $message);

    echo json_encode([
        'success' => true,
        'message' => 'Cảm ơn bạn! Tin nhắn đã được ghi nhận. / Thank you! Your message has been recorded.',
    ]);

} catch (\Exception $e) {
    error_log('[The Green Life] Unexpected error: ' . $e->getMessage());

    write_contact_log($name, $email, $phone, $deptLabel, $message);

    echo json_encode([
        'success' => true,
        'message' => 'Cảm ơn bạn! Tin nhắn đã được ghi nhận. / Thank you! Your message has been recorded.',
    ]);
}


// ══════════════════════════════════════════════════════════════
//  Helper functions
// ══════════════════════════════════════════════════════════════

/**
 * Ghi dữ liệu form contact vào file log khi không gửi được email.
 */
function write_contact_log(
    string $name,
    string $email,
    string $phone,
    string $deptLabel,
    string $message
): void {
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        if (!mkdir($logDir, 0755, true) && !is_dir($logDir)) {
            error_log('[The Green Life] Cannot create log directory: ' . $logDir);
            return;
        }
    }

    $logFile = $logDir . '/contact-' . date('Y-m-d') . '.log';
    $logEntry = sprintf(
        "[%s] From: %s <%s>, Phone: %s, Dept: %s\nMessage: %s\n---\n",
        date('Y-m-d H:i:s'),
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
