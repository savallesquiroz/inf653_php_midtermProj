<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if(empty($data->id)){
    echo json_encode(array("message" => "Missing Required Parameter: id"));
    exit();
}

$category = new Category($db);
$category->id = $data->id;

if($category->delete()){
    echo json_encode(array("message" => "Category Deleted"));
} else {
    echo json_encode(array("message" => "Category Not Deleted"));
}
?>
