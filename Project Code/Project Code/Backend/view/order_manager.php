<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Maintenances</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1>Maintenances</h1>
        </header>
        <main>
            <h1>Maintenances</h1>
            <p>Down for repair!</p>
            <p><a href="index.php?action=show_admin_menu">Admin Menu</a></p>
            <p><a href="index.php?action=logout">Logout</a></p>
        </main>
    </body>
</html>
