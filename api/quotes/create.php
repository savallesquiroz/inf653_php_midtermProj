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
        // Fetch the last inserted quote to get the complete data
        $last_id = $db->lastInsertId();
        $fetch_query = "SELECT q.id, q.quote, a.author, c.category
                        FROM quotes q
                        JOIN authors a ON q.author_id = a.id
                        JOIN categories c ON q.category_id = c.id
                        WHERE q.id = :id";
        $fetch_stmt = $db->prepare($fetch_query);
        $fetch_stmt->bindParam(':id', $last_id);
        $fetch_stmt->execute();
        $quote_data = $fetch_stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode($quote_data);
    } else {
        echo json_encode(array("message" => "Quote Not Created"));
    }
} catch (Exception $e) {
    echo json_encode(array("message" => "An error occurred: " . $e->getMessage()));
}
?>
