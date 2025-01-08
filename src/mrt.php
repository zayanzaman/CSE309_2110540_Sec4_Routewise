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
        <h1>Dhaka Mass Rapid Transit</h1>
    </section>

    <!-- Main content starts here -->

    <main class="main-content">

        <div class="rapidimg-container">
            <h2>Dhaka MRT Station Map</h2>
            <img src="imgs/mrtmap.png" alt="MRT Map" class="mrt-map">
            <p>Operational Line(s): MRT Line 6</p>
        </div>

        <section class="route-grid">

            <div class="route-card">
                <div class="title-bar">Dhaka MRT Line 6</div>
                <div class="route-list">
                    <span>Uttara North</span>
                    <span>Uttara Center</span>
                    <span>Uttara South</span>
                    <span>Pallabi</span>
                    <span>Mirpur-11</span>
                    <span>Mirpur-10</span>
                    <span>Kazipara</span>
                    <span>Shewrapara</span>
                    <span>Agargaon</span>
                    <span>Bijoy Sarani</span>
                    <span>Farmgate</span>
                    <span>Kawran Bazar</span>
                    <span>Shahbagh</span>
                    <span>Dhaka University</span>
                    <span>Bangladesh Secretariat</span>
                    <span>Motijheel</span>
                    <span>Kamalapur*</span>
                </div>
            </div>

            <div class="route-card">
                <div class="title-bar-marked">Dhaka MRT Line 1 Airport Route</div>
                <div class="route-list">
                    <span>Shahjalal International Airport</span>
                    <span>Shahjalal International Airport Terminal 3</span>
                    <span>Khilkhet</span>
                    <span>Nadda</span>
                    <span>Notun Bazar</span>
                    <span>North Badda</span>
                    <span>Badda</span>
                    <span>Aftabnagar</span>
                    <span>Rampura</span>
                    <span>Malibagh</span>
                    <span>Rajarbagh</span>
                    <span>Kamalapur</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="title-bar-marked">Dhaka MRT Line 1 Purbachal Route</div>
                <div class="route-list">
                    <span>Notun Bazar</span>
                    <span>Nadda</span>
                    <span>Joar Sahara</span>
                    <span>Boalia</span>
                    <span>Mastul</span>
                    <span>SHCS</span>
                    <span>Purbachal Centre</span>
                    <span>Purbachal East</span>
                    <span>Purbachal Terminal</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="title-bar-marked">Dhaka MRT Line 2</div>
                <div class="route-list">
                    <span>Gabtoli</span>
                    <span>Dhaka Uddan</span>
                    <span>Mohammadpur</span>
                    <span>Jhigatola</span>
                    <span>Science Laboratory</span>
                    <span>New Market</span>
                    <span>Azimpur</span>
                    <span>Palashi</span>
                    <span>DHK Medical College</span>
                    <span>Gulistan</span>
                    <span>Golap Shah Mazar</span>
                    <span>Nayabazar</span>
                    <span>Sadarghat</span>
                    <span>Motijheel</span>
                    <span>Kamalapur</span>
                    <span>Manda</span>
                    <span>Dakkhingaon</span>
                    <span>Damripara</span>
                    <span>Signboard</span>
                    <span>Vuighar</span>
                    <span>Jalkuri</span>
                    <span>Downtown Narayanganj</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="title-bar-marked">Dhaka MRT Line 4</div>
                <div class="route-list">
                    <span>Kamalapur</span>
                    <span>Sayedabad</span>
                    <span>Jatrabari</span>
                    <span>Shonir Akhra</span>
                    <span>Signboard</span>
                    <span>CTG Road</span>
                    <span>Kanchpur</span>
                    <span>Madanpur</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="title-bar-marked">Dhaka MRT Line 5 Northern Route</div>
                <div class="route-list">
                    <span>Hemayetpur</span>
                    <span>Baliarpur</span>
                    <span>Bilamalia</span>
                    <span>Amin Bazar</span>
                    <span>Gabtoli</span>
                    <span>Darus-Salam</span>
                    <span>Mirpur 1</span>
                    <span>Mirpur 10</span>
                    <span>Mirpur 14</span>
                    <span>Kochukhet</span>
                    <span>Banani</span>
                    <span>Gulshan-2</span>
                    <span>Notun Bazar</span>
                    <span>Vatara</span>
                </div>
            </div>
            
            <div class="route-card">
                <div class="title-bar-marked">Dhaka MRT Line 5 Southern Route</div>
                <div class="route-list">
                    <span>Gabtoli</span>
                    <span>Technical Circle</span>
                    <span>Kallyanpur</span>
                    <span>Shyamoli</span>
                    <span>College Gate</span>
                    <span>Asad Gate</span>
                    <span>Russel Square</span>
                    <span>Karwan Bazar</span>
                    <span>Hatirjheel</span>
                    <span>Tejgaon</span>
                    <span>Aftabnagar</span>
                    <span>Aftabnagar Centre</span>
                    <span>Aftabnagar East</span>
                    <span>Nasirabad</span>
                    <span>Dasherkandi</span>
                </div>
            </div>        
            
        </section>        
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
