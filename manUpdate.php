<?php
// Database connection
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

// Improved error handling for database connection
$con = new mysqli($host, $user, $pw, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Validate and sanitize manager ID
$managerid = isset($_GET['empid']) ? $con->real_escape_string($_GET['empid']) : '';

if (empty($managerid)) {
    die("No manager ID provided.");
}

// Query to get all employees
$man_query = "SELECT * FROM employee";
$man_result = $con->query($man_query);
$man_rows = $man_result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee Associations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        form {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        select {
            margin-right: 10px;
            padding: 5px;
            width: 300px;
        }
        .back-link {
            display: block;
            margin-top: 20px;
        }
        .page-title {
            color: #333;
        }
    </style>
</head>

<body>
<h1 class="page-title">Manage Employee Associations</h1>

<?php if ($man_rows > 0) { ?>
    <form method="post" action="updateConfirm.php">
        <label for="empid">Select Employee to Update:</label>
        <select name="empid" id="empid" required>
            <option value="">Select an Employee ID</option>
            <?php
            // Fetch and display all employee IDs
            $man_result->data_seek(0);
            while ($empid = $man_result->fetch_assoc()) {
                echo "<option value='".htmlspecialchars($empid['empid'])."'>".
                    htmlspecialchars($empid['empid']) . " - " .
                    htmlspecialchars($empid['Fname']) . " " .
                    htmlspecialchars($empid['LName']) .
                    " (Current Manager: " .
                    htmlspecialchars($empid['manager'] ?? 'None') .
                    ")</option>";
            }
            ?>
        </select>

        <!-- Hidden input to pass the current manager ID -->
        <input type="hidden" name="manager" value="<?php echo htmlspecialchars($managerid); ?>">

        <input type="submit" value="Update Employee Association">
    </form>
<?php } else { ?>
    <p>No employees found in the database.</p>
<?php } ?>

<a href="manager.php" class="back-link">Go back to Manager Search page</a>

<?php
// Close connection
$con->close();
?>
</body>
</html>