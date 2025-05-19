<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

if ($con->connect_error) {
    echo "Connection error";
}

$truckid = $_POST['truckid'];
$regionId = $_POST['regionid'];
$productid = $_POST['productid'];






$man_query = "INSERT INTO delivery
  	     (truckid, regionid, productid)
	    VALUES
	     ('$truckid', '$regionId', '$productid')";

try {

    $con->query($man_query);

    echo "New Delivery created successfully";

} catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    $msg = "An error occurred: ".$error_message;
}

$con->close();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Added New Delivery</title>
</head>
<body>

<p>
    <?php echo $msg."<br><p>";
    echo '<a href="Driver.php">Go back to Driver Search page.</a>';
    ?>

</body>
</html>

