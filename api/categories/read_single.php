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
          WHERE q.category_id = :category_id";

$stmt = $db->prepare($query);
$stmt->bindParam(':category_id', $_GET['category_id']);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $quotes_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quote_item = array(
            "id" => $id,
            "quote" => $quote,
            "author" => $author,
            "category" => $category
        );
        array_push($quotes_arr, $quote_item);
    }
    echo json_encode($quotes_arr);
} else {
    echo json_encode(array());
}
?>
