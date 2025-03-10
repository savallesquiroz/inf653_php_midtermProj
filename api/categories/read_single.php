<?php
if (!isset($_GET['id'])) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$category->id = $_GET['id'];
$result = $category->read();

if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
    extract($row);
    echo json_encode([
        'id' => $id,
        'category' => $category
    ]);
} else {
    echo json_encode(['message' => 'Category ID Not Found']);
}
?>
