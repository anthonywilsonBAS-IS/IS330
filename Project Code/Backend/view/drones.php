<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user

// Check if form was submitted
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        

        // Prepare INSERT statement to avoid SQL injection
        $stmt = $db->prepare("INSERT INTO DroneTypes (TypeName, DroneCategory) VALUES (:type, :status)");
        // Bind parameters
        
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':status', $status);
        // Execute statement
        $stmt->execute();
        // TODO get last inserted id
        $droneTypeID = $db->lastInsertId();

        $stmt = $db->prepare("INSERT INTO Drones (DroneName, DroneTypeID) VALUES (:name, :dronetypeid)");
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':dronetypeid', $droneTypeID);

        $stmt->execute();
        
        echo "You added a Drone successfully";
    }
    
    $stmt = $db->query('SELECT  DroneName, TypeName, DroneCategory
    FROM Drones JOIN  DroneTypes ON Drones. DroneTypeID =  DroneTypes. DroneTypeID');

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
        
<div class="container">
            <h2>Drones</h2>
            <table>
                <tr>
                    <th>Drone Name</th>
                    <th>Drone Type  </th>
                    <th>Drone Category</th>
                    
                </tr>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['DroneName']); ?></td>
                        <td><?php echo htmlspecialchars($row['TypeName']); ?></td>
                        <td><?php echo htmlspecialchars($row['DroneCategory']); ?></td>
                        
                    </tr>
                <?php endwhile; ?>
            </table>

            
        </div>

         <div class="container">
                <h1>Add New Drone</h2>
                <form method="post">

                    <label for="name">Drone Name:</label>
                    <input type = "text" class="text" name="name" > </br>

                    <label for="type">Drone Type:</label>
                    <input type = "text" id="type" name="type" required></input> </br>
                    
                    <label for="status"> Drone Category:</label>
                    <input type = "text" id="status" name="status" required></input> </br>
            
                    <input type="submit" name="submit" value="Submit">
                </form>
         </div>
       
    </body>
</html>