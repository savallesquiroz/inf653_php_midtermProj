<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id) || !isset($data->author)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

// Check if the author exists
$author_query = "SELECT id FROM authors WHERE id = :id";
$author_stmt = $db->prepare($author_query);
$author_stmt->bindParam(':id', $data->id);
$author_stmt->execute();

if ($author_stmt->rowCount() == 0) {
    echo json_encode(array("message" => "author_id Not Found"));
    exit();
}

// Update the author
$author = new Author($db);

$author->id = $data->id;
$author->author = $data->author;

if ($author->update()) {
    echo json_encode(array(
        "id" => $author->id,
        "author" => $author->author
    ));
} else {
    echo json_encode(array("message" => "Author Not Updated"));
}
?>
