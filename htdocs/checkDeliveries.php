<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

$driverid = $_GET['driverid'];

$query = "SELECT d.truckid, d.regionid, d.productid 
          FROM delivery d, driver dr  
          WHERE dr.driverid = '$driverid' 
          AND d.truckid = dr.drivertruck";

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
            <th>Truck Number</th>
            <th>Region</th>
            <th>Product</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>{$row['truckid']}</td>
              <td>{$row['regionid']}</td>
              <td>{$row['productid']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No deliveries found.";
}
?>

<p><a href="Driver.php">Back to Driver page</a></p>

<?php
$result->free();
$con->close();
?>
</body>
</html>
