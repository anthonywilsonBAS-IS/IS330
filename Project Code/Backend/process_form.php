<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

// Get values from the form
    $FirstName =$_POST["FirstName"];
    $LastName =$_POST["LastName"];
    $CallSign =$_POST["CallSign"];
    $PasswordHash =$_POST["PasswordHash"];

    $dsn = 'mysql:host=localhost;dbname=Droneoperations';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        echo "There was an error";
        exit();
    }

    // SQL query to insert a new Pilot record into the database

    $sql = "INSERT INTO Pilots (FirstName, LastName, CallSign, PasswordHash)
            VALUES ('$FirstName', '$LastName', '$CallSign', '$PasswordHash')";

    if ($db->QUERY($sql) !=FALSE) {
        echo "New Pilot added successfully!";
    } else {
        echo "This is the Error";
    }
} else {
    
    // If the form is not submitted, display an error message
    echo "Error: Form not submitted.";
}

?>
<script>
        // Use JavaScript to delay and redirection
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 5000); 
</script>