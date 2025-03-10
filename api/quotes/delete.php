<?php
$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['message' => 'Missing Required Parameters']);
    exit();
}

$query = "DELETE FROM quotes WHERE id = :id";
$stmt = $quote->conn->prepare($query);

if ($stmt->execute([':id' => $data->id])) {
    echo json_encode(['message' => 'Quote Deleted']);
} else {
    echo json_encode(['message' => 'Quote Not Deleted']);
}
?>
