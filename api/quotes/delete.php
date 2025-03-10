<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

// Check if the quote exists
$quote_query = "SELECT id FROM quotes WHERE id = :id";
$quote_stmt = $db->prepare($quote_query);
$quote_stmt->bindParam(':id', $data->id);
$quote_stmt->execute();

if ($quote_stmt->rowCount() == 0) {
    echo json_encode(array("message" => "No Quotes Found"));
    exit();
}

// Delete the quote
$quote = new Quote($db);
$quote->id = $data->id;

if ($quote->delete()) {
    echo json_encode(array("id" => $quote->id));
} else {
    echo json_encode(array("message" => "Quote Not Deleted"));
}
?>
