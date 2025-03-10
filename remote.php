<?php
try {
    $conn = new PDO(
        "pgsql:host=" . getenv('DB_HOST') . ";port=5432;dbname=" . getenv('DB_NAME') . ";sslmode=require",
        getenv('DB_USER'),
        getenv('DB_PASS')
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connection successful!";
} catch (PDOException $e) {
    echo "Connection Error: " . $e->getMessage();
}
?>
