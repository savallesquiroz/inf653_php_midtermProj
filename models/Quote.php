<?php
class Quote {
    private $conn;
    private $table = 'quotes';

    // Properties
    public $id;
    public $quote;
    public $author_id;
    public $category_id;
    public $author;    // for join results
    public $category;  // for join results

    public function __construct($db) {
        $this->conn = $db;
    }

    // Read All with joins - returns id, quote, author, category
    public function read() {
        $query = "SELECT q.id, q.quote, a.author, c.category 
                  FROM " . $this->table . " q 
                  JOIN authors a ON q.author_id = a.id 
                  JOIN categories c ON q.category_id = c.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // For a single record (using id)
    public function read_single() {
        $query = "SELECT q.id, q.quote, a.author, c.category 
                  FROM " . $this->table . " q 
                  JOIN authors a ON q.author_id = a.id 
                  JOIN categories c ON q.category_id = c.id 
                  WHERE q.id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->quote    = $row['quote'];
            $this->author   = $row['author'];
            $this->category = $row['category'];
        }
    }

    // Create, update, and delete similarly...
}
?>
