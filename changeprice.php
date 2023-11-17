<?php
require 'config.php';

// Handle form submission to update prices
$updateMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize the input values
    $washFold = mysqli_real_escape_string($conn, $_POST['wash_and_fold']);
    $washIron = mysqli_real_escape_string($conn, $_POST['wash_and_iron']);
    $dryClean = mysqli_real_escape_string($conn, $_POST['dry_clean']);
    $deliveryCharge = mysqli_real_escape_string($conn, $_POST['delivery_charge']);

    // Update prices in the database
    $updateQuery = "UPDATE price SET wash_and_fold='$washFold', wash_and_iron='$washIron', dry_clean='$dryClean', delivery_charge='$deliveryCharge' WHERE change_id = 1";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Fetch updated prices
        $query = "SELECT * FROM price WHERE change_id = 1";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $updateMessage = "Prices updated successfully!";
    } else {
        $updateMessage = "Error updating prices. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Requests</title>
    <style>
        body {
            background-image: url("https://static.vecteezy.com/system/resources/previews/001/984/880/original/abstract-colorful-geometric-overlapping-background-and-texture-free-vector.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        form {
            margin-top: 20px;
            text-align: center;
        }

        label {
            margin-right: 10px;
            font-size: 18px;
            display: block;
        }

        input {
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            display: block;
            width: 300px; /* Adjust the width as needed */
            margin: 10px auto; /* Center the input */
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            margin-bottom: 15px;
        }

        a {
            display: block;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <!-- Display alert message if any -->
    <?php if ($updateMessage): ?>
        <div class="alert">
            <?php echo $updateMessage; ?>
        </div>
    <?php endif; ?>

    <!-- Form to update prices -->
    <form method="post" action="">
        <label for="wash_and_fold">Wash and fold:</label>
        <input type="text" name="wash_and_fold" value="<?php echo isset($row['wash_fold']) ? $row['wash_fold'] : ''; ?>">

        <label for="wash_and_iron">Wash and iron:</label>
        <input type="text" name="wash_and_iron" value="<?php echo isset($row['wash_iron']) ? $row['wash_iron'] : ''; ?>">

        <label for="dry_clean">Dry clean:</label>
        <input type="text" name="dry_clean" value="<?php echo isset($row['dry_clean']) ? $row['dry_clean'] : ''; ?>">

        <label for="delivery_charge">Delivery Charge:</label>
        <input type="text" name="delivery_charge" value="<?php echo isset($row['delivery_charge']) ? $row['delivery_charge'] : ''; ?>">

        <button type="submit">Update</button>
    </form>

    <!-- Go back button to admin dashboard -->
    <a href="admindashboard.php">Go Back to Admin Dashboard</a>

</body>

</html>
