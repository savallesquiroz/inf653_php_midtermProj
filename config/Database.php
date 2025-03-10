<?php
class Database {
    private $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "pgsql:host=" . getenv('DB_HOST') . ";port=5432;dbname=" . getenv('DB_NAME') . ";sslmode=require",
                getenv('DB_USER'),
                getenv('DB_PASS')
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
            exit();
        }
        return $this->conn;
    }
}
?>
