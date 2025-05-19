<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

$driverid = $_POST['driverid'];
$regionid = $_POST['regionid'];

// Get the truck ID first
$findTruckid = "SELECT drivertruck FROM driver WHERE driverid = '$driverid'";
$truckResult = $con->query($findTruckid);
$row = $truckResult->fetch_assoc();
$truckid = $row['drivertruck'];  // Store the truck ID in a variable

// Now use the truck ID in the delete query
$query = "DELETE FROM truckservice WHERE truckid = '$truckid' AND regionid = '$regionid'";
$result = $con->query($query);

if ($result && $con->affected_rows > 0) {
    $message = "Region deleted successfully";
} else {
    $message = "Delete failed. Please try again.";
}

$truckResult->free();  // Free the first result set
$con->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>License Update Result</title>
</head>
<body>
<h3><?php echo $message; ?></h3>
<a href="Driver.php">Return to Driver page</a>
</body>
</html>
