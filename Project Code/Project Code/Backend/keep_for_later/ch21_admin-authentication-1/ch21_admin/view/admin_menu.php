<?php
    require_once('util/secure_conn.php');  // require a secure connection
    require_once('util/valid_admin.php');  // require a valid admin user

    // Check if form was submitted
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $class = $_POST['class'];
        $registry = $_POST['registry'];
        $status = $_POST['status'];

        // Prepare INSERT statement to avoid SQL injection
        $stmt = $db->prepare("INSERT INTO droneoperations (name, class, registry, status) VALUES (:name, :class, :registry, :status)");
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':class', $class);
        $stmt->bindParam(':registry', $registry);
        $stmt->bindParam(':status', $status);
        // Execute statement
        $stmt->execute();

        echo "You added a drone successfully";
    }
    
    // SQL statement to fetch all droneoperations
    $stmt = $db->query('SELECT name, class, registry, status FROM droneoperations');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Guitar Shop</title>
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
            <h1>My Guitar Shop</h1>
        </header>

        <?php
            include("util/nav_menu.php");
        ?>
        <!--  Starships table here??  -->
        <div class="container">
            <h2>Starships from Star Trek</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Registry</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $stmt->fetch()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['class']); ?></td>
                        <td><?php echo htmlspecialchars($row['registry']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <div class="container">
                <h1>Add New Starship</h2>
                <form method="post">
                    <label for="name">Starship Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="class">Starship Class:</label>
                    <input type="text" id="class" name="class" required>

                    <label for="registry">Registry:</label>
                    <input type="text" id="registry" name="registry" required>

                    <label for="status">Status:</label>
                    <select id="status" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                        <option value="Destroyed">Destroyed</option>
                        <option value="Missing">Missing</option>
                    </select>
            
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </body>
</html>