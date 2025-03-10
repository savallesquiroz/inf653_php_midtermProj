<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();
$category = new Category($db);

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id, $data->category)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$query = "UPDATE categories SET category = :category WHERE id = :id";
$stmt = $db->prepare($query);

if ($stmt->execute([
    ':id' => $data->id,
    ':category' => $data->category
])) {
    echo json_encode(['message' => 'Category Updated']);
} else {
    echo json_encode(['message' => 'Category Not Updated']);
}
?>
