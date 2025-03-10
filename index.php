<?php
// Set up CORS and headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

// Handle preflight OPTIONS request for CORS support
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Get the path from the URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path_segments = explode('/', trim($path, '/'));

// Ensure path segments are valid
$endpoint = $path_segments[1] ?? null; // The first segment after the base path

switch ($endpoint) {
    case 'quotes':
        require __DIR__ . '/api/quotes/index.php';
        break;
    case 'authors':
        require __DIR__ . '/api/authors/index.php';
        break;
    case 'categories':
        require __DIR__ . '/api/categories/index.php';
        break;
    default:
        // If endpoint not found, return a 404 error
        header('HTTP/1.1 404 Not Found');
        echo json_encode(['message' => 'Endpoint Not Found']);
        break;
}
