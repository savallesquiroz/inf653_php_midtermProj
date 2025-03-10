<?php
// Include required files for DB connection and model
require_once '../../config/Database.php';
// (Optionally, if you have an Author model, include it:
// require_once '../../models/Author.php';

$database = new Database();
$db = $database->connect();

// Query to get all authors
$query = "SELECT id, author FROM authors";
$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if($num > 0){
    $authors_arr = array();
    $authors_arr["data"] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // This will extract $id and $author
        extract($row);
        $author_item = array(
            "id" => $id,
            "author" => $author
        );
        array_push($authors_arr["data"], $author_item);
    }
    echo json_encode($authors_arr);
} else {
    echo json_encode(array("message" => "No authors found."));
}
?>
