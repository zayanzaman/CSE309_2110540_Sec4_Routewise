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
        $bus_name = $_POST['bus_name'];
        $capacity = $_POST['capacity'];
        $air_conditioned = isset($_POST['air_conditioned']) ? 1 : 0;
        $accepts_student_pass = isset($_POST['accepts_student_pass']) ? 1 : 0;
        $wheelchair_accessible = isset($_POST['wheelchair_accessible']) ? 1 : 0;

        $sql = "INSERT INTO Buses (bus_name, capacity, air_conditioned, accepts_student_pass, wheelchair_accessible) 
                VALUES ('$bus_name', '$capacity', $air_conditioned, $accepts_student_pass, $wheelchair_accessible)";

        if ($conn->query($sql) === TRUE) {
            echo "<p>New bus record created successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    if (isset($_POST['update'])) {
        $bus_id = $_POST['bus_id'];
        $bus_name = $_POST['bus_name'];
        $capacity = $_POST['capacity'];
        $air_conditioned = isset($_POST['air_conditioned']) ? 1 : 0;
        $accepts_student_pass = isset($_POST['accepts_student_pass']) ? 1 : 0;
        $wheelchair_accessible = isset($_POST['wheelchair_accessible']) ? 1 : 0;

        $sql = "UPDATE Buses SET bus_name='$bus_name', capacity='$capacity', air_conditioned=$air_conditioned,
                accepts_student_pass=$accepts_student_pass, wheelchair_accessible=$wheelchair_accessible
                WHERE bus_id=$bus_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Bus record updated successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    if (isset($_POST['delete'])) {
        $bus_id = $_POST['bus_id'];
        $sql = "DELETE FROM Buses WHERE bus_id=$bus_id";

        if ($conn->query($sql) === TRUE) {
            echo "<p>Bus record deleted successfully.</p>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }
}

$sql = "SELECT * FROM Buses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Buses</title>
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
        <h1>Manage Buses</h1>
        <h2>Create New Bus</h2>

        <!-- Create New Bus Form -->
        <div class="form-container">
            <form method="POST" action="admin_buses.php">
                <div class="form-row">
                    <label for="bus_name">Name:</label>
                    <input type="text" name="bus_name" required>
                </div>

                <div class="form-row">
                    <label for="capacity">Capacity:</label>
                    <select name="capacity" required>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" name="air_conditioned"> Air Conditioned
                    </label>
                    <label>
                        <input type="checkbox" name="accepts_student_pass"> Student Pass
                    </label>
                    <label>
                        <input type="checkbox" name="wheelchair_accessible"> Wheelchair Accessible
                    </label>
                </div>

                <button type="submit" name="create">Create</button>
            </form>
        </div>

        <!-- Display All Buses -->
        <h2>Existing Buses</h2>
        <div class="table-container">
            <table>
                <tr>
                    <th>Bus ID</th>
                    <th>Bus Name</th>
                    <th>Capacity</th>
                    <th>Air Conditioned</th>
                    <th>Accepts Student Pass</th>
                    <th>Wheelchair Accessible</th>
                    <th class="actions-header">Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['bus_id']; ?></td>
                    <td><?php echo $row['bus_name']; ?></td>
                    <td><?php echo $row['capacity']; ?></td>
                    <td><?php echo $row['air_conditioned'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $row['accepts_student_pass'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $row['wheelchair_accessible'] ? 'Yes' : 'No'; ?></td>
                    <td class="actions">
                        <form method="POST" action="admin_buses.php" style="display:inline;">
                            <input type="hidden" name="bus_id" value="<?php echo $row['bus_id']; ?>">
                            <input type="text" name="bus_name" value="<?php echo $row['bus_name']; ?>" required>
                            <select name="capacity" required>
                                <option value="small" <?php echo $row['capacity'] == 'small' ? 'selected' : ''; ?>>Small</option>
                                <option value="medium" <?php echo $row['capacity'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
                                <option value="large" <?php echo $row['capacity'] == 'large' ? 'selected' : ''; ?>>Large</option>
                            </select>
                            <label>
                                <input type="checkbox" name="air_conditioned" value="1" <?php echo $row['air_conditioned'] ? 'checked' : ''; ?>> 
                            </label>
                            <label>
                                <input type="checkbox" name="accepts_student_pass" value="1" <?php echo $row['accepts_student_pass'] ? 'checked' : ''; ?>>
                            </label>
                            <label>
                                <input type="checkbox" name="wheelchair_accessible" value="1" <?php echo $row['wheelchair_accessible'] ? 'checked' : ''; ?>>
                            </label>
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
