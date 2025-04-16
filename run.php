<?php
try {
    $conn = new PDO("pgsql:host=127.0.0.1; dbname=makemytrip", "postgres", "rp120604");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful!";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
