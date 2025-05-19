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
    <title>Which Driver delivered?</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        form { margin: 15px 0; padding: 10px; background: #f4f4f4; }
        .links { margin-top: 20px; }
        .links a { margin-right: 10px; }
    </style>
</head>

<body>
<h1>Drivers</h1>


<h4>Add Delivery: </h4>
<form method = "post" action="addDelivery.php">
    <select name="driverid">
        <option value="">Select a Driver</option>
        <?php
        foreach ($drivers as $driver) {
            echo "<option value='".$driver['driverid']."'>".$driver['drivername']."</option>";
        }
        ?>
    </select>
    <input type="submit" value="Add Delivery">
</form>


<?php
$result->free();
$con->close();
?>
</body>
</html>
