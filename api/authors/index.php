<?php
// Set up CORS and headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

// Handle preflight request
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// Route according to the method
switch ($method) {
    case 'GET':
        // If an id is provided, use read_single; otherwise, use read
        if (isset($_GET['id'])) {
            require 'read_single.php';
        } else {
            require 'read.php';
        }
        break;
    case 'POST':
        require 'create.php';
        break;
    case 'PUT':
        require 'update.php';
        break;
    case 'DELETE':
        require 'delete.php';
        break;
    default:
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
?>
