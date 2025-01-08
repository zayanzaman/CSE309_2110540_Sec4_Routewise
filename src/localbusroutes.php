<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "routewise_schema";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$ac = isset($_GET['acfacility']) ? $_GET['acfacility'] : null;
$capacity = isset($_GET['capacity']) ? $_GET['capacity'] : null;
$studentpass = isset($_GET['studentpass']) ? $_GET['studentpass'] : null;
$wheelchair = isset($_GET['wheelchair']) ? $_GET['wheelchair'] : null;

$sql = "
    SELECT b.bus_name, s.station_name
    FROM buses b
    JOIN bus_stations bs ON b.bus_id = bs.bus_id
    JOIN stations s ON bs.station_id = s.station_id
    WHERE 1=1
";

if ($ac !== null) {
    $sql .= " AND b.air_conditioned = $ac";
}
if ($capacity !== null) {
    $sql .= " AND b.capacity = '$capacity'";
}
if ($studentpass !== null) {
    $sql .= " AND b.accepts_student_pass = $studentpass";
}
if ($wheelchair !== null) {
    $sql .= " AND b.wheelchair_accessible = $wheelchair";
}

$sql .= " ORDER BY b.bus_name ASC, bs.station_order";  // Modified line to order alphabetically by bus_name

$bus_routes = [];

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $bus_name = $row['bus_name'];
        $station_name = $row['station_name'];

        
        if (!isset($bus_routes[$bus_name])) {
            $bus_routes[$bus_name] = [];
        }
        $bus_routes[$bus_name][] = $station_name;
    }
}

$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Local Bus Routes - Routewise</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/logo-colour.png" type="image/x-icon">
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
                    <a href="localbusroutes.php">Local Bus Routes</a>
                </li>
                <li class="dropdown">
                    <a href="rapidtransit.php">Rapid Transit</a>
                    <div class="dropdown-content">
                        <a href="brt.php">Bus Rapid Transit</a>
                        <a href="mrt.php">Mass Rapid Transit</a>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="information.php">Information</a>
                    <div class="dropdown-content">
                        <a href="mapofdhaka.php">Map of Dhaka</a>
                        <a href="safety.php">Safety</a>
                        <a href="foreignerguide.php">Foreigner Guide</a>
                    </div>
                </li>
                <li class="dropdown"><a href="contact.php">Contact Us</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="tickets.php" target="_blank"><button class="contact-us">Get Bus Pass</button></a>
            </div>
        </nav>
    </header>

    <section class="hero">
        <h1>Dhaka Local Bus Routes</h1>
    </section>

    <main class="main-content">
        <aside class="sidebar">
        <h2>Filters</h2>            
        <form method="GET" action="">
            <div class="filter-group">
                <div class="filter-title">Air Conditioning</div>
                <ul class="filter-options">
                    <li><input type="radio" id="ac" name="acfacility" value="1" <?= isset($_GET['acfacility']) && $_GET['acfacility'] == '1' ? 'checked' : '' ?>><label for="ac">AC</label></li>
                    <li><input type="radio" id="nonac" name="acfacility" value="0" <?= isset($_GET['acfacility']) && $_GET['acfacility'] == '0' ? 'checked' : '' ?>><label for="nonac">Non-AC</label></li>
                </ul>
            </div>
            <div class="filter-group">
                <div class="filter-title">Capacity</div>
                <ul class="filter-options">
                    <li><input type="radio" id="small" name="capacity" value="small" <?= isset($_GET['capacity']) && $_GET['capacity'] == 'small' ? 'checked' : '' ?>><label for="small">Small</label></li>
                    <li><input type="radio" id="medium" name="capacity" value="medium" <?= isset($_GET['capacity']) && $_GET['capacity'] == 'medium' ? 'checked' : '' ?>><label for="medium">Standard</label></li>
                    <li><input type="radio" id="large" name="capacity" value="large" <?= isset($_GET['capacity']) && $_GET['capacity'] == 'large' ? 'checked' : '' ?>><label for="large">Double Decker</label></li>
                </ul>
            </div>
            <div class="filter-group">
                <div class="filter-title">Accepts Student Pass</div>
                <ul class="filter-options">
                    <li><input type="radio" id="accepts_student_pass" name="studentpass" value="1" <?= isset($_GET['studentpass']) && $_GET['studentpass'] == '1' ? 'checked' : '' ?>><label for="accepts_student_pass">Yes</label></li>
                    <li><input type="radio" id="no_student_pass" name="studentpass" value="0" <?= isset($_GET['studentpass']) && $_GET['studentpass'] == '0' ? 'checked' : '' ?>><label for="no_student_pass">No</label></li>
                </ul>
            </div>
            <div class="filter-group">
                <div class="filter-title">Wheelchair Accessible</div>
                <ul class="filter-options">
                    <li><input type="radio" id="wheelchair_accessible" name="wheelchair" value="1" <?= isset($_GET['wheelchair']) && $_GET['wheelchair'] == '1' ? 'checked' : '' ?>><label for="wheelchair_accessible">Yes</label></li>
                    <li><input type="radio" id="no_wheelchair" name="wheelchair" value="0" <?= isset($_GET['wheelchair']) && $_GET['wheelchair'] == '0' ? 'checked' : '' ?>><label for="no_wheelchair">No</label></li>
                </ul>
            </div>

            <button type="submit" class="filter-button" style="background-color:blue;">Apply Filters ✓</button>
            <button type="button" onclick="resetFilters()" class="filter-button" style="background-color:red;">Reset ✖</button>
        </form>
        </aside>

        <section class="route-grid">
    <?php
   
    if (empty($bus_routes)) {
        echo '<h2>No results found for the selected filters.</h2>';
    } else {
       
        foreach ($bus_routes as $bus_name => $stations) {
            echo '<div class="route-card">';
            echo '<div class="title-bar">' . htmlspecialchars($bus_name) . '</div>';
            echo '<div class="route-list">';
            foreach ($stations as $station) {
                echo '<span>' . htmlspecialchars($station) . '</span>';
            }
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</section>        
    </main>

    <script>   
    function resetFilters() {        
        window.location.href = window.location.pathname;
    }
    </script>
    <script src="script.js"></script>
</body>
<footer class="footer">
    <div class="left-section">
        <div class="footer-logo">
            <img src="imgs/logo-white.png" alt="Routewise Logo">
        </div>

        <div class="footer-text">
            © 2025 Routewise. All Rights Reserved.
        </div>
    </div>

    <ul class="footer-links">
        <li><a href="#">Back to Top</a></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="tickets.php">Bus Pass</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="admin_buses.php">Admin</a></li>
    </ul>
</footer>
</html>
