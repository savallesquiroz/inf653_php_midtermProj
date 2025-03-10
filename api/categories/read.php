<?php
require_once '../../config/Database.php';
// (Optionally, include the Category model:
// require_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$query = "SELECT id, category FROM categories";
$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if($num > 0){
    $categories_arr = array();
    $categories_arr["data"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $category_item = array(
            "id" => $id,
            "category" => $category
        );
        array_push($categories_arr["data"], $category_item);
    }
    echo json_encode($categories_arr);
} else {
    echo json_encode(array("message" => "No categories found."));
}
?>
