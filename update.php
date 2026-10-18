
<?php
// Connect to the database
require_once "dbconfig.php";

// Process the update only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get the application ID and updated form values
    $id = filter_input(INPUT_POST, "application_id", FILTER_VALIDATE_INT);
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $position_applied = trim($_POST["position_applied"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $years_experience = filter_input(
        INPUT_POST, "years_experience", FILTER_VALIDATE_INT
    );

    // Validate the submitted information
    if (
        !$id || $id < 1 ||
        $first_name === "" ||
        $last_name === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        $phone === "" ||
        $position_applied === "" ||
        !in_array($department, ["Cafe", "Flower Shop"], true) ||
        $years_experience === false ||
        $years_experience === null ||
        $years_experience < 0
    ) {
        die("Invalid information. Please go back and check the form.");
    }

    // Update the selected application using a prepared statement
    $sql = "UPDATE job_applications
            SET first_name = :first_name,
                last_name = :last_name,
                email = :email,
                phone = :phone,
                position_applied = :position_applied,
                department = :department,
                years_experience = :years_experience
            WHERE application_id = :id";

    $stmt = $pdo->prepare($sql);

    // Save the updated values to the database
    $stmt->execute([
        ":first_name" => $first_name,
        ":last_name" => $last_name,
        ":email" => $email,
        ":phone" => $phone,
        ":position_applied" => $position_applied,
        ":department" => $department,
        ":years_experience" => $years_experience,
        ":id" => $id
    ]);

    // Return to the applications table
    header("Location: index.php");
    exit;
}

// Redirect if update.php is opened directly
header("Location: index.php");
exit;
?>
