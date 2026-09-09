<?php


$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH)
);

// If running via PHP CLI built-in web server (e.g. php artisan serve or php -S)
if (php_sapi_name() === 'cli-server') {
    if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
        return false;
    }
}

// Fallback for Apache / LiteSpeed on cPanel:
// If a static asset request reaches index.php, stream the file with correct MIME type
// instead of returning false (which terminates with an empty 0-byte response).
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$relativeUri = ($scriptDir !== '/' && $scriptDir !== '.') 
    ? preg_replace('#^' . preg_quote($scriptDir, '#') . '#', '', $uri) 
    : $uri;

$publicFile = __DIR__ . '/public' . $relativeUri;
if ($relativeUri !== '' && $relativeUri !== '/' && file_exists($publicFile) && !is_dir($publicFile)) {
    $extension = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));
    $mimeTypes = [
        'css'   => 'text/css; charset=UTF-8',
        'js'    => 'application/javascript; charset=UTF-8',
        'json'  => 'application/json',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'webp'  => 'image/webp',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'eot'   => 'application/vnd.ms-fontobject',
        'otf'   => 'font/otf',
        'map'   => 'application/json',
    ];
    $contentType = $mimeTypes[$extension] ?? (function_exists('mime_content_type') ? mime_content_type($publicFile) : 'application/octet-stream');
    header("Content-Type: {$contentType}");
    header("Content-Length: " . filesize($publicFile));
    header("Cache-Control: public, max-age=31536000, immutable");
    readfile($publicFile);
    exit;
}

require_once __DIR__.'/public/index.php';