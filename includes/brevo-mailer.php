<?php
/**
 * includes/brevo-mailer.php
 *
 * Gửi email qua Brevo API v3 (Sendinblue) — dùng HTTPS port 443.
 * Render free tier không chặn HTTPS, nên đây là giải pháp thay thế
 * cho SMTP (vốn bị Render chặn).
 *
 * Free tier: 300 emails/ngày.
 * API key: lấy từ https://app.brevo.com/settings/keys/api
 *
 * Cách dùng:
 *   $result = brevo_send($config, $sender, $to, $subject, $html, $plain);
 *   if ($result['success']) { ... }
 */

/**
 * Gửi 1 email qua Brevo API.
 *
 * @param array  $config   Brevo config: ['api_key' => '...']
 * @param array  $sender   ['email' => '...', 'name' => '...']
 * @param array  $to       Người nhận: ['email' => '...', 'name' => '...']
 * @param string $subject  Tiêu đề email
 * @param string $htmlBody Nội dung HTML
 * @param string $textBody Nội dung plain text
 * @param array  $replyTo  (optional) ['email' => '...', 'name' => '...']
 * @return array ['success' => bool, 'message' => string, 'http_code' => int]
 */
function brevo_send(
    array $config,
    array $sender,
    array $to,
    string $subject,
    string $htmlBody,
    string $textBody,
    array $replyTo = []
): array {
    $apiKey = $config['api_key'] ?? '';

    if ($apiKey === '') {
        return [
            'success'   => false,
            'message'   => 'BREVO_API_KEY is not configured.',
            'http_code' => 0,
        ];
    }

    $payload = [
        'sender'      => $sender,
        'to'          => [$to],
        'subject'     => $subject,
        'htmlContent' => $htmlBody,
        'textContent' => $textBody,
    ];

    if (!empty($replyTo['email'])) {
        $payload['replyTo'] = $replyTo;
    }

    $ch = curl_init('https://api.brevo.com/v3/smtp/email');

    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => json_encode($payload),
        CURLOPT_HTTPHEADER     => [
            'api-key: ' . $apiKey,
            'Content-Type: application/json',
            'Accept: application/json',
        ],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 20,
        CURLOPT_CONNECTTIMEOUT => 10,
    ]);

    $response   = curl_exec($ch);
    $httpCode   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError  = curl_error($ch);
    curl_close($ch);

    if ($curlError !== '') {
        error_log('[Brevo] cURL error: ' . $curlError);
        return [
            'success'   => false,
            'message'   => 'cURL error: ' . $curlError,
            'http_code' => 0,
        ];
    }

    $body = json_decode($response, true);

    if ($httpCode >= 200 && $httpCode < 300) {
        $messageId = $body['messageId'] ?? 'unknown';
        error_log("[Brevo] Email sent successfully. MessageId: {$messageId}");
        return [
            'success'   => true,
            'message'   => "Sent (MessageId: {$messageId})",
            'http_code' => $httpCode,
        ];
    }

    // Lỗi từ Brevo API
    $errorMsg = $body['message'] ?? 'Unknown Brevo error';
    error_log("[Brevo] API error (HTTP {$httpCode}): {$errorMsg}");

    return [
        'success'   => false,
        'message'   => "Brevo API error: {$errorMsg}",
        'http_code' => $httpCode,
    ];
}
