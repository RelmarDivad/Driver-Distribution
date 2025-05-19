<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

// Improved error handling for database connection
$con = new mysqli($host, $user, $pw, $db);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Query to get distinct manager employee IDs
$query = "SELECT DISTINCT m.empid, m.Fname, m.LName FROM employee m, employee s WHERE m.empid = s.manager";
$result = $con->query($query);
$rows = $result->num_rows;

// Store results in an array to reuse
$managers = [];
$result->data_seek(0);
while ($row = $result->fetch_assoc()) {
    $managers[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Search</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        form {
            margin-bottom: 20px;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 5px;
        }
        select {
            margin-right: 10px;
        }
        .links {
            margin-top: 20px;
        }
        .links a {
            margin-right: 10px;
            text-decoration: none;
            color: #0066cc;
        }
    </style>
</head>

<body>
<h1>Store Employees</h1>
<?php echo "<p>There are $rows Managers</p>"; ?>

<h4>View Manager Information: </h4>
<form method="get" action="manView.php">
    <select name="empid" required>
        <option value="">Select a Manager</option>
        <?php
        foreach ($managers as $manager) {
            echo "<option value='".htmlspecialchars($manager['empid'])."'>".
                htmlspecialchars($manager['empid']) . " - " .
                htmlspecialchars($manager['Fname']) . " " .
                htmlspecialchars($manager['LName']) .
                "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Get Employee Information">
</form>

<h4>Update Manager: </h4>
<form method="get" action="manUpdate.php">
    <select name="empid" required>
        <option value="">Select a Manager</option>
        <?php
        foreach ($managers as $manager) {
            echo "<option value='".htmlspecialchars($manager['empid'])."'>".
                htmlspecialchars($manager['empid']) . " - " .
                htmlspecialchars($manager['Fname']) . " " .
                htmlspecialchars($manager['LName']) .
                "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Update Association">
</form>

<div class="links">
    <a href="addMan.php">Add a New Employee</a>
    <a href="index.php">Back to Navigation Menu</a>
</div>

<?php
// Close database connection
$result->free();
$con->close();
?>
</body>
</html>
