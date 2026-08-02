<?php
/**
 * send-contact.php
 *
 * Xử lý gửi form liên hệ:
 *  - Validate CSRF token
 *  - Kiểm tra honeypot (chống bot)
 *  - Sanitize dữ liệu
 *  - Gửi email qua SMTP (Gmail) hoặc fallback mail()
 *  - Ghi log chi tiết để debug trên hosting
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

// ── Hàm ghi log debug ─────────────────────────────────────
function contact_log(string $message, string $level = 'INFO'): void
{
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    $logEntry = sprintf(
        "[%s] [%s] %s\n",
        date('Y-m-d H:i:s'),
        $level,
        $message
    );
    @file_put_contents($logDir . '/debug-' . date('Y-m-d') . '.log', $logEntry, FILE_APPEND | LOCK_EX);
}

// ── Chỉ chấp nhận POST ────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit(json_encode(['status' => 'error', 'message' => 'Yêu cầu không hợp lệ.']));
}

// ── Honeypot: nếu field "website" có giá trị → chặn (bot) ──
if (!empty($_POST['website'])) {
    contact_log('Honeypot triggered - bot detected', 'BLOCK');
    http_response_code(200);
    exit(json_encode(['status' => 'success', 'message' => 'Gửi thành công!']));
}

// ── Validate CSRF Token ────────────────────────────────────
$csrfToken = $_POST['csrf_token'] ?? '';
if (!csrf_validate($csrfToken)) {
    contact_log('CSRF validation failed', 'BLOCK');
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

// ── Log thông tin môi trường (chỉ log lần đầu) ────────────
contact_log(sprintf(
    'Environment: PHP=%s | OS=%s | SSL=%s | Host=%s',
    PHP_VERSION,
    PHP_OS,
    extension_loaded('openssl') ? 'yes' : 'no',
    $_SERVER['HTTP_HOST'] ?? 'unknown'
));

// ── Gửi Email ──────────────────────────────────────────────
// Strategy: Ưu tiên PHP mail() (nhanh, không bị chặn), SMTP là fallback
$mailSent = false;
$errorDetail = '';
$mailConfig = require __DIR__ . '/config/mail.php';

// ── Phương án A: PHP mail() (chính) ────────────────────
contact_log('Attempting PHP mail() to ' . implode(', ', $mailConfig['to_emails']));

$to      = implode(', ', $mailConfig['to_emails']);
$subject = "=?UTF-8?B?" . base64_encode("Liên hệ từ: {$name}") . "?=";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "From: =?UTF-8?B?" . base64_encode($mailConfig['from_name']) . "?= <{$mailConfig['from_email']}>\r\n";
$headers .= "Reply-To: {$emailSafe}\r\n";
$headers .= "X-Mailer: PHP/" . PHP_VERSION;

$body = "
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

$mailSent = @mail($to, $subject, $body, $headers);
if ($mailSent) {
    contact_log('PHP mail() sent successfully');
} else {
    $errorDetail = error_get_last()['message'] ?? 'mail() returned false';
    contact_log('PHP mail() failed: ' . $errorDetail, 'WARN');

    // ── Phương án B: SMTP qua PHPMailer (fallback) ──────
    $canUseSMTP = extension_loaded('openssl') && function_exists('fsockopen');
    
    if ($canUseSMTP && class_exists('PHPMailer\PHPMailer\PHPMailer')) {
        try {
            contact_log('Falling back to SMTP via ' . $mailConfig['smtp_host'] . ':' . $mailConfig['smtp_port']);

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = $mailConfig['smtp_host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $mailConfig['smtp_user'];
            $mail->Password   = $mailConfig['smtp_pass'];
            $mail->Port       = $mailConfig['smtp_port'];
            $mail->CharSet    = 'UTF-8';
            $mail->Timeout    = 5; // Timeout ngắn vì đây là fallback

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ];

            if (!empty($mailConfig['smtp_encrypt'])) {
                $mail->SMTPSecure = $mailConfig['smtp_encrypt'];
            }

            $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
            foreach ($mailConfig['to_emails'] as $recipient) {
                $mail->addAddress($recipient);
            }

            $mail->isHTML(true);
            $mail->Subject = "=?UTF-8?B?" . base64_encode("Liên hệ từ: {$name}") . "?=";
            $mail->Body    = $body;
            $mail->AltBody = strip_tags(str_replace(['<br>', '<br/>', '<br />'], "\n", $body));

            $mail->send();
            $mailSent = true;
            contact_log('SMTP fallback sent successfully');

        } catch (Exception $e) {
            $errorDetail = $e->getMessage();
            contact_log('SMTP fallback also failed: ' . $errorDetail, 'ERROR');
        }
    } else {
        contact_log('SMTP fallback unavailable (openssl=' . (extension_loaded('openssl') ? 'yes' : 'no') . ')', 'WARN');
    }
}

// ── Ghi log liên hệ ────────────────────────────────────────
$logDir = __DIR__ . '/logs';
if (!is_dir($logDir)) {
    @mkdir($logDir, 0755, true);
}

$logEntry = sprintf(
    "[%s] Lang: %s | From: %s <%s>, Phone: %s, Dept: %s | Sent: %s\nMessage: %s\n---\n",
    date('Y-m-d H:i:s'),
    $lang,
    $name,
    $email,
    $phone,
    ($department ?: 'Không chọn'),
    $mailSent ? 'YES' : 'NO',
    $message
);

@file_put_contents($logDir . '/contact-' . date('Y-m-d') . '.log', $logEntry, FILE_APPEND | LOCK_EX);

// ── Trả về kết quả ────────────────────────────────────────
if ($mailSent) {
    echo json_encode(['status' => 'success', 'message' => 'Gửi thành công! Chúng tôi sẽ phản hồi sớm nhất.']);
} else {
    http_response_code(500);
    // Trả về lỗi chi tiết để debug (CHỈ trên môi trường dev)
    $debugMsg = '';
    if ($errorDetail) {
        // Ghi log lỗi nhưng KHÔNG hiển thị chi tiết cho user
        error_log('[Contact Form] Lỗi gửi mail: ' . $errorDetail);
        // Trên hosting free, thường do chặn port SMTP hoặc DNS
        if (stripos($errorDetail, 'Connection timed out') !== false ||
            stripos($errorDetail, 'Connection refused') !== false ||
            stripos($errorDetail, 'Network is unreachable') !== false ||
            stripos($errorDetail, 'php_network_getaddresses') !== false) {
            $debugMsg = ' [Hosting chặn kết nối SMTP/DNS]';
        }
    }
    echo json_encode([
        'status'  => 'error',
        'message' => 'Không thể gửi email. Vui lòng thử lại sau hoặc liên hệ qua số điện thoại.' . $debugMsg,
    ]);
}