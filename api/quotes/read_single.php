<?php
if (!isset($_GET['id'])) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$quote->id = $_GET['id'];
$result = $quote->read();

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);
    echo json_encode([
        'id' => $id,
        'quote' => $quote,
        'author' => $author,
        'category' => $category
    ]);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
?>
