<?php
  $host = "localhost";
  $user = "root";
  $pw = "root";
  $db = "storesupply";

  $con = new mysqli($host, $user, $pw, $db);

  if ($con->connect_error) {
    echo "Connection error";
  }
  
  $empid = $_POST['empid'];
  $Fname = $_POST['fname'];
  $Lname = $_POST['lname'];
  $storeID = $_POST['StoreID'];
  $regionID = $_POST['RegionID'];
  $manager = $_POST['manager'];

  $DOH = $_POST['DOH'];



  
  
  $man_query = "INSERT INTO employee
  	     (empid, fname, lname, dateofhire, storenum, regionid, manager)
	    VALUES
	     ('$empid', '$Fname', '$Lname', '$DOH', '$storeID', '$regionID',
	      '$manager')";

  try {

  $con->query($man_query);

echo "New Employee created successfully";

  } catch (mysqli_sql_exception $e) {
    $error_message = $e->getMessage();
    $msg = "An error occurred: ".$error_message;
  }

  $con->close();
  

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Added New Manager</title>
  </head>
  <body>

	<p>
	<?php echo $msg."<br><p>";
	      echo '<a href="manager.php">Go back to Manager Search page.</a>';
	?>

  </body>
</html>
