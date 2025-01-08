<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "routewise_schema";


$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all contacts
$sql = "SELECT id, name, email, message, submitted_at FROM contact ORDER BY submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Contact Messages</title>
    <link rel="stylesheet" href="adminstyles.css">
</head>
<body>
<header>
        <nav>
            <div class="logo">
                <a href="index.php"><img src="imgs/logo-white.png" alt="Routewise Logo"></a>
            </div>

            <div class="hamburger">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <ul id="nav-menu">
                <li class="dropdown">
                    <a>Manage Databases</a>
                    <div class="dropdown-content">
                        <a href="admin_buses.php">Buses</a>
                        <a href="admin_stations.php">Stations</a>
                        <a href="admin_busstations.php">Bus Stations</a>
                    </div>
                </li>
                <li class="dropdown"><a href="admin_contacts.php">Feedback</a></li>
                <li class="dropdown"><a href="index.php">Go to Site</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Contact Messages</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['message'])); ?></td>
                            <td><?php echo $row['submitted_at']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No contact messages found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
