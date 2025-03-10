<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

// Validate required fields (both id and author are needed)
if(empty($data->id) || empty($data->author)){
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

$author = new Author($db);
$author->id = $data->id;
$author->author = $data->author;

if($author->update()){
    echo json_encode(array("message" => "Author Updated"));
} else {
    echo json_encode(array("message" => "Author Not Updated"));
}
?>
