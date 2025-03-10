<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->author)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

$author = new Author($db);

$author->author = $data->author;

if ($author->create()) {
    echo json_encode(array(
        "id" => $db->lastInsertId(),
        "author" => $author->author
    ));
} else {
    echo json_encode(array("message" => "Author Not Created"));
}
?>
