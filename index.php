<?php
// Safe redirect to the public webroot.
//
// If already serving from /public/ include its index directly to avoid redirect loops.
// Preserves the query string when redirecting.

if (php_sapi_name() === 'cli') {
    // Helpful message when run from CLI
    echo "Open the application in your browser at the 'public/' folder.\n";
    exit;
}

$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$requestUri = $_SERVER['REQUEST_URI'] ?? '';

// If request already targets the public folder, forward to public/index.php
if (strpos($scriptName, '/public/') !== false || strpos($requestUri, '/public/') !== false) {
    // Serve the public index directly
    $publicIndex = __DIR__ . '/public/index.php';
    if (file_exists($publicIndex)) {
        require $publicIndex;
        exit;
    }
    // If public index missing, show a helpful message
    http_response_code(500);
    echo "Public index not found. Please ensure public/index.php exists.";
    exit;
}

// Build destination relative to current script path (preserves hosting subdirectory)
$rootDir = rtrim(dirname($scriptName), '/');
$destPath = ($rootDir === '' ? '' : $rootDir) . '/public/';
$query = $_SERVER['QUERY_STRING'] ?? '';
if ($query !== '') {
    $destPath .= '?' . $query;
}

// Perform a safe local redirect (302)
header('Location: ' . $destPath, true, 302);
exit;