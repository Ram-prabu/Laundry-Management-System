<?php
require 'config.php';
if (empty($_SESSION["id"])) {
    header("Location: login.php");
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
      background-image: url("https://static.vecteezy.com/system/resources/previews/019/011/110/non_2x/dark-blue-smoke-background-navy-blue-watercolor-and-paper-texture-beautiful-dark-gradient-hand-drawn-by-brush-grunge-background-watercolor-wash-aqua-painted-texture-close-up-grungy-design-vector.jpg");
      background-repeat: no-repeat;
      background-size: cover;
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    h2 {
      color: #fff;
      text-align: center;
      padding: 20px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    /* Style for the container holding the cards */
    .card-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      margin: 20px;
    }

    /* Style for the card-like structure */
    .card {
      width: 250px;
      height: 150px;
      margin: 10px;
      padding: 10px;
      box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
      border-radius: 5px;
      color: #fff;
      text-align: center;
    }

    /* Colors for the different cards */
    .card-1 {
      background-color: #ff9f80; /* Light Coral */
    }

    .card-2 {
      background-color: #aad8e6; /* Light Blue */
    }

    .card-3 {
      background-color: #a3e89b; /* Light Green */
    }

    .card-4 {
      background-color: #f0f0ab; /* Light Yellow */
    }
    .logout-button {
      position:fixed;
      top: 2px;
      right: 2px;
      background-color: #e67575; /* Red background color */
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .card-6 {
      background-color: #f3a3a3; /* Light Salmon */
    }

    .card-7 {
      background-color: #9a8cf0; /* Light Slate Blue */
    }

    /* Style for the price table */
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
      color: #fff;
    }

    th, td {
      text-align: left;
      padding: 10px;
    }

    th {
      background-color: #aad8e6; /* Light Blue */
    }

    /* Footer */
    footer {
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      text-align: center;
      padding: 10px;
      position:relative;
      bottom: 0;
      width: 100%;
    }
    
  </style>
</head>
<body>
  <h2>Dashboard</h2>

  <!-- Card Container -->
  <div class="card-container">

    <!-- Laundry Request Card -->
    <div class="card card-1">
      <h3>Laundry Request</h3>
      <p>Book a new laundry request</p>
      <a href="laundry_request.php">Book now</a>
    </div>

    <!-- View Request Card -->
    <div class="card card-2">
      <h3>View Request</h3>
      <p>View your request here</p>
      <a href="view_request.php">View now</a>
    </div>

    <!-- Notification Card -->
    <div class="card card-3">
      <h3>Notification</h3>
      <p>View notifications and updates</p>
      <a href="notification.php">View now</a>
    </div>

    <!-- Change Password Card -->
    <div class="card card-4">
      <h3>Change Password</h3>
      <p>Update your account password</p>
      <a href="forgot_password.php">Change now</a>
    </div>

    <!-- Logout Button -->
    <button class="logout-button" onclick="window.location.href='logout.php'">
      <span>Logout</span>
    </button>

    <!-- Contact Us Card -->
    <div class="card card-6">
      <h3>Contact Us</h3>
      <p>Get in touch with our support team</p>
      <a href="contact.html">Contact now</a>
    </div>

    <!-- Feedback Card -->
    <div class="card card-7">
      <h3>Feedback</h3>
      <p>Give your feedback about our service</p>
      <a href="feedback.html">Feedback form</a>
    </div>

  </div>

  <!-- Price Table -->
  <h2><b>Price List</b></h2>
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
    <p>&copy; created by RHR LAUNDRY</p>
  </footer>
</body>
</html>
