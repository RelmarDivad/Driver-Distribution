<?php
  $host = "localhost";
  $user = "root";
  $pw = "root";
  $db = "storesupply";

  $con = new mysqli($host, $user, $pw, $db);

  $managerid = $_GET['empid'];
  
  $man_query = "SELECT * FROM employee where manager = '$managerid'";
  $man_result = $con->query($man_query);
  $man_rows = $man_result->num_rows;

  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>View Manager Information</title>
  </head>

  <body>
    <h4>Manager Information</h4>

    <?php  
     if ($man_rows > 0) {
     echo "<table border='1' cellpadding='10'>";
     echo "<tr> 
	<th> Employee ID </th>
       	<th> First Name</th>
	<th> Last Name</th>
	<th> DOH </th>
	<th> Storenum </th> 
	<th> region id</th>
	<th> manager </th>					       
    </tr>";
    
    $managerid = '';
    while ($row = $man_result->fetch_assoc()) {
      print "<tr>";
        print "<td>".$row['empid']."</td>";
	$managerid = $row['empid'];
        print "<td>".$row['Fname']."</td>";
        print "<td>".$row['LName']."</td>";
        print "<td>".$row['dateofhire']."</td>";
        print "<td>".$row['StoreNum']."</td>";
        print "<td>".$row['regionid']."</td>";
       	print "<td>".$row['manager']."</td>";
      print "</tr>";
    }
    echo "</table>";

    } else {
      echo "No employee with the ID.";
    }

   
   ?>

    <form method="post" action="deleteMan.php">
        <label for="empid">Select Employee to Delete:</label>
        <select name="empid" id="empid" required>
            <option value="">Select an Employee ID</option>
            <?php
            // Fetch and display employee IDs
            $man_result->data_seek(0);
            while ($empid = $man_result->fetch_assoc()) {
                echo "<option value='".htmlspecialchars($empid['empid'])."'>".
                    htmlspecialchars($empid['empid']) . " - " .
                    htmlspecialchars($empid['Fname']) . " " .
                    htmlspecialchars($empid['LName']) .
                    "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Delete Employee">
    </form>
   <p><br>
   <a href="manager.php">Go back to Manager Search page.</a>
  
  <?php
  $man_result->free();

  $con->close();
  ?>
  
  </body>
</html>
