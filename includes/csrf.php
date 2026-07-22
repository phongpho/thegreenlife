<?php
/**
 * includes/csrf.php
 *
 * Helper sinh & xác thực CSRF token cho form.
 * Token được lưu trong session, tự động hết hạn sau 2 giờ.
 *
 * Cách dùng:
 *   Trong form:   <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
 *   Khi xử lý:    if (!csrf_verify($_POST['csrf_token'] ?? '')) { error... }
 */

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

/**
 * Sinh CSRF token (dùng 1 lần / session).
 * Token tự động làm mới khi hết hạn.
 */
function csrf_token(): string
{
    $now = time();

    // Token chưa có hoặc đã hết hạn (2 giờ) → sinh mới
    if (empty($_SESSION['csrf_token']) || empty($_SESSION['csrf_expires']) || $now > $_SESSION['csrf_expires']) {
        $_SESSION['csrf_token']   = bin2hex(random_bytes(32));
        $_SESSION['csrf_expires'] = $now + 7200; // 2 giờ
    }

    return $_SESSION['csrf_token'];
}

/**
 * Xác thực CSRF token.
 * Trả về true nếu token hợp lệ.
 */
function csrf_verify(string $token): bool
{
    if (
        empty($_SESSION['csrf_token']) ||
        empty($_SESSION['csrf_expires']) ||
        time() > $_SESSION['csrf_expires']
    ) {
        return false;
    }

    return hash_equals($_SESSION['csrf_token'], $token);
}
