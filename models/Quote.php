<?php
class Quote {
    private $conn;
    private $table = 'quotes';

    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT 
                    q.id, q.quote, 
                    a.author, c.category 
                  FROM " . $this->table . " q 
                  JOIN authors a ON q.author_id = a.id 
                  JOIN categories c ON q.category_id = c.id 
                  ORDER BY q.id ASC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
