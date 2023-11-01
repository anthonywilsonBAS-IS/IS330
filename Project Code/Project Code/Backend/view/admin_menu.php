<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user
  
    
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
    </body>
</html>