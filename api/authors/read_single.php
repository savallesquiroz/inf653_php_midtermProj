<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$query = "SELECT id, author FROM authors WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $author_item = array(
        "id" => $id,
        "author" => $author
    );
    echo json_encode($author_item);
} else {
    echo json_encode(array("message" => "author_id Not Found"));
}
?>
