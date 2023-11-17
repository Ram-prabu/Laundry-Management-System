<?php
require 'config.php';

if (isset($_GET['id'])) {
    $requestId = $_GET['id'];

    // Assuming your database table is named laundry_requests
    $query = "UPDATE laundry_requests SET payment='Paid' WHERE id=?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $requestId);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    echo "Payment status updated successfully";
} else {
    echo "Invalid request";
}
?>
