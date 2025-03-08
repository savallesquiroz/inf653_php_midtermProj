<?php
$result = $quote->read();
$num = $result->rowCount();

if ($num > 0) {
    $quotes_arr = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $quotes_arr[] = [
            'id' => $id,
            'quote' => $quote,
            'author' => $author,
            'category' => $category
        ];
    }
    echo json_encode($quotes_arr);
} else {
    echo json_encode(['message' => 'No Quotes Found']);
}
?>
