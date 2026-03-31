<?php

declare(strict_types=1);

$requestPath = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');
$publicDirectory = realpath(__DIR__ . '/../public');

if ($publicDirectory !== false) {
    $segments = array_values(array_filter(
        explode('/', trim($requestPath, '/')),
        static fn (string $segment): bool => $segment !== ''
    ));

    $hasUnsafeSegment = array_filter(
        $segments,
        static fn (string $segment): bool => $segment === '.' || $segment === '..' || str_starts_with($segment, '.')
    ) !== [];

    if ($requestPath !== '/' && $segments !== [] && ! $hasUnsafeSegment) {
        $assetPath = $publicDirectory . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $segments);

        if (is_file($assetPath)) {
            streamStaticAsset($assetPath);
            exit;
        }
    }
}

require __DIR__ . '/../public/index.php';

function streamStaticAsset(string $assetPath): void
{
    $mimeType = detectMimeType($assetPath);
    $assetSize = filesize($assetPath);

    if ($assetSize === false) {
        http_response_code(500);
        exit;
    }

    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . (string) $assetSize);
    header('Cache-Control: public, max-age=31536000, immutable');

    readfile($assetPath);
}

function detectMimeType(string $assetPath): string
{
    $mimeType = mime_content_type($assetPath);

    if (is_string($mimeType) && $mimeType !== '') {
        return $mimeType;
    }

    return match (strtolower(pathinfo($assetPath, PATHINFO_EXTENSION))) {
        'css' => 'text/css; charset=UTF-8',
        'gif' => 'image/gif',
        'htm', 'html' => 'text/html; charset=UTF-8',
        'ico' => 'image/x-icon',
        'jpg', 'jpeg' => 'image/jpeg',
        'js', 'mjs' => 'application/javascript; charset=UTF-8',
        'json' => 'application/json; charset=UTF-8',
        'mp4' => 'video/mp4',
        'otf' => 'font/otf',
        'png' => 'image/png',
        'svg' => 'image/svg+xml',
        'txt' => 'text/plain; charset=UTF-8',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        default => 'application/octet-stream',
    };
}
