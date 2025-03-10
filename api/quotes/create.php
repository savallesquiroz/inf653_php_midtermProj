<?php
// Include files for DB and Quote model
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

// Get raw data from the request body
$input = file_get_contents("php://input");

// For debugging: output what we're receiving (comment this out in production)
file_put_contents('debug.log', date('Y-m-d H:i:s') . " Received input: " . $input . "\n", FILE_APPEND);

// Decode the JSON input
$data = json_decode($input);

if (!$data) {
    echo json_encode(array("message" => "Invalid JSON received."));
    exit();
}

// Debug: Uncomment next line to see structure:
// echo json_encode($data);

// Validate required fields
if (empty($data->quote) || empty($data->author_id) || empty($data->category_id)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

$database = new Database();
$db = $database->connect();

$quote = new Quote($db);
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

if ($quote->create()) {
    echo json_encode(array(
         "id" => $db->lastInsertId(), 
         "quote" => $quote->quote, 
         "author_id" => $quote->author_id, 
         "category_id" => $quote->category_id
    ));
} else {
    echo json_encode(array("message" => "Quote Not Created"));
}
?>
