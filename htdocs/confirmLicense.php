<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

$driverid = $_POST['driverid'];
$licensenum = $_POST['licensenumber'];

// Do the update
$query = "UPDATE driver SET licensenum = '$licensenum' WHERE driverid = '$driverid'";
$result = $con->query($query);

if ($result && $con->affected_rows > 0) {
    $message = "License number updated successfully";
} else {
    $message = "Update failed. Please try again.";
}

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
