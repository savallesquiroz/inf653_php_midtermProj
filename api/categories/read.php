<?php
$result = $category->read();
$num = $result->rowCount();

if ($num > 0) {
    $categories_arr = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $categories_arr[] = [
            'id' => $id,
            'category' => $category
        ];
    }
    echo json_encode($categories_arr);
} else {
    echo json_encode(['message' => 'No Categories Found']);
}
?>
