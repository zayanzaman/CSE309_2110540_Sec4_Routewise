<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['bus_id'])) {
    $bus_id = $_POST['bus_id'];
    
    $query = "
        SELECT s.station_id, s.station_name
        FROM Stations s
        JOIN Bus_Stations bs ON s.station_id = bs.station_id
        WHERE bs.bus_id = $bus_id
    ";
    
    $result = $conn->query($query);
    $stations = [];
    
    while ($row = $result->fetch_assoc()) {
        $stations[] = $row;
    }

    echo json_encode($stations);
}

$conn->close();
?>
