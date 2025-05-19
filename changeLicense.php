<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

$driverid = $_GET['driverid'];

$query = "SELECT licensenum from driver where driverid='$driverid'";

$result = $con->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Delivery Information</title>
    <style>
        table { border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid black; }
    </style>
</head>

<body>
<h4>Delivery Information</h4>

<?php
if ($result->num_rows > 0) {
    echo "<table>
          <tr>
            <th>Old License Number</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>{$row['licensenum']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No License found.";
}
?>
<body>
<main>
    <h3>New license</h3>
    <p>*: required
    <form action="confirmLicense.php" method="post">
        <label>License Number:</label>
        <input type="text" name="licensenumber"><span>*</span><br>
        <input type="hidden" name="driverid" value="<?php echo $driverid; ?>">

        <div id="buttons">
            <p>
                <input type="submit" value="Change license">
            </p>
        </div>
    </form>
<p><a href="Driver.php">Back to Driver page</a></p>

<?php
$result->free();
$con->close();
?>
</body>
</html>
