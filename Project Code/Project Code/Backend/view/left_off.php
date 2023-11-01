<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user
?>
<!DOCTYPE html>
<html>
    <head>
        <title>DroneTypes</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1> Drone Category</h1>
        </header>

        <?php
            include("util/nav_menu.php")
        ?>
        
        The Drones are listed on this page...
    </body>
</html>