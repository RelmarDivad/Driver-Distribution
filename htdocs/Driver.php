<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

$query = "SELECT driverid, drivername FROM driver";
$result = $con->query($query);
$drivers = [];
while ($row = $result->fetch_assoc()) {
    $drivers[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Search</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { margin: 15px 0; padding: 10px; background: #f4f4f4; }
        .links { margin-top: 20px; }
        .links a { margin-right: 10px; }
    </style>
</head>

<body>
<h1>Drivers</h1>
<p>There are <?php echo count($drivers); ?> Drivers</p>

<h4>View Delivery Information: </h4>
<form action="checkDeliveries.php">
    <select name="driverid">
        <option value="">Select a Driver</option>
        <?php
        foreach ($drivers as $driver) {
            echo "<option value='".$driver['driverid']."'>".$driver['drivername']."</option>";
        }
        ?>
    </select>
    <input type="submit" value="Get Delivery Information">
</form>

<h4>Update License:</h4>
<form method = "get" action="changeLicense.php">
    <select name="driverid">
        <option value="">Select a Driver</option>
        <?php
        foreach ($drivers as $driver) {
            echo "<option value='".$driver['driverid']."'>".$driver['drivername']."</option>";
        }
        ?>
    </select>
    <input type="submit" value="Update License">
</form>

<div class="links">
    <a href="deliveryCheckin.php">Add Delivery</a>
    <a href="deleteRegion.php">Remove delivery region</a>
    <a href="index.php">Back to Navigation Menu</a>
</div>

<?php
$result->free();
$con->close();
?>
</body>
</html>
