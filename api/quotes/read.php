<?php
// For example, in read.php for quotes:
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

// This query selects the id, quote, and join with authors and categories to get the names.
$query = "SELECT q.id, q.quote, a.author, c.category
          FROM quotes q
          JOIN authors a ON q.author_id = a.id
          JOIN categories c ON q.category_id = c.id";

$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $quotes_arr = array();
    $quotes_arr['data'] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // This will create variables: $id, $quote, $author, $category
        extract($row);

        $quote_item = array(
            'id' => $id,
            'quote' => $quote,
            // Use the author name and category name directly from the extracted variables:
            'author' => $author,
            'category' => $category
        );

        array_push($quotes_arr['data'], $quote_item);
    }
    echo json_encode($quotes_arr);
} else {
    echo json_encode(array('message' => 'No Quotes Found'));
}
?>
