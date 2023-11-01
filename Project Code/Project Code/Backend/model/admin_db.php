<?php
function add_admin($callsign, $password) {
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = 'INSERT INTO Pilots (CallSign, PasswordHash)
              VALUES (:callsign, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':callsign', $callsign);
    $statement->bindValue(':password', $hash);
    $statement->execute();
    $statement->closeCursor();
}

function is_valid_admin_login($callsign, $password) {
    global $db;


// Temp code:
$hash = password_hash($password, PASSWORD_DEFAULT);


//add_admin($callsign, $password);


    $query = 'SELECT PasswordHash FROM Pilots
              WHERE CallSign = :callsign';
    $statement = $db->prepare($query);
    $statement->bindValue(':callsign', $callsign);
    $statement->execute();
    $row = $statement->fetch();
    //$statement->closeCursor();

    if($row === False)
    {
        return False;
    }
    
    $hash = $row['PasswordHash'];
   
   $return= password_verify($password, $hash);
   
   return $return;
   // return true;
}
?>