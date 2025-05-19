<?php
$host = "localhost";
$user = "root";
$pw = "root";
$db = "storesupply";

$con = new mysqli($host, $user, $pw, $db);

$driverid = $_POST['driverid'];
$query = "SELECT r.regionid, r.regionname FROM region r, driver d, truckservice t WHERE d.drivertruck=t.truckid and d.driverid='$driverid' and t.regionid=r.regionid";
$result = $con->query($query);
$regions = [];
while ($row = $result->fetch_assoc()) {
    $regions[] = $row;
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


<h4>Select Region: </h4>
<form method = "post" action="regDelConfirm.php">
    <select name="regionid">
        <option value="">Select a Region</option>
        <?php
        foreach ($regions as $region) {
            echo "<option value='".$region['regionid']."'>".$region['regionname']."</option>";
        }
        ?>
    </select>
    <input type = "hidden" name = "driverid" value = "<?php echo $driverid ?>">
    <input type="submit" value="Confirm Region">
</form>

<a href="Driver.php">Go back to Driver Search page.</a>
<?php
$result->free();
$con->close();
?>
</body>
</html>
