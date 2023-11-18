<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user

    $stmt = $db->query("SELECT  DroneName, DATE_FORMAT(MaintenanceDate, '%m/%d') AS formatted_date , MaintenanceDescription
    FROM Maintenances JOIN  Drones ON Drones. DroneID =  Maintenances. DroneID");

?>
<!DOCTYPE html>
<html>
    <head>
        <title>DroneTypes</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1> Maintanences</h1>
        </header>

        <?php
            include("util/nav_menu.php")
        ?>
        
<div class="container">
            <h2>Maintenances</h2>
            <table>
                <tr>
                    <th>Drone Name</th>
                    <th>Maintenance Date </th>
                    <th>Maintenance Description</th>
                    
                </tr>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['DroneName']); ?></td>
                        <td><?php echo htmlspecialchars($row['formatted_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['MaintenanceDescription']); ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </body>
</html>