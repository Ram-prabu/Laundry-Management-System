<?php
require 'config.php';

// Check if the user is logged in
if (empty($_SESSION["id"])) {
    header("Location: login.php");
    exit(); // Ensure that the script stops execution after the redirection
}
$requestId = $_GET['requestId'];
// Assuming you have a valid database connection in $conn
$user_id = $_SESSION["id"];
$query = "SELECT * FROM laundry_requests WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Fetch the current request from the result
$row = mysqli_fetch_assoc($result);

// Extract the request ID and fetch the corresponding price from the database
$id = $row['id'];
$priceQuery = "SELECT price,pickup_date, pickup_time, delivery_date, delivery_time, wash_fold, wash_iron, dry_clean FROM laundry_requests WHERE id = '$requestId'";
$priceResult = mysqli_query($conn, $priceQuery);

// Fetch the price from the result
$priceRow = mysqli_fetch_assoc($priceResult);
$amountFromDatabase = $priceRow['price'];

// Generate a random bill ID
$billId = rand(100000, 999999);

// Calculate a random total amount (replace with the actual amount from the database)
$totalAmount = number_format($amountFromDatabase, 2);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Bill</title>
    <style>
        body {
            background-image: url('https://img.freepik.com/free-vector/abstract-watercolor-pastel-background_87374-139.jpg');
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .bill-container {
            max-width: 600px;
            padding: 20px;
            background-color: #add8e6;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .bill-info {
            margin-top: 20px;
            text-align: center;
        }

        .bill-info p {
            margin: 5px 0;
            color: #555;
        }

        .status-container {
            background-color: white;
            color: black;
            padding: 10px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .status-container p {
            font-weight: bold;
        }

        .status-container img {
            width: 20px;
            height: 20px;
            margin-left: 10px;
        }

        .action-buttons {
            margin-top: 20px;
            text-align: center;
        }

        .action-buttons button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            margin-right: 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .action-buttons button:hover {
            background-color: #45a049;
        }

        .card-header {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>

<body>
    
    <div class="bill-container">
        <div class="card-header">
            <p>To RHR LAUNDRY</p>
        </div>
        <div class="status-container">
            <p><strong>Paid Successfully</strong></p>
            <img src="https://img.icons8.com/color/48/000000/checkmark.png" alt="Checkmark">
        </div>
        <h2>Bill</h2>
        <div class="bill-info">
            <p><strong>Bill ID:</strong> <?php echo $billId; ?></p>
            <p><strong>Total Amount:</strong> <em>&#8377;<?php echo $totalAmount; ?></em></p>
            <p><strong>Total Amount (In Words):</strong> <?php echo convertNumberToWords($totalAmount); ?> </p>
            <table>
            <tr>
                <th>Pickup Date</th>
                <th>Pickup Time</th>
                <th>Delivery Date</th>
                <th>Delivery Time</th>
                <th>Wash & Fold</th>
                <th>Wash & Iron</th>
                <th>Dry Clean</th>
            </tr>
            <tr>
                <td><?php echo $priceRow['pickup_date']; ?></td>
                <td><?php echo $priceRow['pickup_time']; ?></td>
                <td><?php echo $priceRow['delivery_date']; ?></td>
                <td><?php echo $priceRow['delivery_time']; ?></td>
                <td><?php echo $priceRow['wash_fold']; ?></td>
                <td><?php echo $priceRow['wash_iron']; ?></td>
                <td><?php echo $priceRow['dry_clean']; ?></td>
            </tr>
        </table>
        </div>
        <div class="action-buttons">
            <button onclick="goBack()">Go Back</button>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

    <?php
    function convertNumberToWords($number)
    {
        $words = "";

        $num = explode('.', $number);
        $integerPart = (int) $num[0];
        $decimalPart = isset($num[1]) ? (int) $num[1] : 0;

        $words .= convertToWordsUnderThousand($integerPart);
        if ($integerPart > 0) {
            $words .= ' Rupees';
        }

        if ($decimalPart > 0) {
            $words .= ' and ' . convertToWordsUnderThousand($decimalPart) . ' Paise';
        }

        $words .= ' Only';

        return $words;
    }

    function convertToWordsUnderThousand($num)
    {
        $units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        $teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        $words = '';

        $hundreds = (int)($num / 100);
        $tensAndUnits = $num % 100;

        if ($hundreds > 0) {
            $words .= convertToWordsUnderTen($hundreds) . ' Hundred';
        }

        if ($tensAndUnits > 0) {
            if ($hundreds > 0) {
                $words .= ' and ';
            }

            if ($tensAndUnits < 10) {
                $words .= convertToWordsUnderTen($tensAndUnits);
            } elseif ($tensAndUnits < 20) {
                $words .= convertToWordsUnderTwenty($tensAndUnits);
            } else {
                $words .= convertToWordsUnderHundred($tensAndUnits);
            }
        }

        return $words;
    }

    function convertToWordsUnderHundred($num)
{
    $words = '';
    $units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
    $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

    $tensDigit = (int)($num / 10);
    $unitsDigit = $num % 10;

    if ($tensDigit > 0) {
        $words .= $tensDigit > 1 ? $tens[$tensDigit] : '';
        if ($unitsDigit > 0) {
            $words .= ' ' . $units[$unitsDigit];
        }
    } else {
        $words .= convertToWordsUnderTen($unitsDigit);
    }

    return $words;
}


    function convertToWordsUnderTwenty($num)
    {
        $teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        return $teens[$num - 11];
    }

    function convertToWordsUnderTen($num)
    {
        $units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        return $units[$num];
    }
    ?>
</body>

</html>
