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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $station_name = $_POST['station_name'];

        $sql = "INSERT INTO Stations (station_name) VALUES ('$station_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New station record created successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    if (isset($_POST['update'])) {
        $station_id = $_POST['station_id'];
        $station_name = $_POST['station_name'];

        $sql = "UPDATE Stations SET station_name='$station_name' WHERE station_id=$station_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Station record updated successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    if (isset($_POST['delete'])) {
        $station_id = $_POST['station_id'];
        $sql = "DELETE FROM Stations WHERE station_id=$station_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Station record deleted successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

$sql = "SELECT * FROM Stations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Stations</title>
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
        <h1>Manage Stations</h1>
        <h2>Create New Station</h2>

        <!-- Create New Station Form -->
        <div class="form-container">
            <form method="POST" action="admin_stations.php">
                <div class="form-row">
                    <label for="station_name">Station Name:</label>
                    <input type="text" name="station_name" required>
                </div>

                <button type="submit" name="create">Create</button>
            </form>
        </div>

        <!-- Display All Stations -->
        <h2>Existing Stations</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>Station ID</th>
                    <th>Station Name</th>
                    <th class="actions-header">Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['station_id']; ?></td>
                    <td><?php echo $row['station_name']; ?></td>
                    <td class="actions">
                        <form method="POST" action="admin_stations.php" style="display:inline;">
                            <input type="hidden" name="station_id" value="<?php echo $row['station_id']; ?>">
                            <input type="text" name="station_name" value="<?php echo $row['station_name']; ?>" required>
                            <button type="submit" name="update">Update</button>
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
