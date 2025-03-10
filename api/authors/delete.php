<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

// Get JSON input
$data = json_decode(file_get_contents("php://input"));

// Validate that id is provided
if(empty($data->id)){
    echo json_encode(array("message" => "Missing Required Parameter: id"));
    exit();
}

$author = new Author($db);
$author->id = $data->id;

if($author->delete()){
    echo json_encode(array("message" => "Author Deleted"));
} else {
    echo json_encode(array("message" => "Author Not Deleted"));
}
?>
