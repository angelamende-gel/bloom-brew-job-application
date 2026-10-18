
<?php
// Connect to the database
require_once "dbconfig.php";

// Get the application ID from the URL
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Invalid application ID.");
}

// Retrieve the selected application
$stmt = $pdo->prepare(
    "SELECT * FROM job_applications WHERE application_id = :id"
);
$stmt->execute([":id" => $id]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);

// Stop if the application does not exist
if (!$app) {
    die("Application not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application - Bloom & Brew</title>
</head>
<body>

    <h1>Bloom & Brew</h1>
    <h2>Edit Job Application</h2>

    <!-- Send the updated information to update.php -->
    <form action="update.php" method="POST">

        <!-- Keep track of which application is being edited -->
        <input type="hidden" name="application_id"
               value="<?= htmlspecialchars((string)$app['application_id']) ?>">

        <label>First Name:</label>
        <input type="text" name="first_name"
               value="<?= htmlspecialchars($app['first_name']) ?>" required>
        <br><br>

        <label>Last Name:</label>
        <input type="text" name="last_name"
               value="<?= htmlspecialchars($app['last_name']) ?>" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email"
               value="<?= htmlspecialchars($app['email']) ?>" required>
        <br><br>

        <label>Phone:</label>
        <input type="text" name="phone"
               value="<?= htmlspecialchars($app['phone']) ?>" required>
        <br><br>

        <label>Position Applied:</label>
        <input type="text" name="position_applied"
               value="<?= htmlspecialchars($app['position_applied']) ?>" required>
        <br><br>

        <label>Department:</label>
        <select name="department" required>
            <option value="Cafe"
                <?= $app['department'] === 'Cafe' ? 'selected' : '' ?>>Café</option>
            <option value="Flower Shop"
                <?= $app['department'] === 'Flower Shop' ? 'selected' : '' ?>>Flower Shop</option>
        </select>
        <br><br>

        <label>Years of Experience:</label>
        <input type="number" name="years_experience" min="0"
               value="<?= htmlspecialchars((string)$app['years_experience']) ?>" required>
        <br><br>

        <button type="submit">Update Application</button>
    </form>

    <p><a href="index.php">Back to Applications</a></p>

</body>
</html>
