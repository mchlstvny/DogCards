<?php
$dsn = "mysql:host=127.0.0.1;port=8889;dbname=dog_db;charset=utf8mb4";
$username = "root";
$password = "root";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
