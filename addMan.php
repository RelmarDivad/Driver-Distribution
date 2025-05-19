<?php
 $host = "localhost";
 $user = "root";
 $pw = "root";
 $db = "storesupply";

 $con = new mysqli($host, $user, $pw, $db);


$query = "SELECT * FROM employee";
$result = $con->query($query);
$rows = $result->num_rows;

?>


<!DOCTYPE html>
<html>

  <head>
    <title>Adding New Employee</title>
    <link rel="stylesheet" href="main.css">
  </head>
  
  <body>
    <main>
        <h3>Adding an Employee (There are currently <?php echo $rows?> Employees Total) </h3>
      <p>*: required
      <form action="confirmNewMan.php" method="post">
	<div id="data">
	  <label>Employee ID:</label>
	  <input type="text" name="empid"><span>*</span><br>

	  <label>First name:</label>
	  <input type="text" name="fname"><span>*</span><br>

	  <label>Last name:</label>
	  <input type="text" name="lname"><span>*</span><br>

	  <label>Date of hire:</label>
	  <input type="text" name="DOH" placeholder="YYYY-MM-DD"><span>*</span><br>

        <label>Manager:</label>
        <input type="text" name="manager"><span>*</span><br>

	  <label>StoreID:</label>
	  <input type="text" name="StoreID"><span>*</span><br>

	  <label>RegionID:</label>
	  <input type="text" name="RegionID"><br>

	</div>





	<div id="buttons">
	  <p>
	  <input type="submit" value="Add Manager"><br>
	  <p>
	  <a href="manager.php">Go back to Manager Search page.</a>
	</div>
	
	</form>
      </main>

     <?php
       $con->close();
     ?>
    
    </body>
 </html>
