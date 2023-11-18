<?php

/*

We want ch21_admin to work, but we ran into issues:

1) Problem: Access denied for user 'mgs_user'@'localhost' (using password: YES)
      - Database is not set up
   Solution: Run the SQL code that sets up the DB

2) Problem: Redirecting to HTTPs (via the file util/secure_conn.php)
   Solution: Comment out the redirection code

2.5) Problem: Notice: Trying to access array offset on value of type
 bool in C:\xampp\htdocs\book_apps\ch21_admin\model\admin_db.php on line 23

3) Problem: Can't log in, don't know password
   Solution: find a hash for the password we want and injected it into the database
   as the users save password.
*/

// Start session management and include necessary functions
session_start();
require_once('model/database.php');
require_once('model/admin_db.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');

if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'show_admin_menu';
    }
}

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_admin'])) {
    $action = 'login';
}

// Perform the specified action
switch($action) {
    case 'login':
        $callsign = filter_input(INPUT_POST, 'callsign');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($callsign, $password)) {
            $_SESSION['is_valid_admin'] = true;
            $_SESSION['currently_logged_in_callsign'] = $callsign;

            $stmt = $db->prepare("SELECT Administrator FROM Pilots WHERE CallSign = :callsign"); 
            $stmt->bindParam(":callsign", $callsign);
            $stmt->execute();

            $row = $stmt->fetch();
            $admin = $row["Administrator"];
            $_SESSION['current_user_admin'] = $admin;

            include('view/admin_menu.php');
        } else {
            $login_message = 'You must login to view this page.';
            include('view/login.php');
        }
        break;
    case 'show_admin_menu':
        include("view/admin_menu.php");
        break;
    case 'show_admin_page':
        include("view/admin_page.php");
        break;
    case 'show_drones':
        include("view/drones.php");
        break;
    case 'show_assignments':
        include('view/assignments.php');
        break;
    case 'show_Maintenances':
        include('view/Maintenances.php');
        break;
    case 'logout':
        $_SESSION = array();   // Clear all session data from memory
        session_destroy();     // Clean up the session ID
        $login_message = 'You have been logged out.';
        include('view/login.php');
        break;
}
?>