<?php
require 'config.php';

if(isset($_GET['id'])) {
  $requestId = $_GET['id'];
  $query = "UPDATE laundry_requests SET status='Complete' WHERE id=?";
  
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "i", $requestId);
  mysqli_stmt_execute($stmt);
  
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
  
  echo "Status updated successfully";
} else {
  echo "Invalid request";
}
?>
