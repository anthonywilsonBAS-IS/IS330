<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user

 //Check if form was submitted
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $org = $_POST['org'];
        $loc = $_POST['loc'];
        $date = $_POST['date'];
        $complete = $_POST['complete'];
        $time = $_POST['time'];
        $note = $_POST['note'];
        $drone = $_POST['drone'];
        $flight = $_POST['flight'];
        $pilot = $_POST['pilot'];
 
        $stmt = $db->prepare("INSERT INTO Assignments (AssignmentName, OrgID, LocationID, MissionDate, MissionComplete, MissionCompletion, Notes, DroneID, FlightTime, PilotsID) VALUES (:name, :org, :loc, :date, :complete, :time, :note, :drone, :flight, :pilot)");
 
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':org', $org);
        $stmt->bindParam(':loc', $loc);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':complete', $complete);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':drone', $drone);
        $stmt->bindParam(':flight', $flight);
        $stmt->bindParam(':pilot', $pilot);

        $stmt->execute();
 
        echo "You added an assignment successfully";
    }
    
    if(isset($_SESSION['is_valid_admin'])) {
        $stmt = $db->query("SELECT  AssignmentName, DATE_FORMAT(MissionDate, '%m/%d') AS formatted_date, MissionComplete, DATE_FORMAT(MissionCompletion, '%h:%i %p') AS formatted_time , Notes, FlightTime FROM Assignments");
          $stmt->execute();
        } else {
            throw new Exception('Should not be able to get here if not logged in');
        }


?>
<!DOCTYPE html>
<html>
    <head>
        <title>DroneTypes</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
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
                    <th> Mission Complete </th>
                    <th> Mission Completion </th>
                    <th> Notes </th>
                    <th> Flight Time </th>
                </tr>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['AssignmentName']); ?></td>
                        <td><?php echo htmlspecialchars($row['formatted_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['MissionComplete']?"True":"False"); ?></td>
                        <td><?php echo htmlspecialchars($row['formatted_time']); ?></td>
                        <td><?php echo htmlspecialchars($row['Notes']); ?></td>
                        <td><?php echo htmlspecialchars($row['FlightTime']); ?></td>
                      
                    </tr>
                <?php endwhile; ?>
            </table>

            
        </div>

        <div class="container">
                <h1>Add New Assignment</h2>
                <form method="post">

                    <label for="name">Assignment Name:</label>
                    <input type = "text" class="text" name="name"> </br>

                    <label for="org">Organization:</label>
                    <select id="org" name="org" required>
                        <?php
                            $query = "SELECT  OrgID, OrgName FROM Organizations";
                            $stmt = $db->query($query);
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($data as $row) {
                                echo "<option value='{$row['OrgID']}'>{$row['OrgName']}</option>";
                            }
                        ?>
                    </select></br>

                    <label for="loc">Location:</label>
                    <select id="loc" name="loc" required>
                        <?php
                            $query = "SELECT  LocationID, LocationName FROM Locations";
                            $stmt = $db->query($query);
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($data as $row) {
                                echo "<option value='{$row['LocationID']}'>{$row['LocationName']}</option>";
                            }
                        ?>
                    </select></br>

                    <label for="date">Mission Date:</label>
                    <input type ="date" class="text" name="date"> </br>

                    <label for="complete">Is the mission complete?</label>
                    <select id="complete" name="complete" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select></br>

                    <label for="time">Mission Completion Time:</label>
                    <input type = "time" class="text" name="time"> </br>

                    <label for="note">Notes:</label>
                    <input type = "text" class="text" name="note"> </br>

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

                    <label for="flight">Flight Time Duration:</label>
                    <input type = "text" class="text" name="flight"> </br>

                    <label for="pilot">Pilot:</label>
                    <select id="pilot" name="pilot" required>
                        <?php
                            $query = "SELECT  PilotID, CallSign FROM Pilots";
                            $stmt = $db->query($query);
                            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($data as $row) {
                                echo "<option value='{$row['PilotID']}'>{$row['CallSign']}</option>";
                            }
                        ?>
                    </select></br>

                    <input type="submit" name="submit" value="Submit">
                </form>
            </div> 
        
    </body>
</html>