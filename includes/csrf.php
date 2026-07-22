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
    $started = session_start();
    if (!$started) {
        error_log('[CSRF] CRITICAL: session_start() failed! Check session.save_path permissions.');
    }
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

        error_log('[CSRF] Token mới được sinh: ' . substr($_SESSION['csrf_token'], 0, 8) . '...');
    }

    return $_SESSION['csrf_token'];
}

/**
 * Xác thực CSRF token.
 * Trả về true nếu token hợp lệ.
 */
function csrf_verify(string $token): bool
{
    // Debug: kiểm tra từng điều kiện
    if (empty($_SESSION['csrf_token'])) {
        error_log('[CSRF] FAIL: $_SESSION[\'csrf_token\'] is EMPTY — session không tồn tại hoặc bị mất!');
        error_log('[CSRF] Session ID: ' . (session_id() ?: 'NONE'));
        error_log('[CSRF] $_SESSION keys: ' . implode(', ', array_keys($_SESSION)));
        return false;
    }

    if (empty($_SESSION['csrf_expires'])) {
        error_log('[CSRF] FAIL: $_SESSION[\'csrf_expires\'] is EMPTY');
        return false;
    }

    if (time() > $_SESSION['csrf_expires']) {
        error_log('[CSRF] FAIL: Token đã hết hạn. Expires=' . $_SESSION['csrf_expires'] . ' Now=' . time());
        return false;
    }

    $match = hash_equals($_SESSION['csrf_token'], $token);
    if (!$match) {
        error_log('[CSRF] FAIL: Token không khớp.');
        error_log('[CSRF] SESSION token: ' . substr($_SESSION['csrf_token'], 0, 8) . '...');
        error_log('[CSRF] POST   token: ' . substr($token, 0, 8) . '...');
    }

    return $match;
}
