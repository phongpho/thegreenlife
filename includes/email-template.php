<?php
/**
 * includes/email-template.php
 *
 * HTML Email template dùng chung cho toàn bộ email của The Green Life.
 * Trả về HTML string, kèm plain-text fallback qua tham số $plainText.
 *
 * Cách dùng:
 *   $mail->Body    = email_template_admin($data);
 *   $mail->AltBody = email_template_admin_plain($data);
 */

/**
 * HTML email gửi cho admin khi có liên hệ mới.
 */
function email_template_admin_html(array $data): string
{
    $name       = htmlspecialchars($data['name']       ?? '', ENT_QUOTES, 'UTF-8');
    $phone      = htmlspecialchars($data['phone']      ?? '', ENT_QUOTES, 'UTF-8');
    $email      = htmlspecialchars($data['email']      ?? '', ENT_QUOTES, 'UTF-8');
    $deptLabel  = htmlspecialchars($data['dept_label'] ?? '', ENT_QUOTES, 'UTF-8');
    $message    = nl2br(htmlspecialchars($data['message'] ?? '', ENT_QUOTES, 'UTF-8'));
    $time       = htmlspecialchars($data['time']       ?? date('d/m/Y H:i:s'), ENT_QUOTES, 'UTF-8');

    return <<<HTML
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1b5e20;padding:28px 32px;text-align:center;">
                            <h1 style="color:#ffffff;font-size:22px;margin:0;font-weight:700;">🌿 THE GREEN LIFE</h1>
                            <p style="color:rgba(255,255,255,0.85);font-size:14px;margin:6px 0 0;">Agricultural &amp; Seafood Trading</p>
                        </td>
                    </tr>

                    <!-- Sub-header -->
                    <tr>
                        <td style="background-color:#fbc02d;padding:12px 32px;">
                            <p style="color:#333333;font-size:15px;font-weight:700;margin:0;text-align:center;">
                                📩 LIÊN HỆ MỚI TỪ WEBSITE
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">

                            <!-- Info Table -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:24px;border-collapse:collapse;">
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#555;width:130px;font-weight:600;">👤 Họ tên</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#333;">{$name}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#555;font-weight:600;">📞 Điện thoại</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#333;">{$phone}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#555;font-weight:600;">✉️ Email</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#333;">{$email}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#555;font-weight:600;">🏢 Bộ phận</td>
                                    <td style="padding:10px 14px;border-bottom:1px solid #e8e8e8;font-size:14px;color:#333;">{$deptLabel}</td>
                                </tr>
                                <tr>
                                    <td style="padding:10px 14px;font-size:14px;color:#555;font-weight:600;">🕐 Thời gian</td>
                                    <td style="padding:10px 14px;font-size:14px;color:#333;">{$time}</td>
                                </tr>
                            </table>

                            <!-- Message Block -->
                            <h2 style="font-size:16px;color:#1b5e20;margin:0 0 12px;padding-bottom:8px;border-bottom:2px solid #fbc02d;">📝 Nội dung tin nhắn</h2>
                            <div style="background-color:#f9fafb;padding:16px;border-radius:6px;font-size:14px;color:#333;line-height:1.7;">
                                {$message}
                            </div>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color:#f4f6f8;padding:20px 32px;text-align:center;">
                            <p style="font-size:12px;color:#999;margin:0;">
                                Email này được gửi tự động từ form liên hệ trên website
                                <br><strong style="color:#1b5e20;">thegreenlife.com.vn</strong>
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
}

/**
 * Plain-text fallback cho email admin.
 */
function email_template_admin_plain(array $data): string
{
    $name       = $data['name']       ?? '';
    $phone      = $data['phone']      ?? '';
    $email      = $data['email']      ?? '';
    $deptLabel  = $data['dept_label'] ?? '';
    $message    = $data['message']    ?? '';
    $time       = $data['time']       ?? date('d/m/Y H:i:s');

    return <<<TEXT
=== THE GREEN LIFE — LIÊN HỆ MỚI ===

Họ tên       : {$name}
Số điện thoại: {$phone}
Email        : {$email}
Bộ phận      : {$deptLabel}
Thời gian    : {$time}

=== NỘI DUNG TIN NHẮN ===
{$message}

---
Email này được gửi tự động từ form liên hệ trên website thegreenlife.com.vn
TEXT;
}

/**
 * HTML email tự động gửi cho khách hàng (xác nhận đã nhận).
 */
function email_template_reply_html(array $data): string
{
    $name    = htmlspecialchars($data['name'] ?? 'Quý khách', ENT_QUOTES, 'UTF-8');
    $lang    = $data['lang'] ?? 'vi';
    $email   = htmlspecialchars($data['email'] ?? '', ENT_QUOTES, 'UTF-8');

    $title   = $lang === 'vi' ? 'Cảm ơn bạn đã liên hệ!' : 'Thank you for contacting us!';
    $greeting = $lang === 'vi' ? "Xin chào <strong>{$name}</strong>," : "Dear <strong>{$name}</strong>,";
    $body1   = $lang === 'vi'
        ? 'Chúng tôi đã nhận được tin nhắn của bạn và sẽ phản hồi trong thời gian sớm nhất (<strong>trong vòng 24 giờ</strong> làm việc).'
        : 'We have received your message and will get back to you as soon as possible (<strong>within 24 business hours</strong>).';
    $body2   = $lang === 'vi'
        ? 'Nếu bạn cần hỗ trợ gấp, vui lòng gọi hotline: <strong>0939 660 004</strong>.'
        : 'If you need urgent assistance, please call our hotline: <strong>+84 939 660 004</strong>.';
    $footer  = $lang === 'vi'
        ? 'Trân trọng,<br>Đội ngũ The Green Life'
        : 'Best regards,<br>The Green Life Team';

    return <<<HTML
<!DOCTYPE html>
<html lang="{$lang}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:#f4f6f8;font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f6f8;padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color:#1b5e20;padding:28px 32px;text-align:center;">
                            <h1 style="color:#ffffff;font-size:22px;margin:0;font-weight:700;">🌿 THE GREEN LIFE</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding:32px;">
                            <h2 style="font-size:18px;color:#1b5e20;margin:0 0 16px;">{$title}</h2>
                            <p style="font-size:15px;color:#333;line-height:1.7;margin:0 0 16px;">{$greeting}</p>
                            <p style="font-size:15px;color:#333;line-height:1.7;margin:0 0 16px;">{$body1}</p>
                            <p style="font-size:15px;color:#333;line-height:1.7;margin:0 0 24px;">{$body2}</p>

                            <table cellpadding="0" cellspacing="0" style="margin-bottom:24px;">
                                <tr>
                                    <td style="background-color:#fbc02d;padding:10px 20px;border-radius:4px;font-size:14px;">
                                        <span style="color:#333;font-weight:700;">📞 Hotline: 0939 660 004</span>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size:14px;color:#555;line-height:1.7;margin:0;">
                                {$footer}
                            </p>
                        </td>
                    </tr>

                    <!-- Sub text -->
                    <tr>
                        <td style="background-color:#f4f6f8;padding:20px 32px;text-align:center;">
                            <p style="font-size:12px;color:#999;margin:0;">
                                {$email}
                                <br>🌿 The Green Life — Agricultural &amp; Seafood Trading
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;
}

/**
 * Plain-text fallback cho email xác nhận khách hàng.
 */
function email_template_reply_plain(array $data): string
{
    $name = $data['name'] ?? 'Quý khách';
    $lang = $data['lang'] ?? 'vi';

    if ($lang === 'vi') {
        return <<<TEXT
Xin chào {$name},

Cảm ơn bạn đã liên hệ với The Green Life!
Chúng tôi đã nhận được tin nhắn của bạn và sẽ phản hồi trong thời gian sớm nhất (trong vòng 24 giờ làm việc).

Nếu bạn cần hỗ trợ gấp, vui lòng gọi hotline: 0939 660 004.

Trân trọng,
Đội ngũ The Green Life
🌿 thegreenlife.com.vn
TEXT;
    }

    return <<<TEXT
Dear {$name},

Thank you for contacting The Green Life!
We have received your message and will get back to you as soon as possible (within 24 business hours).

If you need urgent assistance, please call our hotline: +84 939 660 004.

Best regards,
The Green Life Team
🌿 thegreenlife.com.vn
TEXT;
}
