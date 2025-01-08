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
        <h1>Interactive Map</h1>
        <p>Explore the rich history, culture, and landmarks of Dhaka.</p>
    </section>

    <main class="custom-main-content"> <!-- Updated class here -->
        <!-- Map Container -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116838.54842074345!2d90.39220505848253!3d23.775726164853904!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1730797080825!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <section class="tourist-destinations">
            <h2>Hot Spots in Dhaka</h2>
            <div class="grid-container">
    <div class="grid-item">
        <img src="imgs/t1.jpg" alt="HSI Airport">
        <h3>HSI Airport</h3>
        <p>Located in Uttara, the Hazrat Shahjalal International Airport is the largest airport in Bangladesh.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t2.jpg" alt="Uttara">
        <h3>Uttara</h3>
        <p>Uttara is a residential area known for its shopping centers and close proximity to the airport.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t3.jpg" alt="Gulshan">
        <h3>Gulshan</h3>
        <p>A high-end residential and commercial area, Gulshan is home to numerous embassies and businesses.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t4.jpg" alt="Banani">
        <h3>Banani</h3>
        <p>Banani is an affluent neighborhood known for its cafes, restaurants, and shopping outlets.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t5.jpg" alt="Dhanmondi">
        <h3>Dhanmondi</h3>
        <p>Dhanmondi is a well-known area for educational institutions, parks, and cultural centers.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t6.jpg" alt="Mirpur">
        <h3>Mirpur</h3>
        <p>Mirpur is famous for the national zoo and the Sher-e-Bangla National Cricket Stadium.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t7.jpg" alt="Bashundhara R/A">
        <h3>Bashundhara R/A</h3>
        <p>An upscale residential area, Bashundhara is home to the largest shopping mall in South Asia.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t8.jpg" alt="Shahbagh">
        <h3>Shahbagh</h3>
        <p>Shahbagh is a bustling area near Dhaka University, known for its political and cultural significance.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t9.jpg" alt="Old Dhaka">
        <h3>Old Dhaka</h3>
        <p>Rich in history and culture, Old Dhaka is known for its narrow streets, markets, and historic landmarks.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t10.jpg" alt="Farmgate">
        <h3>Farmgate</h3>
        <p>Farmgate is a busy commercial area in Dhaka, popular for transportation links and educational institutes.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t11.jpg" alt="Motijheel">
        <h3>Motijheel</h3>
        <p>Motijheel is the central business district of Dhaka, with banks, offices, and financial institutions.</p>
    </div>
    <div class="grid-item">
        <img src="imgs/t12.jpg" alt="Agargaon">
        <h3>Agargaon</h3>
        <p>Agargaon is known for government offices, the National Museum of Science and Technology, and parks.</p>
    </div>
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
