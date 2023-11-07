<?php
    require_once('util/secure_conn.php');  // require a secure connection
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Drone Operations</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1>Drone Operations</h1>
        </header>
        <main>
            <h1>Login</h1>

            <form action="." method="post" id="login_form" class="aligned">
                <input type="hidden" name="action" value="login">

                <label>CallSign:</label>
                <input type="text" class="text" name="callsign">
                <br>

                <label>Password:</label>
                <input type="password" class="text" name="password">
                <br>

                <label>&nbsp;</label>
                <input type="submit" value="Login">
            </form>

            <p><?php echo $login_message; ?></p>
        </main>
    </body>
</html>
