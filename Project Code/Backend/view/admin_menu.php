<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user

    $callsign = $_SESSION['currently_logged_in_callsign'];
  
    if (isset($_POST['submit'])) {  
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $sectorID = $_POST['sectorID'];
        $callsign = $_POST['callsign'];

        $stmt = $db->prepare("INSERT INTO Pilots (FirstName, LastName, SectorID, CallSign) VALUES (:firstname, :lastname, :sectorID, :callsign)");

        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':sectorID', $sectorID);
        $stmt->bindParam(':callsign', $callsign);

        $stmt->execute();

        echo "You added a pilot successfully";
    }

    if(isset($_SESSION['is_valid_admin'])) {

    // SQL statement to fetch all droneoperations
        $stmt = $db->query('SELECT FirstName, LastName, CallSign, SectorName 
        FROM Pilots INNER JOIN Sectors ON Pilots.SectorID = Sectors.SectorID');

      $stmt->execute();
    } else {
        throw new Exception('Should not be able to get here if not logged in');
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Drone Operations</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <header>
            <h1>Hello, <?php echo "$callsign";?></h1>
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

                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required>
                    </input> </br>
                    
                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required>
                    </input> </br>

                    <label for="callsign">Call Sign:</label>
                    <input type="text" id="callsign" name="callsign" required>
                    </input> </br>

                    <label for="sectorID">Sector:</label>
                    <select id="sectorID" name="sectorID" required>
                        <option value="1">Military</option>
                        <option value="2">Civilian</option>
                    </select> </br>
            
                    <input type="submit" name="submit" value="Submit">
                </form>
         </div>
    </body>
</html>