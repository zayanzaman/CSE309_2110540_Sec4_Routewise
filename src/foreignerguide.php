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
    <style>
        .faq-answer {
            display: none;  
            padding-left: 15px; 
            margin-top: 5px;
        }

        .faq-toggle {
            cursor: pointer; 
            background-color: #f1f1f1; 
            border: none;
            padding: 10px;
            width: 100%; 
            text-align: left; 
            font-size: 16px;
            transition: background-color 0.3s; 
        }

        .faq-toggle:hover {
            background-color: #e0e0e0; 
        }
    </style>
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
        <h1>Foreigner FAQ Guide</h1>
    </section>

    <main class="main-content">
        <div class="faq-section">
            <div class="faq-item">
                <button class="faq-title faq-toggle">Know the bus routes and fares</button>
                <div class="faq-content faq-answer">
                    <p>Buses do not have any official timetables, and fares can vary. In general, the minimum fare is BDT 10, and it is incremented by approximately BDT 3 per kilometer. The fare is higher for air conditioned buses, with the minimum fare around BDT 50, incremented by approximately BDT 5 per kilometer on average. Students can avail a 50% discount on non-AC bus fares if they are carrying a valid ID card.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Be prepared for the crowd and the rush</button>
                <div class="faq-content faq-answer">
                    <p>Local buses in Dhaka are often overcrowded, especially during peak hours. You might have to stand or squeeze in with other passengers, and sometimes even hang on the door or the roof of the bus. The buses also stop frequently to pick up and drop off passengers, and they might not stop at the designated bus stops.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Be aware of the safety and security issues</button>
                <div class="faq-content faq-answer">
                    <p>Ensure you keep your belongings safe and be cautious of pickpockets. Avoid crowded areas if possible and stay vigilant at all times, especially during peak hours or in unfamiliar locations.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Respect the local culture and customs</button>
                <div class="faq-content faq-answer">
                    <p>When traveling on public transport in Dhaka, dress modestly and avoid behavior that might be considered disrespectful to local customs and culture. It’s important to be mindful and polite towards others on the bus.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Plan for longer travel times during rush hours</button>
                <div class="faq-content faq-answer">
                    <p>Traffic in Dhaka can be extremely congested, especially during rush hours in the morning and evening. It's best to allow extra time for travel, as delays are common due to heavy traffic and frequent stops.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Be cautious when boarding and exiting the bus</button>
                <div class="faq-content faq-answer">
                    <p>Many buses in Dhaka don't stop fully at every location, requiring passengers to board or disembark quickly. Be careful when getting on and off the bus to avoid accidents, and always keep an eye on your surroundings.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Avoid carrying large bags or luggage</button>
                <div class="faq-content faq-answer">
                    <p>Buses in Dhaka can be cramped, especially during busy periods. It’s advisable to avoid carrying large bags or luggage, as there may not be space, and it can be difficult to manage in crowded conditions.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Look out for women-only seating areas</button>
                <div class="faq-content faq-answer">
                    <p>Some buses have designated seating areas for women to ensure safety and comfort. If you’re a female passenger, check for these seats at the front or middle of the bus.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-title faq-toggle">Expect basic facilities on most buses</button>
                <div class="faq-content faq-answer">
                    <p>Most buses in Dhaka are quite basic, without amenities like Wi-Fi or restrooms. Make sure to prepare accordingly, especially if you're traveling longer distances within the city.</p>
                </div>
            </div>
        </div>
    </main>
    
    <script src="script.js"></script>
    <script>
        document.querySelectorAll('.faq-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                
                if (answer.style.display === "block") {
                    answer.style.display = "none"; 
                } else {
                    answer.style.display = "block"; 
                }
            });
        });
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
        <li><a href="index.php">Home</a></li>
        <li><a href="tickets.php">Bus Pass</a></li>
        <li><a href="localbusroutes.php">Bus Routes</a></li>
        <li><a href="information.php">Information</a></li>
        <li><a href="admin_buses.php">Admin</a></li>
    </ul>
</footer>
</html>
