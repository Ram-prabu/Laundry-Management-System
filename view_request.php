<?php
require 'config.php';

if (empty($_SESSION["id"])) {
    header("Location: login.php");
}
$user_id = $_SESSION["id"];
$query = "SELECT * FROM laundry_requests WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ADD8E6;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

    </style>
</head>

<body>

    <h2>Current Requests</h2>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Pickup Date</th>
                <th>Pickup Time</th>
                <th>Delivery Date</th>
                <th>Delivery Time</th>
                <th>Wash and Fold</th>
                <th>Wash and Iron</th>
                <th>Dry Clean</th>
                <th>Price</th>
                <th>Payment status</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['pickup_date']; ?></td>
                    <td><?php echo $row['pickup_time']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['delivery_time']; ?></td>
                    <td><?php echo $row['wash_fold']; ?></td>
                    <td><?php echo $row['wash_iron']; ?></td>
                    <td><?php echo $row['dry_clean']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td id="payment-status-<?php echo $row['id']; ?>"><?php echo $row['payment']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if ($row['payment'] == 'Not Paid'): ?>
                          <button onclick="makePayment('<?php echo $row['id']; ?>', this)">Make Payment</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No laundry requests found, book your request below</p>
    <?php endif; ?>
    <br><br><a href="laundry_request.php">Book now</a>
    <br>

    <script>
        function makePayment(requestId, button) {
            var confirmed = confirm("Are you sure you want to make the payment?");
            if (confirmed) {
                // Send an AJAX request to update the payment status
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // Handle the response if needed
                        console.log(this.responseText);
                        // Remove the button from the table
                        button.parentNode.removeChild(button);
                    }
                };
                xhttp.open("GET", "update_payment.php?id=" + requestId, true);
                xhttp.send();
            }
        }
    </script>
</body>

</html>
