<?php
// Connect to the database
require_once "dbconfig.php";

// Process the form only when submitted using POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get and clean the submitted form values
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $position_applied = trim($_POST["position_applied"]);
    $department = trim($_POST["department"]);
    $years_experience = (int) $_POST["years_experience"];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO job_applications
            (first_name, last_name, email, phone,
             position_applied, department, years_experience)
            VALUES
            (:first_name, :last_name, :email, :phone,
             :position_applied, :department, :years_experience)";

    $stmt = $pdo->prepare($sql);

    // Execute the statement with the applicant's information
    $stmt->execute([
        ":first_name" => $first_name,
        ":last_name" => $last_name,
        ":email" => $email,
        ":phone" => $phone,
        ":position_applied" => $position_applied,
        ":department" => $department,
        ":years_experience" => $years_experience
    ]);

    // Return to the main page after saving
    header("Location: index.php");
    exit;
}

// Redirect to the form if the page is opened directly
header("Location: index.php");
exit;
?>
