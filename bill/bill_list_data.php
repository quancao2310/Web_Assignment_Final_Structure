<?php
session_start();

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

$sql = "SELECT * FROM payment_info WHERE user_id=" . $_SESSION["user_id"];
$result = mysqli_query($db_connect, $sql);
if (mysqli_num_rows($result) == 0) {
  // User has no bill during the past, so return null
  echo "";
}
else {
  // Get all bills from payment info
  $billList = mysqli_fetch_all($result, MYSQLI_ASSOC);
  // Encode them
  echo json_encode($billList);
  // They should have the following format after fetching and encoding:
  // [ [bill_id, user_id, customer_name ... status], [bill_id, user_id, customer_name ... status], ... ]
}
mysqli_close($db_connect) ;
exit;
?>