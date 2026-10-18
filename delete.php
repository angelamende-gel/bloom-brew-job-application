<?php
// Connect to the database using PDO
require_once "dbconfig.php";

// Accept deletion requests only through POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Get and validate the application ID
$id = filter_input(INPUT_POST, "application_id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Invalid application ID.");
}

// Delete the selected application using a prepared statement
$sql = "DELETE FROM job_applications WHERE application_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([":id" => $id]);

// Return to the applications table
header("Location: index.php");
exit;
?>
