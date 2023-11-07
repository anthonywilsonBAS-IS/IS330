<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user
  
    if (isset($_POST['submit2'])) {  
        $firstname = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        $SectorID = $_POST['SectorID '];
        $CallSign = $_POST['CallSign'];

        $stmt = $db->prepare("INSERT INTO Pilots (FirstName, LastName, SectorID, CallSign) VALUES (:firstname, :lastname, :SectorID, :CallSign)");

        $stmt->bindParam(':FirstName', $FirstName);
        $stmt->bindParam(':lastname', $LastName);
        $stmt->bindParam(':color', $SectorID);
        $stmt->bindParam(':color', $CallSign);

        $stmt->execute();

        $personID = $db->lastInsertId();

        $stmt = $db->prepare("INSERT INTO TeamConnections (TeamID, PersonID) VALUES (:teamid, :personID)");
        $stmt->bindParam(':sectorID', $SectorID);
        $stmt->bindParam(':pilotsID', $pilotsID);

        $stmt->execute();

        echo "You added a user successfully";
    }
    
    // SQL statement to fetch all droneoperations
    $stmt = $db->query('SELECT FirstName, LastName, CallSign, SectorName 
    FROM Pilots INNER JOIN Sectors ON Pilots.SectorID = Sectors.SectorID');


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Drone Operations</title>
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
            <h1>Pilots</h1>
        </header>
        
        <?php
            include("util/nav_menu.php");
        ?>
          <!--  Drone types table here??  -->
        <div class="container">
            <h2>Pilots</h2>
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Call Sign</th>
                    <th> Sectors</th>
                </tr>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                        <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                        <td><?php echo htmlspecialchars($row['CallSign']); ?></td>
                        <td><?php echo htmlspecialchars($row['SectorName']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            
        </div>

        <div class="container">
                <h1>Add New Pilot</h2>
                <form method="post">
                <label for="name">Pilots:</label>
                <input type = "text" class="text" name="name" > </br>

                <label for="team">Assigned Team:</label>
                    <select id="team" name="team" required>
                        <?php 
                            $query = "SELECT TeamID, TeamName FROM Teams";
                            $stmt = $db->query($query);
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($data as $row) {
                                echo "<option value='{$row['TeamID']}'>{$row['TeamName']}</option>";
                            }
                        ?>
                    </select></br>
                    

                    <label for="type">First Name:</label>
                    <select id="type" name="type" required>
                    </select> </br>
                    
                    <label for="types">Last Name:</label>
                    <select id="types" name="status" required>
                    </select> </br>
                    <label for="type">Call Sign:</label>
                    <select id="type" name="status" required>
                    </select> </br>
                    <label for="status">Sectors:</label>
                    <select id="status" name="status" required>
                    <option value="Military">Military</option>
                        <option value="Civilian">Civilian</option>
                    </select> </br>
            
                    <input type="submit" name="submit" value="Submit">
                </form>
         </div>
    </body>
</html>