<?php
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

$query = "SELECT id, author FROM authors";
$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $authors_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $author_item = array(
            "id" => $id,
            "author" => $author
        );
        array_push($authors_arr, $author_item);
    }
    echo json_encode($authors_arr);
} else {
    echo json_encode(array());
}
?>
