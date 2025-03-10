<?php
class Category {
    private $conn;
    private $table = 'categories';

    // Object properties
    public $id;
    public $category;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create Category
    public function create() {
        $query = "INSERT INTO " . $this->table . " (category) VALUES (:category)";
        $stmt = $this->conn->prepare($query);
        
        $this->category = htmlspecialchars(strip_tags($this->category));
        
        $stmt->bindParam(':category', $this->category);
        
        if ($stmt->execute()){
            return true;
        }
        return false;
    }
    
    // Update Category
    public function update() {
        $query = "UPDATE " . $this->table . " SET category = :category WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    
    // Delete Category
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
}
?>
