<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Routewise</title>
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
        <h1>About Us</h1>
    </section>

    <main class="main-content">
        <section class="route-grid">

            <div class="route-card">
                <div class="route-list">
                    <h2>Routewise</h2>
                    <p>Routewise is a fictional company. Get detailed information about local buses and their routes in Dhaka with Routewise, your reliable transport guide.</p>
                    
                </div>
            </div>
            
            <div class="route-card">
                <div class="title-bar">Website Created by</div>
                <div class="route-list">
                    <h2>Zayan Zaman</h2>
                    <p>2110540<br>School of SETS<br>Department of CSE<br>Web Applications & Internet Project</p>
                </div>
            </div>
</main>
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
        <li><a href="index.php">Home</a></li>
        <li><a href="tickets.php">Bus Pass</a></li>
        <li><a href="localbusroutes.php">Bus Routes</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="admin_buses.php">Admin</a></li>
    </ul>
</footer>
</html>
