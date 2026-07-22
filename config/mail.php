<?php
/**
 * config/mail.php
 *
 * Nạp cấu hình email từ file .env (hoặc biến môi trường hệ thống).
 * File này được autoload qua composer.json nên có thể gọi trực tiếp
 * hàm mail_config() ở bất kỳ đâu trong project.
 *
 * Hỗ trợ 2 phương thức:
 *   - SMTP (PHPMailer) — bị chặn trên Render free tier
 *   - Brevo API (HTTPS) — dùng khi triển khai trên Render
 *
 * KHÔNG hardcode tài khoản / mật khẩu trong file này.
 */

/**
 * Đọc file .env và trả về mảng key => value.
 * Hỗ trợ: KEY=VALUE, KEY="VALUE", KEY='VALUE', comment bằng dấu #.
 */
function load_env_file(string $path): array
{
    $vars = [];
    if (!file_exists($path)) {
        return $vars;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return $vars;
    }

    foreach ($lines as $line) {
        $line = trim($line);

        // Bỏ qua comment và dòng không có dấu =
        if ($line === '' || $line[0] === '#' || strpos($line, '=') === false) {
            continue;
        }

        // Tách key=value (chỉ tách ở dấu = đầu tiên)
        [$key, $value] = explode('=', $line, 2);
        $key   = trim($key);
        $value = trim($value);

        // Bỏ dấu quote bao quanh nếu có
        if (
            (strlen($value) >= 2)
            && (
                ($value[0] === '"' && $value[-1] === '"')
                || ($value[0] === "'" && $value[-1] === "'")
            )
        ) {
            $value = substr($value, 1, -1);
        }

        $vars[$key] = $value;
    }

    return $vars;
}

/**
 * Trả về cấu hình gửi email (SMTP + Brevo API).
 * Ưu tiên: biến môi trường hệ thống > file .env > giá trị mặc định.
 */
function mail_config(): array
{
    // Thử nạp từ .env (nằm cùng thư mục gốc project)
    $envPath = dirname(__DIR__) . '/.env';
    $envVars = load_env_file($envPath);

    return [
        // ── SMTP (dùng PHPMailer, bị chặn trên Render free tier) ──
        'host'        => getenv('SMTP_HOST')        ?: ($envVars['SMTP_HOST']        ?? ''),
        'port'        => getenv('SMTP_PORT')        ?: ($envVars['SMTP_PORT']        ?? '587'),
        'encryption'  => getenv('SMTP_ENCRYPTION')  ?: ($envVars['SMTP_ENCRYPTION']  ?? 'tls'),
        'username'    => getenv('SMTP_USERNAME')    ?: ($envVars['SMTP_USERNAME']    ?? ''),
        'password'    => getenv('SMTP_PASSWORD')    ?: ($envVars['SMTP_PASSWORD']    ?? ''),
        'from_address'=> getenv('SMTP_FROM_ADDRESS')?: ($envVars['SMTP_FROM_ADDRESS']?? ''),
        'from_name'   => getenv('SMTP_FROM_NAME')   ?: ($envVars['SMTP_FROM_NAME']   ?? 'The Green Life'),
        'to_address'  => getenv('SMTP_TO_ADDRESS')  ?: ($envVars['SMTP_TO_ADDRESS']  ?? ''),

        // ── Brevo API (HTTPS port 443, không bị Render chặn) ──
        // Đăng ký miễn phí 300 email/ngày tại: https://www.brevo.com
        'brevo_api_key' => getenv('BREVO_API_KEY') ?: ($envVars['BREVO_API_KEY'] ?? ''),
    ];
}
