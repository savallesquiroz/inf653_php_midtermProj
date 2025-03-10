<?php
class Author {
    private $conn;
    private $table = 'authors';

    // Object properties
    public $id;
    public $author;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Author
    public function create() {
        $query = "INSERT INTO " . $this->table . " (author) VALUES (:author)";
        $stmt = $this->conn->prepare($query);
        
        // Sanitize
        $this->author = htmlspecialchars(strip_tags($this->author));
        
        // Bind
        $stmt->bindParam(':author', $this->author);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Update Author
    public function update() {
        $query = "UPDATE " . $this->table . " SET author = :author WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
    // Delete Author
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    // (Optional) Read methods could be added here if needed.
}
?>
