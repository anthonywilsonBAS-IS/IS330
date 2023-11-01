<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user

 //Check if form was submitted
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $type = $_POST['type'];
        $status = $_POST['status'];
        

        // Prepare INSERT statement to avoid SQL injection
        $stmt = $db->prepare("INSERT INTO Drones (DroneName) VALUES (:name)", "INSERT INTO DroneTypes (TypeName, DroneCategory) VALUES (:type, :status)");
        // Bind parameters
        //$stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':status', $status);

         // Execute statement
        // $stmt->execute();

       // $stmt = $db->prepare("INSERT INTO Drones (DroneName, DroneTypeID) VALUES (:name, :dronetypeid)");
        
      //  $stmt->bindParam(':name', $name);
      //  $stmt->bindParam(':dronetypeid', $droneTypeID);


        // Execute statement
        $stmt->execute();

        echo "You added a Drone successfully";
    }
    $stmt = $db->query('SELECT  DroneName, MaintenanceDate, MaintenanceDescription
    FROM Maintenances JOIN  Drones ON Drones. DroneID =  Maintenances. DroneID');

?>
<!DOCTYPE html>
<html>
    <head>
        <title>DroneTypes</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
        <style>
        .container {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
    </style>
    </head>
    <body>
        <header>
            <h1> Assignments</h1>
        </header>

        <?php
            include("util/nav_menu.php")
        ?>
        
<div class="container">
            <h2> Assignments</h2>
            <table>
                <tr>
                    <th> Assignment Name</th>
                    <th> Mission Date </th>
                    <th> Mission Completion </th>
                    <th> Mission Completion Time </th>
                    <th> Notes </th>
                    <th> Flight Time </th>
                </tr>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['AssignmentName']); ?></td>
                        <td><?php echo htmlspecialchars($row['MissionDate']); ?></td>
                        <td><?php echo htmlspecialchars($row['MissionCompletion']); ?></td>
                        <td><?php echo htmlspecialchars($row['MissionCompletionTime']); ?></td>
                        <td><?php echo htmlspecialchars($row['Notes']); ?></td>
                        <td><?php echo htmlspecialchars($row['FlightTime']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            
        </div>

      <!--  <div class="container">
                <h1>Add New Drone</h2>
                <form method="post">
                <label for="name">Drone Name:</label>
                <input type = "text" class="text" name="name"> 

                    <label for="type">Drone Type:</label>
                    <select id="type" name="type" required>
                        <option value="Multi-Rotor">Multi-Rotor</option>
                        <option value="Fixed-Wing">Fixed-Wing</option>
                        <option value="Single-Rotor">Single-Rotor</option>
                        <option value="Fixed-Wing VTOL">Fixed-Wing VTOL</option>
                        <option value="MQ-9 Reaper">MQ-9 Reaper</option>
                    </select>
                    
                    <label for="status"> Drone Category:</label>
                    <select id="status" name="status" required>
                        <option value="Agriculture">Agriculture</option>
                        <option value="Mapping">Mapping</option>
                        <option value="Enviornmental">Enviornmental</option>
                        <option value="Delivery">Delivery</option>
                        <option value="Search and Rescue">Search and Rescue</option>
                        <option value="Reconnaissance">Reconnaissance</option>
                    </select>
            
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div> -->
        
    </body>
</html>