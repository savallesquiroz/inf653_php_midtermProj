<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

try {
    $database = new Database();
    $db = $database->connect();

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->quote) || !isset($data->author_id) || !isset($data->category_id)) {
        echo json_encode(array("message" => "Missing Required Parameters"));
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

    // Create the quote
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
} catch (Exception $e) {
    echo json_encode(array("message" => "An error occurred: " . $e->getMessage()));
}
?>
