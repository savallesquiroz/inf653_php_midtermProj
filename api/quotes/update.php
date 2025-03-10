<?php
// Include database and model files
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

// Validate required fields
if (empty($data->id) || empty($data->quote) || empty($data->author_id) || empty($data->category_id)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

// Create Quote object and assign data
$quote = new Quote($db);
$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

// Attempt to update the quote
if($quote->update()){
    echo json_encode(array("message" => "Quote Updated"));
} else {
    echo json_encode(array("message" => "Quote Not Updated"));
}
?>
