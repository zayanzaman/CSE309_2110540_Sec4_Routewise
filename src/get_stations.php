<?php
// Database connection
$host = 'localhost'; // Your database host
$user = 'root';      // Your database username
$pass = '';          // Your database password
$db = 'bus_system';  // Your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch stations from the database
$sql = "SELECT station_name FROM stations"; // Assuming you have a `stations` table with `station_name` column
$result = $conn->query($sql);

$stations = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stations[] = $row['station_name'];
    }
}

$conn->close();

// Return the stations as JSON
echo json_encode($stations);
?>
