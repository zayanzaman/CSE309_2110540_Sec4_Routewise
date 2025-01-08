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
        <h1>Travel Safety</h1>
    </section>

    <main class="main-content">
        <section class="route-grid">

            <div class="route-card">
                <div class="route-list">
                    <h2>Travel Safety Tips for Local Buses in Dhaka</h2>
                    <p>Traveling by bus in Dhaka can be a convenient way to navigate the city. Here are some essential safety tips to keep in mind:</p>
                    <ul style="list-style-type: none;">
                        <li><strong>Stay Alert:</strong> Always be aware of your surroundings. Keep your belongings secure and avoid distractions like your phone while boarding or disembarking.</li>
                        <li><strong>Travel During Daylight:</strong> Whenever possible, use buses during daylight hours for better visibility and safety.</li>
                        <li><strong>Use Designated Stops:</strong> Board and disembark only at official bus stops to ensure you are in a safe area.</li>
                        <li><strong>Keep Personal Items Close:</strong> Use a crossbody bag or secure your backpack in front of you to deter pickpockets.</li>
                        <li><strong>Be Cautious of Crowds:</strong> If a bus is overcrowded, consider waiting for the next one. It’s safer and more comfortable.</li>
                        <li><strong>Inform Someone:</strong> Let a friend or family member know your travel plans, especially if you are unfamiliar with the area.</li>
                        <li><strong>Know Your Route:</strong> Familiarize yourself with the bus routes and stops ahead of time to avoid confusion.</li>
                        <li><strong>Emergency Contacts:</strong> Keep a list of emergency contacts and local numbers for assistance in case of any issues.</li>
                    </ul>
                </div>
            </div>
            
            <div class="route-card">
                <div class="route-list">
                    <h1>999 - National Emergency Number</h1>
                    <p>Get Immediate Assistance</p>
                </div>
            </div>

            <div class="route-card">
                <div class="route-list">
                    <h1>102 - Fire Service</h1>
                    <p>Dedicated Number for Fire Service Department</p>
                </div>
            </div>

            <div class="route-card">
                <div class="route-list">
                    <h1>333 - Information</h1>
                    <p>National Information and Query Helpline</p>
                </div>
            </div>

            <div class="route-card">
                <div class="route-list">
                    <h1>+880 17110 41305 - BRTC Complaints</h1>
                    <p>Customer Service and Complaints Number for BRTC</p>
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
