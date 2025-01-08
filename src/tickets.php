<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $nid = $bus_id = $boarding_point = $dropoff_point = $month = $year = "";
$success_message = $error_message = "";

$buses_result = $conn->query("SELECT bus_id, bus_name FROM Buses");

if (isset($_POST['bus_id'])) {
    $bus_id = $_POST['bus_id'];
    $stations_result = $conn->query("
        SELECT s.station_id, s.station_name
        FROM Stations s
        JOIN Bus_Stations bs ON s.station_id = bs.station_id
        WHERE bs.bus_id = $bus_id
    ");
} else {
    $stations_result = null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_pass'])) {
    $name = htmlspecialchars($_POST['name']);
    $nid = htmlspecialchars($_POST['nid']);
    $bus_id = htmlspecialchars($_POST['bus_id']);
    $boarding_point = htmlspecialchars($_POST['boarding_point']);
    $dropoff_point = htmlspecialchars($_POST['dropoff_point']);
    $month = htmlspecialchars($_POST['month']);
    $year = htmlspecialchars($_POST['year']);

    $bus_pass_id = rand(1000000000, 9999999999);

    $payment_status = "Unpaid";

    if (empty($name) || empty($nid) || empty($bus_id) || empty($boarding_point) || empty($dropoff_point) || empty($month) || empty($year)) {
        $error_message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO BusPassInfo (BusPassID, Name, NIDNumber, BusName, BoardingPoint, DropoffPoint, ValidMonth, Year, PaymentStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $bus_pass_id, $name, $nid, $bus_id, $boarding_point, $dropoff_point, $month, $year, $payment_status);

        if ($stmt->execute()) {
            header("Location: payment.php?bus_pass_id=$bus_pass_id");
            exit();
        } else {
            $error_message = "Failed to create your bus pass. Please try again.";
        }

        $stmt->close();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify_pass'])) {
    $pass_number = htmlspecialchars($_POST['pnum']);

    $stmt = $conn->prepare("SELECT * FROM BusPassInfo WHERE BusPassID = ? AND PaymentStatus = 'Paid'");
    $stmt->bind_param("s", $pass_number);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $valid_message = "This is a valid bus pass.";
    } else {
        $invalid_message = "Invalid bus pass or payment not completed.";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['download_pass'])) {
    $pass_number = htmlspecialchars($_POST['pnum']);
    
    $stmt = $conn->prepare("SELECT * FROM BusPassInfo WHERE BusPassID = ? AND PaymentStatus = 'Paid'");
    $stmt->bind_param("s", $pass_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pass_info = $result->fetch_assoc();
        $pass_id = $pass_info['BusPassID'];
        header("Location: print.php?pass_id=$pass_id");
        exit();
    } else {
        $invalid_message = "Invalid bus pass or payment not completed.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Pass</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imgs/logo-colour.png" type="image/x-icon">
    <script>  
        function loadStations(bus_id) {
            const form = document.getElementById('bus-pass-form');
            const boardingPointSelect = document.getElementById('boarding_point');
            const dropoffPointSelect = document.getElementById('dropoff_point');

            boardingPointSelect.innerHTML = "<option value=''>-- Select Boarding Point --</option>";
            dropoffPointSelect.innerHTML = "<option value=''>-- Select Dropoff Point --</option>";

            if (!bus_id) return;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "loadstations.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const stations = JSON.parse(xhr.responseText);
                    stations.forEach(station => {
                        const option = document.createElement("option");
                        option.value = station.station_id;
                        option.textContent = station.station_name;
                        boardingPointSelect.appendChild(option);
                        dropoffPointSelect.appendChild(option.cloneNode(true));
                    });
                }
            };
            xhr.send("bus_id=" + bus_id);
        }
    </script>
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
    <h1>Bus Pass</h1>
</section>

<main class="main-content">
    <aside class="sidebar">
        <h2>About Bus Pass</h2>
        <p>A bus pass allows unlimited travel on a selected bus company and route for a month, making it a great choice for those who travel frequently on the same route, such as for work, university, or school.</p>
        <br>
        <h2>Already Have a Pass?</h2>
        <form method="POST" action="tickets.php">
            <div class="form-group">
                <label for="pnum">Pass Number:</label>
                <input type="text" id="pnum" name="pnum" required>
            </div>    
            <button type="submit" name="verify_pass" style="background-color:orange;">Verify Pass</button>
            <button type="submit" name="download_pass" style="background-color:green;">Download Pass</button>
        </form>
        
        <?php
        if (!empty($valid_message)) {
            echo "<p style='color: green; text-align: center;'>$valid_message</p>";
        }
        if (!empty($invalid_message)) {
            echo "<p style='color: red; text-align: center;'>$invalid_message</p>";
        }
        ?>
    </aside>

    <div class="form-container">
        <form class="bus-pass-form" id="bus-pass-form" method="POST" action="tickets.php">
            <h2>Apply for Bus Pass</h2>
            <br>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="nid">NID Number:</label>
                <input type="text" id="nid" name="nid" required>
            </div>
            <div class="form-group">
                <label for="bus_id">Select Bus:</label>
                <select id="bus_id" name="bus_id" onchange="loadStations(this.value)" required>
                    <option value="">-- Select Bus --</option>
                    <?php while ($row = $buses_result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['bus_id']; ?>"><?php echo $row['bus_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="boarding_point">Boarding Point:</label>
                <select id="boarding_point" name="boarding_point" required>
                    <option value="">-- Select Boarding Point --</option>
                    <?php
                        if ($stations_result) {
                            while ($row = $stations_result->fetch_assoc()) {
                                echo "<option value='{$row['station_id']}'>{$row['station_name']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="dropoff_point">Dropoff Point:</label>
                <select id="dropoff_point" name="dropoff_point" required>
                    <option value="">-- Select Dropoff Point --</option>
                    <?php
                        if ($stations_result) {
                            while ($row = $stations_result->fetch_assoc()) {
                                echo "<option value='{$row['station_id']}'>{$row['station_name']}</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="month">Select Month:</label>
                <select id="month" name="month" required>
                    <option value="">-- Select Month --</option>
                    <?php foreach (range(1, 12) as $month_num) { ?>
                        <option value="<?php echo date("F", mktime(0, 0, 0, $month_num, 1)); ?>">
                            <?php echo date("F", mktime(0, 0, 0, $month_num, 1)); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>  
            <div class="form-group">
                <label for="year">Select Year:</label>
                <select id="year" name="year" required>
                    <option value="">-- Select Year --</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
            </div>    
            <br>          
            <button type="submit" class="submit-btn" name="create_pass">Proceed to Payment</button>
        </form>

        <?php
        if (!empty($success_message)) {
            echo "<p style='color: green; text-align: center;'>$success_message</p>";
        }
        if (!empty($error_message)) {
            echo "<p style='color: red; text-align: center;'>$error_message</p>";
        }
        ?>
    </div>
</main>

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
        <li><a href="index.php">Home</a></li>
        <li><a href="tickets.php">Bus Pass</a></li>
        <li><a href="localbusroutes.php">Bus Routes</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="admin_buses.php">Admin</a></li>
    </ul>
</footer>
</html>
