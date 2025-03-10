<?php
// Include required files for DB connection and Author model
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

// Validate the required field
if(empty($data->author)){
    echo json_encode(array("message" => "Missing Required Parameter: author"));
    exit();
}

$author = new Author($db);
$author->author = $data->author;

if($author->create()){
    echo json_encode(array(
         "id" => $db->lastInsertId(),
         "author" => $author->author
    ));
} else {
    echo json_encode(array("message" => "Author Not Created"));
}
?>
