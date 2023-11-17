<?php
require 'config.php';
if (empty($_SESSION["id"])) {
    header("Location: adminlogin.php");
    
}
$user_id = $_SESSION["id"];
$query = "SELECT laundry_requests.id,user_id,users.name,pickup_date,pickup_time,delivery_date,delivery_time,wash_fold,wash_iron,dry_clean,price,payment,status FROM laundry_requests,users where users.id=laundry_requests.user_id;";

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
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
        <table id="mytable">
            <tr>
                <th>Request id</th>
                <th>User id</th>
                <th>User Name</th>
                <th>Pickup Date</th>
                <th>Pickup Time</th>
                <th>Delivery Date</th>
                <th>Delivery Time</th>
                <th>Wash and Fold</th>
                <th>Wash and Iron</th>
                <th>Dry Clean</th>
                <th>Price</th>
                <th>Payment Status</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr id="row-<?php echo $row['id']; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['pickup_date']; ?></td>
                    <td><?php echo $row['pickup_time']; ?></td>
                    <td><?php echo $row['delivery_date']; ?></td>
                    <td><?php echo $row['delivery_time']; ?></td>
                    <td><?php echo $row['wash_fold']; ?></td>
                    <td><?php echo $row['wash_iron']; ?></td>
                    <td><?php echo $row['dry_clean']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['payment']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <?php if ($row['status'] !== 'Complete' && $row['payment'] == 'Paid'): ?>
                            <button onclick="complete(<?php echo $row['id']; ?>, this)">Complete</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
        <script>
            function complete(requestId, button) {
                var confirmed = confirm("Are you sure you want to mark this request as complete?");
                if (confirmed) {
                    // Send an AJAX request to update the status in the database
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            // Handle the response if needed
                            console.log(this.responseText);
                            // Remove only the button from the table
                            button.parentNode.removeChild(button);
                            location.reload(true);
                        }
                    };
                    xhttp.open("GET", "update_status.php?id=" + requestId, true);
                    xhttp.send();
                }
            }
        </script>

    <?php else: ?>
        <p>No laundry requests found</p>
    <?php endif; ?>
    <br>
</body>

</html>
