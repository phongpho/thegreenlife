<?php
/**
 * config/mail.php
 * 
 * Cấu hình SMTP cho PHPMailer.
 * File này được autoload tự động mỗi khi chạy composer autoload.
 */
return [
    'smtp_host'     => 'sandbox.smtp.mailtrap.io',
    'smtp_port'     => 2525,
    'smtp_user'     => '83a26ffb86e4f2',
    'smtp_pass'     => '5f3611c3b60109',
    'smtp_encrypt'  => '',                       // tls | ssl | (trống)
    'from_email'    => 'contact@thegreenlife.com',
    'from_name'     => 'The Green Life',
    'to_emails'     => [
        'taphongpho@gmail.com',
        'lucasbglvn@gmail.com',
    ],
];
