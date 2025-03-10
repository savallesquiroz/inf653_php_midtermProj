<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();
$author = new Author($db);

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id, $data->author)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$query = "UPDATE authors SET author = :author WHERE id = :id";
$stmt = $db->prepare($query);

if ($stmt->execute([
    ':id' => $data->id,
    ':author' => $data->author
])) {
    echo json_encode(['message' => 'Author Updated']);
} else {
    echo json_encode(['message' => 'Author Not Updated']);
}
?>
