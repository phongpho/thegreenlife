<?php
/**
 * Route Configuration — Clean URL Mapping
 *
 * Maps each PHP file to its Vietnamese and English path aliases.
 * Language stays as ?lang= query param (not path prefix).
 */

$routes = [
    'index.php'          => ['vi' => '/',               'en' => '/'],
    'about-us.php'       => ['vi' => '/gioi-thieu',     'en' => '/about-us'],
    'contact.php'        => ['vi' => '/lien-he',        'en' => '/contact'],
    'seafood.php'        => ['vi' => '/thuy-san',       'en' => '/seafood'],
    'grain-trading.php'  => ['vi' => '/xuat-nhap-khau', 'en' => '/grain-trading'],
    'services.php'       => ['vi' => '/thuong-mai-dich-vu', 'en' => '/services'],
    'products.php'       => ['vi' => '/san-pham',       'en' => '/products'],
    'news.php'           => ['vi' => '/tin-tuc',        'en' => '/news'],
];

/**
 * Detect the subdirectory base path (e.g. '/thegreenlife-v2' or '' on production).
 */
function base_path(): string
{
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/\\');
    return ($base === '' || $base === '/' || $base === '\\') ? '' : $base;
}

/**
 * Get the clean URL path for a PHP file in a given language.
 * Automatically prepends the subdirectory base path.
 */
function route_to_url(string $file, string $lang = 'vi'): string
{
    global $routes;
    $base = base_path();
    if (isset($routes[$file])) {
        $slug = $routes[$file][$lang] ?? $routes[$file]['vi'];
        return $base . $slug;
    }
    $path = str_replace('.php', '', $file);
    return $base . '/' . ltrim($path, '/');
}

/**
 * Convert a request path back to the PHP file.
 * Automatically strips the subdirectory base path before matching.
 */
function route_to_file(string $path): ?string
{
    global $routes;
    $base = base_path();
    // Strip base path from request URI if present
    if ($base !== '' && strpos($path, $base) === 0) {
        $path = substr($path, strlen($base));
    }
    $path = '/' . trim($path, '/');
    if ($path === '/' || $path === '') {
        return 'index.php';
    }
    foreach ($routes as $file => $aliases) {
        if (in_array($path, $aliases, true)) {
            return $file;
        }
    }
    return null;
}

/**
 * Get the slug for a given file in a given language (without leading slash or base path).
 */
function route_slug(string $file, string $lang = 'vi'): string
{
    global $routes;
    if (isset($routes[$file])) {
        return trim($routes[$file][$lang] ?? $routes[$file]['vi'], '/');
    }
    return trim(str_replace('.php', '', $file), '/');
}

/**
 * Get the active PHP file from the current request, for nav active-state detection.
 */
function route_current_file(): string
{
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $file = route_to_file($path);
    return $file ?? 'index.php';
}
