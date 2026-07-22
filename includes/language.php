<?php
if (session_status() === PHP_SESSION_NONE) {
    // Tránh lỗi session.save_path không ghi được trên một số hosting (Render, Docker...)
    @session_start();
}

// Danh sách ngôn ngữ được hỗ trợ
$supportedLangs = ['vi', 'en'];

// Chuyển ngôn ngữ khi có ?lang=vi hoặc ?lang=en trên URL
if (isset($_GET['lang']) && in_array($_GET['lang'], $supportedLangs, true)) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Ngôn ngữ hiện tại (mặc định: Tiếng Việt)
$currentLang = $_SESSION['lang'] ?? 'vi';
if (!in_array($currentLang, $supportedLangs, true)) {
    $currentLang = 'vi';
}

// Nạp file ngôn ngữ tương ứng
$langFile = __DIR__ . '/../lang/' . $currentLang . '.php';
$lang = file_exists($langFile) ? include $langFile : include __DIR__ . '/../lang/vi.php';

/**
 * Helper: tạo lại URL hiện tại nhưng đổi tham số lang
 * (giữ nguyên các query string khác, ví dụ ?id=5&lang=en)
 */
function lang_switch_url(string $targetLang): string
{
    $query = $_GET;
    $query['lang'] = $targetLang;
    $path = strtok($_SERVER['REQUEST_URI'] ?? '', '?');
    return $path . '?' . http_build_query($query);
}