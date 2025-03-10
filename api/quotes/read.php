<?php
// Include required files for DB connection and model
require_once '../../config/Database.php';
require_once '../../models/Quote.php';

$database = new Database();
$db = $database->connect();

// Query to get all quotes with their associated authors and categories
$query = "SELECT q.id, q.quote, a.author, c.category
          FROM quotes q
          JOIN authors a ON q.author_id = a.id
          JOIN categories c ON q.category_id = c.id";
$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if($num > 0) {
    $quotes_arr = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract the data for each row
        extract($row);

        $quote_item = array(
            "id" => $id,
            "quote" => $quote,
            "author" => $author,
            "category" => $category
        );

        array_push($quotes_arr, $quote_item);
    }
    echo json_encode($quotes_arr); // Return the array directly
} else {
    echo json_encode([]); // Return an empty array if no quotes are found
}
?>
