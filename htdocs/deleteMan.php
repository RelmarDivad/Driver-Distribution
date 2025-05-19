<?php
// Database connection
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

// Improved error handling and connection
$con = new mysqli($host, $user, $pw, $db);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Validate and sanitize input
$empid = isset($_POST['empid']) ? $con->real_escape_string($_POST['empid']) : '';

if (empty($empid)) {
    die("No employee ID provided.");
}

// Use prepared statement for safer querying
$stmt_check = $con->prepare("SELECT manager FROM employee WHERE empid = ?");
$stmt_check->bind_param("s", $empid);
$stmt_check->execute();
$EmpResult = $stmt_check->get_result();
$Emp_Rows = $EmpResult->num_rows;

// Flag to track success
$deletion_successful = false;

try {
    if ($Emp_Rows == 1) {
        // Prepare delete statement
        $stmt_update = $con->prepare("DELETE FROM employee WHERE empid = ?");
        $stmt_update->bind_param("s", $empid);
        $deletion_successful = $stmt_update->execute();

        // Close the update statement
        $stmt_update->close();
    }
} catch (mysqli_sql_exception $e) {
    // Log the error or handle it appropriately
    error_log("Deletion error: " . $e->getMessage());
}

// Close initial statement and connection
$stmt_check->close();
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .success-message {
            color: green;
            font-weight: bold;
        }
        .error-message {
            color: red;
            font-weight: bold;
        }
        .back-link {
            margin-top: 20px;
            display: block;
        }
    </style>
</head>
<body>
<?php
if ($deletion_successful) {
    echo "<p class='success-message'>Employee $empid has been updated successfully.</p>";
} else {
    echo "<p class='error-message'>Unable to update employee $empid.</p>";
}
?>

<p><a href="manager.php" class="back-link">Go back to Manager Search page</a></p>
</body>
</html>
