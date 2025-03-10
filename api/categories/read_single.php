<?php
require_once '../../config/Database.php';
require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$query = "SELECT id, category FROM categories WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $category_item = array(
        "id" => $id,
        "category" => $category
    );
    echo json_encode($category_item);
} else {
    echo json_encode(array("message" => "category_id Not Found"));
}
?>
