<?php
if (!isset($_GET['id'])) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$author->id = $_GET['id'];
$result = $author->read();

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);
    echo json_encode([
        'id' => $id,
        'author' => $author
    ]);
} else {
    echo json_encode(['message' => 'Author ID Not Found']);
}
?>
