<?php
/**
 * admin/contacts.php
 *
 * Trang xem danh sách contact đã gửi (đọc từ file log).
 * Bảo vệ bằng mật khẩu đơn giản.
 *
 * Truy cập: https://thegreenlife.onrender.com/admin/contacts.php
 * Mật khẩu mặc định: thegreenlife2024
 */

// ── Bảo vệ bằng mật khẩu ─────────────────────────────────────
$ADMIN_PASSWORD = 'thegreenlife2024'; // Nên đổi sau

session_start();

// Nếu đã logout
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_logged_in']);
    header('Location: contacts.php');
    exit;
}

// Nếu đang submit password
if (isset($_POST['password'])) {
    if ($_POST['password'] === $ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $loginError = 'Sai mật khẩu! / Wrong password!';
    }
}

// Chưa đăng nhập → hiện form login
if (empty($_SESSION['admin_logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login — The Green Life</title>
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body {
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                background: #1b5e20;
                display: flex; align-items: center; justify-content: center;
                min-height: 100vh;
            }
            .login-box {
                background: white; padding: 40px; border-radius: 12px;
                box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 100%; max-width: 380px;
                text-align: center;
            }
            .login-box h1 { color: #1b5e20; margin-bottom: 8px; font-size: 24px; }
            .login-box p { color: #666; margin-bottom: 24px; font-size: 14px; }
            .login-box input {
                width: 100%; padding: 12px 16px; border: 2px solid #ddd;
                border-radius: 8px; font-size: 16px; margin-bottom: 12px;
                text-align: center;
            }
            .login-box input:focus { outline: none; border-color: #1b5e20; }
            .login-box button {
                width: 100%; padding: 12px; background: #1b5e20; color: white;
                border: none; border-radius: 8px; font-size: 16px; cursor: pointer;
                font-weight: bold;
            }
            .login-box button:hover { background: #145018; }
            .login-box .error { color: #d32f2f; margin-bottom: 12px; font-size: 14px; }
        </style>
    </head>
    <body>
        <div class="login-box">
            <h1>🌿 The Green Life</h1>
            <p>Contact Management</p>
            <?php if (isset($loginError)): ?>
                <div class="error"><?= $loginError ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Nhập mật khẩu" autofocus required>
                <button type="submit">Đăng nhập</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// ── Đã đăng nhập → Hiển thị danh sách contact ────────────────
$logDir = __DIR__ . '/../logs';
$contacts = [];

if (is_dir($logDir)) {
    $files = glob($logDir . '/contact-*.log');
    rsort($files); // Mới nhất trước

    foreach ($files as $file) {
        $content = file_get_contents($file);
        if ($content === false) continue;

        // Tách từng entry bằng dấu "---"
        $entries = preg_split('/^---$/m', $content);

        foreach ($entries as $entry) {
            $entry = trim($entry);
            if ($entry === '') continue;

            $contact = ['file' => basename($file)];

            // Parse: [2026-07-22 17:30:00] Lang: vi | From: Name <email>, Phone: 0123, Dept: Kinh doanh
            if (preg_match('/^\[([^\]]+)\]\s*Lang:\s*(\w+)\s*\|\s*From:\s*(.+?)\s*<(.+?)>,\s*Phone:\s*(.+?),\s*Dept:\s*(.+?)$/m', $entry, $m)) {
                $contact['time']     = $m[1];
                $contact['lang']     = $m[2];
                $contact['name']     = trim($m[3]);
                $contact['email']    = trim($m[4]);
                $contact['phone']    = trim($m[5]);
                $contact['dept']     = trim($m[6]);
            }

            // Parse message (sau dòng "Message: ")
            if (preg_match('/^Message:\s*(.+)$/ms', $entry, $m)) {
                $contact['message'] = trim($m[1]);
            }

            if (!empty($contact['name'])) {
                $contacts[] = $contact;
            }
        }
    }
}

// Thống kê
$totalContacts = count($contacts);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts — The Green Life Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f5f5f5; color: #333;
        }
        .header {
            background: #1b5e20; color: white; padding: 16px 24px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .header h1 { font-size: 20px; }
        .header a { color: #fbc02d; text-decoration: none; font-size: 14px; }
        .header a:hover { text-decoration: underline; }
        .stats {
            padding: 16px 24px; background: white;
            border-bottom: 1px solid #e0e0e0; font-size: 14px; color: #666;
        }
        .stats strong { color: #1b5e20; }
        .container { max-width: 1000px; margin: 0 auto; padding: 24px; }
        .card {
            background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            margin-bottom: 16px; overflow: hidden;
        }
        .card-header {
            padding: 16px 20px; border-bottom: 1px solid #e0e0e0;
            display: flex; justify-content: space-between; align-items: center;
            cursor: pointer; user-select: none;
        }
        .card-header:hover { background: #f9f9f9; }
        .card-header .name { font-weight: bold; font-size: 16px; color: #1b5e20; }
        .card-header .meta { font-size: 13px; color: #888; }
        .card-header .dept {
            font-size: 12px; padding: 4px 10px; border-radius: 12px;
            background: #e8f5e9; color: #1b5e20; font-weight: 500;
        }
        .card-body {
            padding: 20px; display: none; border-top: 1px solid #e0e0e0;
        }
        .card.is-open .card-body { display: block; }
        .card.is-open .card-header { background: #f0faf1; }
        .info-row {
            display: grid; grid-template-columns: 120px 1fr;
            gap: 8px 16px; margin-bottom: 12px; font-size: 14px;
        }
        .info-row .label { color: #888; }
        .info-row .value { font-weight: 500; }
        .info-row a { color: #1b5e20; text-decoration: none; }
        .info-row a:hover { text-decoration: underline; }
        .message-box {
            background: #f9f9f9; border: 1px solid #e0e0e0; border-radius: 6px;
            padding: 14px 16px; white-space: pre-wrap; font-size: 14px;
            line-height: 1.6; margin-top: 8px; max-height: 300px; overflow-y: auto;
        }
        .empty {
            text-align: center; padding: 60px 20px; color: #999;
        }
        .empty .icon { font-size: 48px; margin-bottom: 12px; }
        .badge-lang {
            font-size: 11px; padding: 2px 8px; border-radius: 4px;
            background: #e3f2fd; color: #1565c0; text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🌿 The Green Life — Contacts</h1>
        <a href="?logout=1">Đăng xuất</a>
    </div>
    <div class="stats">
        Tổng: <strong><?= $totalContacts ?></strong> tin nhắn
        <?php if ($totalContacts === 0): ?>
            — Chưa có tin nhắn nào. Khi khách gửi form, dữ liệu sẽ hiển thị ở đây.
        <?php endif; ?>
    </div>
    <div class="container">
        <?php if ($totalContacts === 0): ?>
            <div class="empty">
                <div class="icon">📭</div>
                <p>Chưa có tin nhắn liên hệ nào.</p>
            </div>
        <?php else: ?>
            <?php foreach ($contacts as $i => $c): ?>
                <div class="card" id="card-<?= $i ?>">
                    <div class="card-header" onclick="this.parentElement.classList.toggle('is-open')">
                        <div>
                            <div class="name"><?= htmlspecialchars($c['name']) ?></div>
                            <div class="meta">
                                <?= htmlspecialchars($c['time'] ?? '') ?>
                                <span class="badge-lang"><?= strtoupper($c['lang'] ?? 'vi') ?></span>
                            </div>
                        </div>
                        <div class="dept"><?= htmlspecialchars($c['dept'] ?? '') ?></div>
                    </div>
                    <div class="card-body">
                        <div class="info-row">
                            <div class="label">📧 Email:</div>
                            <div class="value">
                                <a href="mailto:<?= htmlspecialchars($c['email'] ?? '') ?>">
                                    <?= htmlspecialchars($c['email'] ?? '') ?>
                                </a>
                            </div>
                            <div class="label">📞 Phone:</div>
                            <div class="value">
                                <a href="tel:<?= htmlspecialchars($c['phone'] ?? '') ?>">
                                    <?= htmlspecialchars($c['phone'] ?? '') ?>
                                </a>
                            </div>
                            <div class="label">📂 File:</div>
                            <div class="value"><?= htmlspecialchars($c['file'] ?? '') ?></div>
                        </div>
                        <strong style="font-size:13px;color:#888;">📝 Tin nhắn:</strong>
                        <div class="message-box"><?= htmlspecialchars($c['message'] ?? '') ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
