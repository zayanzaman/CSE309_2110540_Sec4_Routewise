<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "routewise_schema";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $bus_name = $_POST['bus_name'];
        $station_name = $_POST['station_name'];
        $station_order = $_POST['station_order'];

        
        $bus_result = $conn->query("SELECT bus_id FROM Buses WHERE bus_name = '$bus_name'");
        $station_result = $conn->query("SELECT station_id FROM Stations WHERE station_name = '$station_name'");

        if ($bus_result->num_rows > 0 && $station_result->num_rows > 0) {
            $bus_id = $bus_result->fetch_assoc()['bus_id'];
            $station_id = $station_result->fetch_assoc()['station_id'];

            $sql = "INSERT INTO Bus_Stations (bus_id, station_id, station_order) 
                    VALUES ($bus_id, $station_id, $station_order)";

            if ($conn->query($sql) === TRUE) {
                echo "<p>New bus station record created successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Invalid bus or station name provided.</p>";
        }
    }

    if (isset($_POST['update'])) {
        $bus_station_id = $_POST['bus_station_id'];
        $bus_name = $_POST['bus_name'];
        $station_name = $_POST['station_name'];
        $station_order = $_POST['station_order'];

        
        $bus_result = $conn->query("SELECT bus_id FROM Buses WHERE bus_name = '$bus_name'");
        $station_result = $conn->query("SELECT station_id FROM Stations WHERE station_name = '$station_name'");

        if ($bus_result->num_rows > 0 && $station_result->num_rows > 0) {
            $bus_id = $bus_result->fetch_assoc()['bus_id'];
            $station_id = $station_result->fetch_assoc()['station_id'];

            $sql = "UPDATE Bus_Stations SET bus_id=$bus_id, station_id=$station_id, station_order=$station_order
                    WHERE bus_station_id=$bus_station_id";

            if ($conn->query($sql) === TRUE) {
                echo "<p>Bus station record updated successfully.</p>";
            } else {
                echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        } else {
            echo "<p>Invalid bus or station name provided.</p>";
        }
    }

    if (isset($_POST['delete'])) {
        $bus_station_id = $_POST['bus_station_id'];
        $sql = "DELETE FROM Bus_Stations WHERE bus_station_id=$bus_station_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Bus station record deleted successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

$sql = "SELECT bs.bus_station_id, b.bus_name, s.station_name, bs.station_order 
        FROM Bus_Stations bs
        JOIN Buses b ON bs.bus_id = b.bus_id
        JOIN Stations s ON bs.station_id = s.station_id";
$result = $conn->query($sql);

$buses = $conn->query("SELECT bus_name FROM Buses");
$stations = $conn->query("SELECT station_name FROM Stations");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Bus Stations</title>
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
        <h1>Manage Bus Stations</h1>
        <h2>Create New Bus Station</h2>

        <!-- Create New Bus Station Form -->
        <div class="form-container">
            <form method="POST" action="admin_busstations.php">
                <div class="form-row">
                    <label for="bus_name">Bus:</label>
                    <select name="bus_name" required>
                        <option value="">Select a Bus</option>
                        <?php while ($bus = $buses->fetch_assoc()): ?>
                            <option value="<?php echo $bus['bus_name']; ?>"><?php echo $bus['bus_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-row">
                    <label for="station_name">Station:</label>
                    <select name="station_name" required>
                        <option value="">Select a Station</option>
                        <?php while ($station = $stations->fetch_assoc()): ?>
                            <option value="<?php echo $station['station_name']; ?>"><?php echo $station['station_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-row">
                    <label for="station_order">Station Order:</label>
                    <input type="number" name="station_order" required>
                </div>

                <button type="submit" name="create">Create</button>
            </form>
        </div>

        <!-- Display All Bus Stations -->
        <h2>Existing Bus Stations</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>Bus Name</th>
                    <th>Station Name</th>
                    <th>Station Order</th>
                    <th class="actions-header">Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['bus_name']; ?></td>
                    <td><?php echo $row['station_name']; ?></td>
                    <td><?php echo $row['station_order']; ?></td>
                    <td class="actions">
                        <form method="POST" action="admin_busstations.php" style="display:inline;">
                            <input type="hidden" name="bus_station_id" value="<?php echo $row['bus_station_id']; ?>">

                            <!-- Bus Name Selection -->
                            <select name="bus_name" required>
                                <?php
                                // Reset buses query for update
                                $buses->data_seek(0);
                                while ($bus = $buses->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $bus['bus_name']; ?>" <?php echo $bus['bus_name'] == $row['bus_name'] ? 'selected' : ''; ?>><?php echo $bus['bus_name']; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <!-- Station Name Selection -->
                            <select name="station_name" required>
                                <?php
                                $stations->data_seek(0);
                                while ($station = $stations->fetch_assoc()):
                                ?>
                                    <option value="<?php echo $station['station_name']; ?>" <?php echo $station['station_name'] == $row['station_name'] ? 'selected' : ''; ?>><?php echo $station['station_name']; ?></option>
                                <?php endwhile; ?>
                            </select>

                            <input type="number" name="station_order" value="<?php echo $row['station_order']; ?>" required>
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
