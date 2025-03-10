<?php
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

$data = json_decode(file_get_contents("php://input"));

$query = "SELECT q.id, q.quote, a.author, c.category
          FROM quotes q
          JOIN authors a ON q.author_id = a.id
          JOIN categories c ON q.category_id = c.id
          WHERE q.id = :id";

$stmt = $db->prepare($query);
$stmt->bindParam(':id', $_GET['id']);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
    $quote_item = array(
        "id" => $id,
        "quote" => $quote,
        "author" => $author,
        "category" => $category
    );
    echo json_encode($quote_item);
} else {
    echo json_encode(array("message" => "No Quotes Found"));
}
?>
