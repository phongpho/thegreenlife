<?php
/**
 * includes/csrf.php
 *
 * Sinh & kiểm tra CSRF token để chống Cross-Site Request Forgery.
 * Yêu cầu session đã được khởi tạo trước khi include file này.
 */

// ── Sinh token mới (nếu chưa có) ──────────────────────────
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**
 * Trả về token hiện tại (để chèn vào hidden input trong form)
 */
function csrf_token(): string
{
    return $_SESSION['csrf_token'] ?? '';
}

/**
 * Trả về field HTML chứa CSRF token
 */
function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . csrf_token() . '">';
}

/**
 * Kiểm tra CSRF token từ request.
 * Trả về true nếu hợp lệ, false nếu không.
 * Sau khi kiểm tra thành công -> tự động tạo lại token mới.
 */
function csrf_validate(string $token): bool
{
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    $valid = hash_equals($_SESSION['csrf_token'], $token);
    // Tạo token mới sau khi validate thành công (chống replay)
    if ($valid) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $valid;
}
