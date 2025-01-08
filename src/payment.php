<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bus_pass_id = $_GET['bus_pass_id'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($bus_pass_id)) {
        $stmt = $conn->prepare("UPDATE BusPassInfo SET PaymentStatus = 'Paid' WHERE BusPassID = ?");
        $stmt->bind_param("s", $bus_pass_id);

        if ($stmt->execute()) {
            $success_message = "Payment successful! Your bus pass has been activated. Bus Pass ID: " . $bus_pass_id;
            $payment_successful = true;  // Set a flag indicating successful payment
        } else {
            $error_message = "Error processing payment. Please try again.";
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
    <title>Payment Gateway</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f22d7c;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .payment-card {
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .input-group label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .input-group input {
            width: 90%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .input-group input:focus {
            border-color: #4CAF50;
        }

        .btn-container {
            margin-top: 20px;
            width: 100%;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f22d7c;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e4216f;
        }

        .back-btn {
            background-color: #4CAF50;
            margin-top: 10px;
        }

        .back-btn:hover {
            background-color: #45a049;
        }

        .red-text {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-card">
            <h2 style="color:#f22d7c">Bkash Payment</h2>
            
            <?php
            if (isset($success_message)) {
                echo "<p style='color: green;'>$success_message</p>";
                echo "<p class='red-text'>Make sure to note down your bus pass ID.</p>";  // Add reminder in red text
            } elseif (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>

            <?php if (!isset($payment_successful)) { ?>
                <form method="POST" action="payment.php?bus_pass_id=<?php echo $bus_pass_id; ?>">
                    <div class="input-group">
                        <label for="name">Name on Card</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="input-group">
                        <label for="card-number">Card Number</label>
                        <input type="text" id="card-number" name="card-number" maxlength="16" required>
                    </div>

                    <div class="input-group">
                        <label for="expiry">Expiry Date</label>
                        <input type="month" id="expiry" name="expiry" required>
                    </div>

                    <div class="input-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" maxlength="3" required>
                    </div>

                    <p style="color:gray">Paying BDT500 to Routewise Ltd.</p>
                    <div class="btn-container">
                        <button type="submit">Pay Now</button>
                    </div>
                </form>
            <?php } ?>

            <?php if (isset($payment_successful)) { ?>
                <div class="btn-container">
                    <a href="tickets.php"><button type="button" class="back-btn">Go to Download Pass</button></a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
