<?php
// Connect to the database
require_once "dbconfig.php";

// Retrieve all job applications, newest first
$sql = "SELECT * FROM job_applications ORDER BY date_added DESC";
$stmt = $pdo->query($sql);
$applications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloom & Brew - Job Application</title>
</head>
<body>

    <h1>Bloom & Brew</h1>
    <h2>Job Application Form</h2>
    <p>Apply to join our café and flower shop team!</p>

    <form action="insert.php" method="POST">
        <label>First Name:</label>
        <input type="text" name="first_name" required>
        <br><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Phone:</label>
        <input type="text" name="phone" required>
        <br><br>

        <label>Position Applied:</label>
        <input type="text" name="position_applied" required>
        <br><br>

        <label>Department:</label>
        <select name="department" required>
            <option value="">Select Department</option>
            <option value="Cafe">Café</option>
            <option value="Flower Shop">Flower Shop</option>
        </select>
        <br><br>

        <label>Years of Experience:</label>
        <input type="number" name="years_experience" min="0" value="0" required>
        <br><br>

        <button type="submit">Submit Application</button>
    </form>

    <hr>

    <h2>Job Applications</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Department</th>
            <th>Experience</th>
            <th>Date Added</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($applications as $app): ?>
        <tr>
            <td><?= htmlspecialchars($app['application_id']) ?></td>
            <td><?= htmlspecialchars($app['first_name']) ?></td>
            <td><?= htmlspecialchars($app['last_name']) ?></td>
            <td><?= htmlspecialchars($app['email']) ?></td>
            <td><?= htmlspecialchars($app['phone']) ?></td>
            <td><?= htmlspecialchars($app['position_applied']) ?></td>
            <td><?= htmlspecialchars($app['department']) ?></td>
            <td><?= htmlspecialchars($app['years_experience']) ?></td>
            <td><?= htmlspecialchars($app['date_added']) ?></td>
           
<td>
    <!-- Link to edit the selected application -->
    <a href="edit.php?id=<?= (int)$app['application_id'] ?>">Edit</a> |

    <!-- Form to delete the selected application securely -->
    <form action="delete.php" method="POST"
          onsubmit="return confirm('Delete this application?');"
          style="display:inline;">

        <input type="hidden" name="application_id"
               value="<?= (int)$app['application_id'] ?>">

        <button type="submit">Delete</button>
    </form>
</td>

        </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
