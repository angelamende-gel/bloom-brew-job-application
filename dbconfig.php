<?php
// Database connection settings
$host = "localhost";
$dbname = "bloom_brew_db";
$username = "root";
$password = ""; // Default XAMPP MySQL password is usually empty

try {
    // Connect to MySQL using PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // Enable PDO exceptions for database errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Display an error if the database connection fails
    die("Database connection failed: " . $e->getMessage());
}
?>
