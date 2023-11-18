<?php
    require_once('util/secure_conn.php'); 
    require_once('util/valid_admin.php');  

    if (isset($_POST['submit'])) {   //Submission of New Team Form
        $name = $_POST['name'];
        $date = $_POST['date'];
        $drone = $_POST['drone'];

        $stmt = $db->prepare("INSERT INTO Maintenances (MaintenanceDate, MaintenanceDescription, DroneID) VALUES (:date, :name, :drone)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':drone', $drone);

        $stmt->execute();

        echo "You added a maintenance successfully";
    }
    if (isset($_POST['submit2'])) {  //Submission of New User Form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $admin = $_POST['admin'];
        $sectorID = $_POST['sectorID'];
        $callsign = $_POST['callsign'];


        $stmt = $db->prepare("INSERT INTO Pilots (FirstName, LastName, CallSign, PasswordHash, Administrator, SectorID) VALUES (:firstname, :lastname, :callsign, :password, :admin, :sectorID)");

        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':callsign', $callsign);
        $stmt->bindParam(':password', $password);        
        $stmt->bindParam(':admin', $admin);
        $stmt->bindParam(':sectorID', $sectorID);

        $stmt->execute();

        echo "You added a user successfully";
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
            <h1>Hello, </h1>
        </header>
        
        <?php
            include("util/nav_menu.php");
        ?>
          <!--  Drone types table here??  -->
        <div class="container">
            <div class="container">
                <h1 style= "Text-align: center">Create a New Maintenance </h1></br>
                <form method="post">

                    <label for="name">Description:</label>
                    <input type="text" id="name" name="name" required></br>

                    <label for="date">Maintenance Date:</label>
                    <input type ="date" class="text" name="date"> </br>

                    <label for="drone">Drone:</label>
                    <select id="drone" name="drone" required>
                        <?php
                            $query = "SELECT  DroneID, DroneName FROM Drones";
                            $stmt = $db->query($query);
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($data as $row) {
                                echo "<option value='{$row['DroneID']}'>{$row['DroneName']}</option>";
                            }
                        ?>
                    </select></br>
                    
                    <input type="submit" name="submit" value="Submit">
                </form> 
            </div> 
            <div class="container">
                <h1 style= "Text-align: center">Add A New User</h1></br>
                <form method="post">
                    <label for="firstname">First Name:</label>
                    <input type="text" id="firstname" name="firstname" required></br>

                    <label for="lastname">Last Name:</label>
                    <input type="text" id="lastname" name="lastname" required></br>

                    <label for="callsign">Call Sign:</label>
                    <input type="text" id="callsign" name="callsign" required></br>

                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required></br>

                    <label for="admin">Are they an admin?</label>
                    <select id="admin" name="admin" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></br>

                    <label for="sectorID">Sector:</label>
                    <select id="sectorID" name="sectorID" required>
                        <option value="1">Military</option>
                        <option value="2">Civilian</option>
                    </select> </br>
                
                    <input type="submit" name="submit2" value="Submit">
                </form> 
            </div>
        </div>
    </body>
</html>