<?php
/**
 * send-contact.php
 *
 * Xử lý gửi form liên hệ:
 *  - Validate CSRF token
 *  - Kiểm tra honeypot (chống bot)
 *  - Sanitize dữ liệu
 *  - Gửi email qua SMTP (Mailtrap)
 *  - Ghi log để xem lại trong admin
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/autoload.php';

// ── Khởi tạo session (bắt buộc cho CSRF) ──────────────────
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/includes/csrf.php';

header('Content-Type: application/json; charset=utf-8');

// ── Chỉ chấp nhận POST ────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']));
}

// ── Honeypot: nếu field "website" có giá trị → chặn (bot) ──
if (!empty($_POST['website'])) {
    // Trả về success giả để bot không biết đã bị chặn
    http_response_code(200);
    exit(json_encode(['status' => 'success', 'message' => 'Gửi thành công!']));
}

// ── Validate CSRF Token ────────────────────────────────────
$csrfToken = $_POST['csrf_token'] ?? '';
if (!csrf_validate($csrfToken)) {
    http_response_code(403);
    exit(json_encode(['status' => 'error', 'message' => 'Phiên làm việc hết hạn. Vui lòng tải lại trang và thử lại.']));
}

// ── Lấy & sanitize dữ liệu ─────────────────────────────────
$name       = trim($_POST['name']       ?? '');
$email      = trim($_POST['email']      ?? '');
$phone      = trim($_POST['phone']      ?? '');
$department = trim($_POST['department'] ?? '');
$message    = trim($_POST['message']    ?? '');
$lang       = trim($_POST['lang']       ?? 'vi');

// Validate bắt buộc
$errors = [];
if ($name === '') {
    $errors[] = 'Vui lòng nhập họ tên.';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Vui lòng nhập email hợp lệ.';
}
if ($phone === '') {
    $errors[] = 'Vui lòng nhập số điện thoại.';
}
if ($message === '') {
    $errors[] = 'Vui lòng nhập lời nhắn.';
}

if (!empty($errors)) {
    http_response_code(422);
    exit(json_encode(['status' => 'error', 'message' => implode(' ', $errors)]));
}

// Sanitize cho HTML email
$nameSafe       = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$emailSafe      = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$phoneSafe      = htmlspecialchars($phone, ENT_QUOTES, 'UTF-8');
$departmentSafe = htmlspecialchars($department, ENT_QUOTES, 'UTF-8');
$messageSafe    = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

// ── Gửi Email ──────────────────────────────────────────────
try {
    $mailConfig = require __DIR__ . '/config/mail.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = $mailConfig['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailConfig['smtp_user'];
    $mail->Password   = $mailConfig['smtp_pass'];
    $mail->Port       = $mailConfig['smtp_port'];
    $mail->CharSet    = 'UTF-8';

    if (!empty($mailConfig['smtp_encrypt'])) {
        $mail->SMTPSecure = $mailConfig['smtp_encrypt'];
    }

    // Người gửi
    $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);

    // Người nhận
    foreach ($mailConfig['to_emails'] as $recipient) {
        $mail->addAddress($recipient);
    }

    // Nội dung
    $mail->isHTML(true);
    $mail->Subject = "Liên hệ từ: {$nameSafe}";
    $mail->Body    = "
        <h3>Thông tin liên hệ mới:</h3>
        <table style='border-collapse:collapse;width:100%;'>
            <tr><td style='padding:6px 12px;font-weight:bold;'>Họ tên:</td><td>{$nameSafe}</td></tr>
            <tr><td style='padding:6px 12px;font-weight:bold;'>Email:</td><td><a href='mailto:{$emailSafe}'>{$emailSafe}</a></td></tr>
            <tr><td style='padding:6px 12px;font-weight:bold;'>SĐT:</td><td><a href='tel:{$phoneSafe}'>{$phoneSafe}</a></td></tr>
            <tr><td style='padding:6px 12px;font-weight:bold;'>Bộ phận:</td><td>{$departmentSafe}</td></tr>
            <tr><td style='padding:6px 12px;font-weight:bold;'>Ngôn ngữ:</td><td>" . strtoupper($lang) . "</td></tr>
        </table>
        <hr>
        <p><b>Lời nhắn:</b></p>
        <p>{$messageSafe}</p>
    ";

    $mail->send();

    // ── Ghi log ────────────────────────────────────────────
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $logEntry = sprintf(
        "[%s] Lang: %s | From: %s <%s>, Phone: %s, Dept: %s\nMessage: %s\n---\n",
        date('Y-m-d H:i:s'),
        $lang,
        $name,
        $email,
        $phone,
        ($department ?: 'Không chọn'),
        $message
    );

    $logFile = $logDir . '/contact-' . date('Y-m-d') . '.log';
    file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

    echo json_encode(['status' => 'success', 'message' => 'Gửi thành công! Chúng tôi sẽ phản hồi sớm nhất.']);

} catch (Exception $e) {
    http_response_code(500);
    error_log('[Contact Form] Lỗi gửi mail: ' . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Lỗi hệ thống. Vui lòng thử lại sau.']);
}