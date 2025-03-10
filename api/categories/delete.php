<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(array("message" => "Missing Required Parameters"));
    exit();
}

// Check if the category exists
$category_query = "SELECT id FROM categories WHERE id = :id";
$category_stmt = $db->prepare($category_query);
$category_stmt->bindParam(':id', $data->id);
$category_stmt->execute();

if ($category_stmt->rowCount() == 0) {
    echo json_encode(array("message" => "category_id Not Found"));
    exit();
}

// Delete the category
$category = new Category($db);
$category->id = $data->id;

if ($category->delete()) {
    echo json_encode(array("id" => $category->id));
} else {
    echo json_encode(array("message" => "Category Not Deleted"));
}
?>
