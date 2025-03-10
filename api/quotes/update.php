<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();
$quote = new Quote($db);

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id, $data->quote, $data->author_id, $data->category_id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$query = "UPDATE quotes SET quote = :quote, author_id = :author_id, category_id = :category_id WHERE id = :id";
$stmt = $db->prepare($query);

if ($stmt->execute([
    ':id' => $data->id,
    ':quote' => $data->quote,
    ':author_id' => $data->author_id,
    ':category_id' => $data->category_id
])) {
    echo json_encode(['message' => 'Quote Updated']);
} else {
    echo json_encode(['message' => 'Quote Not Updated']);
}
?>
