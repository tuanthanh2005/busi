<?php
$requestUri = $_SERVER["REQUEST_URI"];
$parsedUrl = parse_url($requestUri);
$requestPath = ltrim($parsedUrl['path'], '/');

// Check if the requested path corresponds to an existing file (static or PHP)
if (file_exists(__DIR__ . '/' . $requestPath)) {
    // If it's a static file (image, css, js, etc.)
    if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico|woff2?|ttf|eot|svg)$/', $requestPath)) {
        return false; // Let the built-in server handle static files
    }
    
    // If it's a PHP file (e.g., admin_chat.php), include and execute it directly
    if (pathinfo($requestPath, PATHINFO_EXTENSION) === 'php') {
        // Cần chỉnh lại $_GET nếu có query string
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $_GET);
        }
        include __DIR__ . '/' . $requestPath;
        exit; // Stop further execution after including the PHP file
    }
}

// If none of the above conditions met, mock the .htaccess RewriteRule to index.php
$url = $requestPath; 
$_GET['url'] = $url;
include __DIR__ . '/index.php';

//php -S localhost:8000 -t public public/router.php