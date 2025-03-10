<?php
// Include necessary files
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

// Get JSON input from the request body
$data = json_decode(file_get_contents("php://input"));

// Validate that the id is provided
if(empty($data->id)) {
    echo json_encode(array("message" => "Missing Required Parameter: id"));
    exit();
}

// Create a Quote object and assign the id
$quote = new Quote($db);
$quote->id = $data->id;

// Attempt to delete the quote
if($quote->delete()){
    echo json_encode(array("message" => "Quote Deleted"));
} else {
    echo json_encode(array("message" => "Quote Not Deleted"));
}
?>
