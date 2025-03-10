<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->category)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

$category = new Category($db);

$category->category = $data->category;

if ($category->create()) {
    echo json_encode(array(
        "id" => $db->lastInsertId(),
        "category" => $category->category
    ));
} else {
    echo json_encode(array("message" => "Category Not Created"));
}
?>
