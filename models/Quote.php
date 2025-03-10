<?php
class Quote {
    // Database connection and table name
    private $conn;
    private $table = 'quotes';

    // Object properties
    public $id;
    public $quote;
    public $author_id;
    public $category_id;

    // Constructor with DB connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Create quote method
    public function create() {
        // Create query
        $query = "INSERT INTO " . $this->table . " (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Sanitize inputs
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        
        // Bind parameters
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        
        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update an existing quote
    public function update() {
        // Create the query for updating the quote record by id
        $query = "UPDATE " . $this->table . " 
                SET quote = :quote, author_id = :author_id, category_id = :category_id 
                WHERE id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind parameters
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);

        // Execute the query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Delete a quote by id
    public function delete() {
        // Create the query
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Sanitize id
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind the id parameter
        $stmt->bindParam(':id', $this->id);

        // Execute query and return result (true if successful, false otherwise)
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>
