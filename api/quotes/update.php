<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
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

// Check if the author exists
$author_query = "SELECT id FROM authors WHERE id = :author_id";
$author_stmt = $db->prepare($author_query);
$author_stmt->bindParam(':author_id', $data->author_id);
$author_stmt->execute();

if ($author_stmt->rowCount() == 0) {
    echo json_encode(array("message" => "author_id Not Found"));
    exit();
}

// Check if the category exists
$category_query = "SELECT id FROM categories WHERE id = :category_id";
$category_stmt = $db->prepare($category_query);
$category_stmt->bindParam(':category_id', $data->category_id);
$category_stmt->execute();

if ($category_stmt->rowCount() == 0) {
    echo json_encode(array("message" => "category_id Not Found"));
    exit();
}

// Update the quote
$quote = new Quote($db);

$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->author_id = $data->author_id;
$quote->category_id = $data->category_id;

if ($quote->update()) {
    echo json_encode(array(
        "id" => $quote->id,
        "quote" => $quote->quote,
        "author_id" => $quote->author_id,
        "category_id" => $quote->category_id
    ));
} else {
    echo json_encode(array("message" => "Quote Not Updated"));
}
?>
