<?php
// Database connection
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);


$driverid = $_POST['driverid'];
$query = "SELECT drivername, drivertruck FROM driver WHERE driverid = '$driverid'";
$result = $con->query($query);
$row = $result->fetch_assoc();
$drivername = $row['drivername'];
$drivertruck = $row['drivertruck'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Adding New Delivery</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<main>
    <h3>Hello <?php echo $drivername ?>, Add Delivery Information</h3>
    <p>* required</p>

    <form action="confirmDelivery.php" method="post">
        <div id="data">
            <label>Region ID:</label>
            <input type="text" name="regionid">*<br>

            <label>Product ID:</label>
            <input type="text" name="productid">*<br>


            <input type="hidden" name="truckid" value = "<?php echo $drivertruck ?>">*<br>
        </div>

        <div id="buttons">
            <p>
                <input type="submit" value="Add Delivery"><br>
            </p>
            <p>
                <a href="Driver.php">Go back to Driver Dashboard</a>
            </p>
        </div>
    </form>
</main>
</body>
</html>
<?php
$result->free();
$con->close();
?>
