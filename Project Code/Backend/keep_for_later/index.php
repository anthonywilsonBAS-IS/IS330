Hello, <br><br>

<?php
    $dsn = 'mysql:host=localhost;dbname=Droneoperations';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo "There was an error";
        exit();
    }

    // Prepare the SQL statement for execution

    $stmt = $db->prepare("SELECT * FROM Pilots");
   // $drone = $db->prepare("SELECT * FROM locations");
    //$attack = $db->prepare("SELECT * FROM Organizations");
    // Execute the prepared statement

    $stmt->execute();
    //$drone->execute();
    //$attack->execute();
    // Fetch all of the remaining rows in the result set and display them

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Name: " . $row['FirstName'] . " " . $row['LastName'] . "<br>";
        echo "Call Sign: " . $row['CallSign'] . "<br><br>";
    }

    /*while ($row = $drone->fetch(PDO::FETCH_ASSOC)) {
        
       echo "Location is: " . $row['LocationName'] . "<br>";
    }*/

   /* while ($row = $attack->fetch(PDO::FETCH_ASSOC)) {
        
        echo "Organizations: " . $row['OrgName'] . $row['OrgType'] ."<br>";
    }*/

?>
<h1>Add a Pilot</h1>
<form action="process_form.php" method="POST">
        <label for="FirstName">First Name:</label>
        <input type="text" id="FirstName" name="FirstName" required><br><br>

        <label for="LastName">Last Name:</label>
        <input type="text" id="LastName" name="LastName" required><br><br>

        <label for="CallSign">CallSign:</label>
        <input type="text" id="CallSign" name="CallSign" required><br><br>

        <label for="PasswordHash">Password:</label>
        <input type="password" id="PasswordHash" name="PasswordHash" required><br><br>

        <input type="submit" value="Add Pilot">
    </form>

It Worked!!!
<!-- http://localhost/Project%20Code/backend/index.php -->