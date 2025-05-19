<?php
  $host = "localhost";
  $user = "root";
  $pw = "root";
  $db = "hafh";
  
  $bID=$_GET['bID'];

  $con = new mysqli($host, $user, $pw, $db);

  $query = "SELECT bnooffloors, aptno, anoofbedrooms FROM building, apartment 
      WHERE building.buildingid = '$bID' and apartment.buildingid = '$bID'";
  
  $result = $con->query($query);
  $rows = $result->num_rows;
?>  

<!DOCTYPE html>
<html>
  <head>
    <title>Building Information</title>
    <style>
      .tab {
	  display: inline-block;
	  margin-left: 30px;
      }
    </style>    
  </head>

  <body>
    <h4>Building Information</h4>

    <?php
     if ($rows > 0) {
    
        $row = $result->fetch_assoc();
    
        echo "<p> Building ID: ".$bID."<br>";
        echo "Number of Floors: ".$row['bnooffloors']."<br>";
      
        $result->data_seek(0);
      
        echo "<p>Apartments<br>";
      
          while ($row = $result->fetch_assoc()) {
            echo "APT No: ".$row['aptno']."<span class='tab'></span>";
            echo "Bedroom(s): ".$row['anoofbedrooms']."<br>";
          }
      } else {
        echo "No apartment in the building.";
      }

      echo '<p><a href="manager.php">Go back to Manager Search page.</a>';
      
      $result->free();
      $con->close();
     ?>

  </body>
</html>
