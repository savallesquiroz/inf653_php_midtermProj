<?php
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$query = "DELETE FROM authors WHERE id = :id";
$stmt = $author->conn->prepare($query);

if ($stmt->execute([':id' => $data->id])) {
    echo json_encode(['message' => 'Author Deleted']);
} else {
    echo json_encode(['message' => 'Author Not Deleted']);
}
?>
