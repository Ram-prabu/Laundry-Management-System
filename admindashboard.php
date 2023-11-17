<?php
require 'config.php';
if (empty($_SESSION["id"])) {
    header("Location: adminlogin.php");
}

$user_id = $_SESSION["id"];
$query = "SELECT wash_and_fold, wash_and_iron, dry_clean, delivery_charge FROM price WHERE change_id = 1";
$result = mysqli_query($conn, $query);

// Fetch prices from the database
$row = mysqli_fetch_assoc($result);

// Store prices in variables
$washAndFoldPrice = $row['wash_and_fold'];
$washAndIronPrice = $row['wash_and_iron'];
$dryCleanPrice = $row['dry_clean'];
$deliveryChargePrice = $row['delivery_charge'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <style>
        body {
            background-image: url("https://static.vecteezy.com/system/resources/previews/014/720/226/non_2x/dark-blue-smoke-background-navy-blue-watercolor-and-paper-texture-beautiful-dark-gradient-hand-drawn-by-brush-grunge-background-watercolor-wash-aqua-painted-texture-close-up-grungy-design-free-vector.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: rgb(255, 255, 255);
            text-align: center;
            padding: 20px;
        }

        .card-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .card {
            width: 250px;
            height: 150px;
            margin: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            color: royalblue;
            text-align: center;
        }

        .card-2 {
            background-color: #ADD8E6;
        }

        .card-7 {
            background-color: #5eb3e4;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            color: rgb(255, 255, 255);
        }

        th, td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #ADD8E6;
            color: #333;
        }

        .logout-button {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #e67575; /* Red background color */
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        footer {
            background-color: #333;
            color: royalblue;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .card-3 {
            background-color: #a3e89b; /* Light Green */
        }
    </style>
</head>

<body>
    <h1>Dashboard</h1>

    <!-- Card Container -->
    <div class="card-container">
        <!-- View Requests Card -->
        <div class="card card-2">
            <h3>View Requests</h3>
            <p>View all requests here</p>
            <a href="adminview_request.php">View Now</a>
        </div>

        <!-- Feedback Card -->
        <div class="card card-7">
            <h3>Feedback</h3>
            <p>Give your feedback about our service</p>
            <a href="adminfeedback.html">Feedback Form</a>
        </div>
    </div>

    <!-- Card Container -->
    <div class="card-container">
        <!-- View Requests Card -->
        <div class="card card-3"> <!-- Updated class to card-3 -->
            <h3>Price</h3>
            <p>Change price here</p>
            <a href="changeprice.php">View Now</a>
        </div>

        <!-- Logout Button -->
        <button class="logout-button" onclick="location.href='adminlogout.php'">Logout Now</button>
    </div>

    <!-- Price Table -->
    <h3><b>Price List</b></h3>
    <table>
        <tr>
            <th>Service</th>
            <th>Price</th>
        </tr>
        <tr>
            <td><b>Wash and Fold</b></td>
            <td><em>&#8377;<?php echo number_format($washAndFoldPrice, 2); ?></em></td>
        </tr>
        <tr>
            <td><b>Wash and Iron</b></td>
            <td><em>&#8377;<?php echo number_format($washAndIronPrice, 2); ?></em></td>
        </tr>
        <tr>
            <td><b>Dry Clean</b></td>
            <td><em>&#8377;<?php echo number_format($dryCleanPrice, 2); ?></em></td>
        </tr>
        <tr>
            <td><b>Delivery[above 20km]</b></td>
            <td><em>&#8377;<?php echo number_format($deliveryChargePrice, 2); ?></em> [per cloth]</td>
        </tr>
    </table>

    <!-- Footer -->
    <footer>
        <p>&copy; Created by RHR LAUNDRY SERVICE.</p>
    </footer>
</body>

</html>
