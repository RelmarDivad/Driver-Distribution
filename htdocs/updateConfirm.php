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
$managerid = isset($_POST['manager']) ? $con->real_escape_string($_POST['manager']) : '';

if (empty($empid)) {
    die("No employee ID provided.");
}

try {
    // First, verify the employee exists
    $stmt_check = $con->prepare("SELECT manager FROM employee WHERE empid = ?");
    $stmt_check->bind_param("s", $empid);
    $stmt_check->execute();
    $EmpResult = $stmt_check->get_result();

    if ($EmpResult->num_rows == 1) {
        // Fetch current manager
        $current_manager = $EmpResult->fetch_assoc()['manager'];

        // Prepare update statement with proper parameter binding
        if ($current_manager == $managerid) {
            // If the new manager is the same as current, set to NULL
            $stmt_update = $con->prepare("UPDATE employee SET manager = NULL WHERE empid = ?");
            $stmt_update->bind_param("s", $empid);
        } else {
            // Otherwise, update to new manager
            $stmt_update = $con->prepare("UPDATE employee SET manager = ? WHERE empid = ?");
            $stmt_update->bind_param("ss", $managerid, $empid);
        }

        // Execute update
        $update_result = $stmt_update->execute();

        if (!$update_result) {
            throw new Exception("Update failed: " . $stmt_update->error);
        }

        $stmt_update->close();
    } else {
        throw new Exception("Employee not found.");
    }

    $stmt_check->close();
    $con->close();
} catch (Exception $e) {
    error_log("Manager update error: " . $e->getMessage());
    $update_result = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Updating Manager</title>
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
if ($update_result) {
    echo "<p class='success-message'>Employee $empid's manager has been updated successfully.</p>";
} else {
    echo "<p class='error-message'>Unable to update manager for employee $empid.</p>";
}
?>

<p><a href="manager.php" class="back-link">Go back to Manager Search page</a></p>
</body>
</html>
