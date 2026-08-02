<?php
/**
 * config/mail.php
 *
 * Cau hinh SMTP cho PHPMailer.
 * File nay duoc autoload tu dong moi khi chay composer autoload.
 *
 * 🔐 Mat khau duoc doc tu file .env (khong commit len git).
 *    Copy .env.example → .env va dien App Password cua Gmail.
 *
 * *** LUU Y QUAN TRONG CHO HOSTING FREE (123host.vn): ***
 * - Hosting free thuong CHAN port 587/465 (SMTP) → khong gui duoc qua Gmail SMTP.
 * - Giai phap: script se tu dong fallback sang PHP mail() function.
 * - De PHP mail() hoat dong, hosting PHAI cau hinh sendmail hoac mail server.
 * - Neu ca 2 deu that bai: can dung API HTTP nhu SendGrid, Mailgun, Resend.
 *
 * Khuyen nghi: Lien he 123host.vn hoi:
 *   1. Port SMTP (587, 465) co bi chan khong?
 *   2. Ham mail() cua PHP co hoat dong khong?
 *   3. Co gioi han so email/ngay khong?
 */

function load_env(string $path): array
{
    $vars = [];
    if (!file_exists($path)) { return $vars; }
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) { continue; }
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            if ((strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) ||
                (strpos($value, "'") === 0 && strrpos($value, "'") === strlen($value) - 1)) {
                $value = substr($value, 1, -1);
            }
            $vars[$key] = $value;
        }
    }
    return $vars;
}

$env = load_env(__DIR__ . '/../.env');

return [
    'smtp_host'     => 'smtp.gmail.com',
    'smtp_port'     => 587,
    'smtp_user'     => $env['SMTP_USER'] ?? getenv('SMTP_USER') ?: '',
    'smtp_pass'     => $env['SMTP_PASS'] ?? getenv('SMTP_PASS') ?: '',
    'smtp_encrypt'  => 'tls',
    'from_email'    => $env['SMTP_USER'] ?? getenv('SMTP_USER') ?: '',
    'from_name'     => 'The Green Life',
    'to_emails'     => [$env['TO_EMAIL'] ?? getenv('TO_EMAIL') ?: ''],
    'fallback_to_emails' => [],
    'debug' => false,
];
