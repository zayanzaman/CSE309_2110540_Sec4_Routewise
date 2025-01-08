<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $email = $message = "";
$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "All fields are required!";
    } else {
        $stmt = $conn->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $success_message = "Your message has been submitted successfully!";
        } else {
            $error_message = "Failed to submit your message. Please try again.";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
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
        <h1>Contact Us</h1>
    </section>

    <main class="main-content">

        <div class="form-container">

            <!-- Contact form -->
            <form class="contact-form" method="POST" action="contact.php">
            <h2>Get in Touch</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="5" required><?php echo htmlspecialchars($message); ?></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </main>
    
    <?php
        if (!empty($error_message)) {
            echo "<p style='color: red; text-align: center;'>$error_message</p>";
        }
        if (!empty($success_message)) {
            echo "<p style='color: green; text-align: center;'>$success_message</p>";
        }
    ?>

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
