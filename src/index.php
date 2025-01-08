<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT station_name FROM stations"; 
$result = $conn->query($sql);

$stations = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stations[] = $row['station_name'];
    }
}
$stations = array_unique($stations);
sort($stations);

$origin = isset($_GET['origin']) ? $_GET['origin'] : '';
$destination = isset($_GET['destination']) ? $_GET['destination'] : '';
$acfilter = isset($_GET['acfacility']) ? $_GET['acfacility'] : '';
$capacityfilter = isset($_GET['capacity']) ? $_GET['capacity'] : '';
$studentpassfilter = isset($_GET['studentpass']) ? $_GET['studentpass'] : '';
$wheelchairfilter = isset($_GET['wheelchair']) ? $_GET['wheelchair'] : '';

$sql = "SELECT DISTINCT b.bus_id, b.bus_name 
        FROM Buses b
        INNER JOIN Bus_Stations bs1 ON b.bus_id = bs1.bus_id
        INNER JOIN Bus_Stations bs2 ON b.bus_id = bs2.bus_id
        INNER JOIN Stations s1 ON bs1.station_id = s1.station_id
        INNER JOIN Stations s2 ON bs2.station_id = s2.station_id
        WHERE s1.station_name = ? AND s2.station_name = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $origin, $destination);
$stmt->execute();
$result = $stmt->get_result();

$buses = [];
$fastest_route = null;

while ($row = $result->fetch_assoc()) {
    $bus_id = $row['bus_id'];
    $bus_name = $row['bus_name'];

    $ac_condition = '';
    if ($acfilter != '') {
        $ac_condition = " AND b.air_conditioned = ?";
    }

    $capacity_condition = '';
    if ($capacityfilter != '') {
        $capacity_condition = " AND b.capacity = ?";
    }

    $studentpass_condition = '';
    if ($studentpassfilter != '') {
        $studentpass_condition = " AND b.accepts_student_pass = ?";
    }

    $wheelchair_condition = '';
    if ($wheelchairfilter != '') {
        $wheelchair_condition = " AND b.wheelchair_accessible = ?";
    }

    $final_sql = "SELECT DISTINCT b.bus_id, b.bus_name 
                  FROM Buses b
                  INNER JOIN Bus_Stations bs1 ON b.bus_id = bs1.bus_id
                  INNER JOIN Bus_Stations bs2 ON b.bus_id = bs2.bus_id
                  INNER JOIN Stations s1 ON bs1.station_id = s1.station_id
                  INNER JOIN Stations s2 ON bs2.station_id = s2.station_id
                  WHERE s1.station_name = ? AND s2.station_name = ?
                  $ac_condition $capacity_condition $studentpass_condition $wheelchair_condition";

    $filter_stmt = $conn->prepare($final_sql);
    $filter_params = [$origin, $destination];

    if ($acfilter != '') {
        $filter_params[] = $acfilter;
    }
    if ($capacityfilter != '') {
        $filter_params[] = $capacityfilter;
    }
    if ($studentpassfilter != '') {
        $filter_params[] = $studentpassfilter;
    }
    if ($wheelchairfilter != '') {
        $filter_params[] = $wheelchairfilter;
    }

    $bind_types = str_repeat('s', count($filter_params));
    $filter_stmt->bind_param($bind_types, ...$filter_params);
    $filter_stmt->execute();
    $filter_result = $filter_stmt->get_result();

    while ($filtered_row = $filter_result->fetch_assoc()) {
        $bus_id = $filtered_row['bus_id'];
        $bus_name = $filtered_row['bus_name'];

        $route_sql = "SELECT s.station_name
                      FROM Bus_Stations bs
                      INNER JOIN Stations s ON bs.station_id = s.station_id
                      WHERE bs.bus_id = ?
                      ORDER BY bs.station_order";

        $route_stmt = $conn->prepare($route_sql);
        $route_stmt->bind_param("i", $bus_id);
        $route_stmt->execute();
        $route_result = $route_stmt->get_result();

        $stations_on_route = [];
        while ($route_row = $route_result->fetch_assoc()) {
            $stations_on_route[] = $route_row['station_name'];
        }

        $buses[$bus_id] = [
            'bus_name' => $bus_name,
            'stations' => $stations_on_route
        ];

        $num_stations = count($stations_on_route);
        if (!$fastest_route || $num_stations < count($fastest_route['stations'])) {
            $fastest_route = [
                'bus_name' => $bus_name,
                'stations' => $stations_on_route
            ];
        }
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
        <h1>Where do you want to go?</h1>
        <p>
            Get detailed information about local buses and their routes in Dhaka with
            Routewise, your reliable transport guide.
        </p>

        <form class="route-form" method="GET" action="">
            <div class="form-group">
                <div class="select-wrapper">
                    <select name="origin" id="origin" required>
                        <option value="">Select Origin</option>
                        <?php foreach ($stations as $station): ?>
                            <option value="<?php echo $station; ?>" <?= isset($_GET['origin']) && $_GET['origin'] == $station ? 'selected' : ''; ?>><?php echo $station; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="select-wrapper">
                    <select name="destination" id="destination" required>
                        <option value="">Select Destination</option>
                        <?php foreach ($stations as $station): ?>
                            <option value="<?php echo $station; ?>" <?= isset($_GET['destination']) && $_GET['destination'] == $station ? 'selected' : ''; ?>><?php echo $station; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="go-btn">GO!</button>
        </form>
    </section>

    <main class="main-content">
    <aside class="sidebar">
    <h2>Filter Results</h2>
    <form method="GET" action="">
        <input type="hidden" name="origin" value="<?= htmlspecialchars($origin) ?>">
        <input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">

        <div class="filter-group">
            <label for="acfacility">AC Facility</label>
            <select name="acfacility" id="acfacility">
                <option value="">Select Air Conditioning</option>
                <option value="1" <?= $acfilter == '1' ? 'selected' : ''; ?>>AC Available</option>
                <option value="0" <?= $acfilter == '0' ? 'selected' : ''; ?>>No AC</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="capacity">Capacity</label>
            <select name="capacity" id="capacity">
                <option value="">Select Capacity</option>
                <option value="small" <?= $capacityfilter == 'small' ? 'selected' : ''; ?>>Smaller</option>
                <option value="medium" <?= $capacityfilter == 'medium' ? 'selected' : ''; ?>>Standard</option>
                <option value="large" <?= $capacityfilter == 'large' ? 'selected' : ''; ?>>Double Decker</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="studentpass">Student Pass</label>
            <select name="studentpass" id="studentpass">
                <option value="">Student Pass Option</option>
                <option value="1" <?= $studentpassfilter == '1' ? 'selected' : ''; ?>>Accepted</option>
                <option value="0" <?= $studentpassfilter == '0' ? 'selected' : ''; ?>>Not Accepted</option>
            </select>
        </div>

        <div class="filter-group">
            <label for="wheelchair">Wheelchair Access</label>
            <select name="wheelchair" id="wheelchair">
                <option value="">Accessibility Choice</option>
                <option value="1" <?= $wheelchairfilter == '1' ? 'selected' : ''; ?>>Available</option>
                <option value="0" <?= $wheelchairfilter == '0' ? 'selected' : ''; ?>>Not Available</option>
            </select>
        </div>

        <button type="submit" class="filter-button" style="background-color:blue";>Apply Filters ✓</button>
    </form>
</aside>

        <section class="route-grid">
            <?php if ($fastest_route): ?>
                <div class="route-card">
                    <div class="title-bar" style="background-color:#6dde8b;"><?php echo '✧ Suggested Route: ' . $fastest_route['bus_name']; ?></div>
                    <div class="route-list">
                        <?php foreach ($fastest_route['stations'] as $station): ?>
                            <span><?php echo $station; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <h1>Bus Routes</h1>
            <?php if (!empty($buses)): ?>
                <?php foreach ($buses as $bus): ?>
                    <div class="route-card">
                        <div class="title-bar"><?php echo htmlspecialchars($bus['bus_name']); ?></div>
                        <div class="route-list">
                            <?php foreach ($bus['stations'] as $station): ?>
                                <span><?php echo htmlspecialchars($station); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Modify your search to find the right bus for you.</p>
            <?php endif; ?>
        </section>
    </main>

    <script>
        const hamburger = document.querySelector(".hamburger");
        const navMenu = document.getElementById("nav-menu");

        hamburger.addEventListener("click", () => {
            navMenu.classList.toggle("open");

            // Menu visibility will be managed via CSS transitions
            if (navMenu.classList.contains("open")) {
                navMenu.style.visibility = "visible"; // Menu is visible when opening
            } else {
                setTimeout(() => {
                    navMenu.style.visibility = "hidden"; // Menu is hidden after transition
                }, 300); // Match the CSS transition time
            }
        });

        function resetFilters() {
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('acfacility');
            urlParams.delete('capacity');
            urlParams.delete('studentpass');
            urlParams.delete('wheelchair');
            window.location.search = urlParams.toString();
        }
    </script>
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
        <li><a href="tickets.php">Bus Pass</a></li>
        <li><a href="localbusroutes.php">Bus Routes</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="admin_buses.php">Admin</a></li>
    </ul>
</footer>
</html>
