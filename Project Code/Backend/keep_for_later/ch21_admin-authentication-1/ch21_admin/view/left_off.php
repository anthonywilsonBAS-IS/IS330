<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Left off</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1>Where'd I leave off?</h1>
        </header>

        <?php
            include("util/nav_menu.php")
        ?>
        
        Table for series tracker goes here...
    </body>
</html>