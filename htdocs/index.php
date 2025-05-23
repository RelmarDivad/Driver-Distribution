<?php
    $host = "localhost";
    $user = "root";
    $pw = "root";
    $db = "storesupply";
    
    // Create connection with error handling
    try {
        $con = new mysqli($host, $user, $pw, $db);
        
        // Check connection
        if ($con->connect_error) {
            throw new Exception("Connection failed: " . $con->connect_error);
        }
    } catch (Exception $e) {
        die("Connection error: " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DaveCorp Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }
        .nav-links a {
            text-decoration: none;
            color: #0066cc;
            padding: 5px 0;
        }
        .nav-links a:hover {
            color: #003366;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>DaveCorp Management System</h1>
    <h3>Navigation Menu</h3>
    
    <div class="nav-links">
        <a href="manager.php">Manage Employee information</a>
        <a href="Driver.php">Manage Driver information</a>
    </div>

<?php
    // Close the connection
    $con->close();
?>
</body>
</html>
