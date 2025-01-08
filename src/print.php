<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$database = "routewise_schema"; 

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pass_id = isset($_GET['pass_id']) ? $_GET['pass_id'] : '';

$bus_name = $boarding_point_name = $dropoff_point_name = '';
$pass_info = null;

if ($pass_id) {
    // To Fetch the pass information from BusPassInfo table
    $stmt = $conn->prepare("SELECT * FROM BusPassInfo WHERE BusPassID = ?");
    $stmt->bind_param("s", $pass_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pass_info = $result->fetch_assoc();

        // To Fetch bus name from the Buses table
        $bus_id = $pass_info['BusName'];
        $bus_stmt = $conn->prepare("SELECT bus_name FROM Buses WHERE bus_id = ?");
        $bus_stmt->bind_param("s", $bus_id);
        $bus_stmt->execute();
        $bus_result = $bus_stmt->get_result();
        if ($bus_result->num_rows > 0) {
            $bus_name = $bus_result->fetch_assoc()['bus_name'];
        }

        // To Fetch boarding point name from the Stations table
        $boarding_point_id = $pass_info['BoardingPoint'];
        $boarding_stmt = $conn->prepare("SELECT station_name FROM Stations WHERE station_id = ?");
        $boarding_stmt->bind_param("s", $boarding_point_id);
        $boarding_stmt->execute();
        $boarding_result = $boarding_stmt->get_result();
        if ($boarding_result->num_rows > 0) {
            $boarding_point_name = $boarding_result->fetch_assoc()['station_name'];
        }

        // To Fetch dropoff point name from the Stations table
        $dropoff_point_id = $pass_info['DropoffPoint'];
        $dropoff_stmt = $conn->prepare("SELECT station_name FROM Stations WHERE station_id = ?");
        $dropoff_stmt->bind_param("s", $dropoff_point_id);
        $dropoff_stmt->execute();
        $dropoff_result = $dropoff_stmt->get_result();
        if ($dropoff_result->num_rows > 0) {
            $dropoff_point_name = $dropoff_result->fetch_assoc()['station_name'];
        }
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
    <link rel="icon" href="imgs/logo-colour.png" type="image/x-icon">
    <title>Bus Pass</title>
    <style>
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 210mm;
            height: 297mm;
            margin: 20mm auto;
            padding: 15mm;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 120px;
            height: auto;
        }

        .header h1 {
            font-size: 32px;
            color: #004b6b;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #004b6b;
            color: white;
            font-size: 18px;
        }

        td {
            font-size: 16px;
            color: #555;
        }

        .print-btn {
            background-color: #004b6b;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .print-btn:hover {
            background-color: #00374d;
        }

        .error-message {
            color: red;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }

        .terms {
            font-size: 14px;
            color: #555;
            text-align: center;
            margin-top: 30px;
            padding: 10px;
            border-top: 1px solid #ddd;
        }

        .terms p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <img src="imgs/logo-colour.png" alt="Routewise Logo">
        <h1>Routewise</h1>
    </div>
    
    <h2 style="text-align: center; font-size: 24px; color: #004b6b;">BUS PASS</h2>

    <?php if ($pass_info): ?>
    <table>
        <tr>
            <th>Pass ID</th>
            <td><?php echo $pass_info['BusPassID']; ?></td>
        </tr>
        <tr>
            <th>Holder Name</th>
            <td><?php echo $pass_info['Name']; ?></td>
        </tr>
        <tr>
            <th>Bus Company</th>
            <td><?php echo $bus_name; ?></td>
        </tr>
        <tr>
            <th>Boarding Point</th>
            <td><?php echo $boarding_point_name; ?></td>
        </tr>
        <tr>
            <th>Dropoff Point</th>
            <td><?php echo $dropoff_point_name; ?></td>
        </tr>
        <tr>
            <th>Valid Month</th>
            <td><?php echo $pass_info['ValidMonth']; ?></td>
        </tr>
        <tr>
            <th>Year</th>
            <td><?php echo $pass_info['Year']; ?></td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>PAID</td>
        </tr>
    </table>
    
    <div style="text-align: center; margin-top: 20px;">
        <button class="print-btn" onclick="window.print()">Print</button>
    </div>
    
    <?php else: ?>
    <div class="error-message">
        <p>This pass is either invalid or the payment has not been completed.</p>
    </div>
    <?php endif; ?>

    <div class="terms">
        <p><strong>Terms and Conditions:</strong></p>
        <p>1. This bus pass is valid only for the holder mentioned above. The holder must carry the registered NID.</p>
        <p>2. Pass is non-transferable and must be used on the assigned bus routes only.</p>
        <p>3. Any misuse or fraudulent activity related to the pass will lead to cancellation.</p>
        <p>4. Payment must be made in full before use. Refunds are not applicable.</p>
        <p>5. The company reserves the right to modify or revoke the pass terms at any time.</p>
        <p>6. Navigate to the Contact Us section on routewise.com for any complaints or queries.</p>
    </div>
</div>

</body>
</html>
