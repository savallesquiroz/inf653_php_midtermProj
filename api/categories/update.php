<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if(empty($data->id) || empty($data->category)){
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

$category = new Category($db);
$category->id = $data->id;
$category->category = $data->category;

if($category->update()){
    echo json_encode(array("message" => "Category Updated"));
} else {
    echo json_encode(array("message" => "Category Not Updated"));
}
?>
