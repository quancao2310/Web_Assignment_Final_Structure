<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_GET['bill_id']) || !ctype_digit($_GET['bill_id'])) {
  http_response_code(403);
  die();
}

$user_id = $_SESSION['user_id'];
$bill_id = $_GET["bill_id"];

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  http_response_code(500);
  echo json_encode("Database connection failed.");
  exit;
}

$query1 =
"SELECT * 
FROM payment_info 
WHERE user_id=$user_id AND bill_id=$bill_id";
$query2 =
"SELECT bi.*, img.image_1 
FROM bill_info bi 
INNER JOIN product_image img ON bi.product_id=img.product_id 
WHERE bi.user_id=$user_id AND bi.bill_id=$bill_id";
$sql1 = mysqli_query($db_connect, $query1);
$sql2 = mysqli_query($db_connect, $query2);
if ($sql1 && $sql2) {
  if (mysqli_num_rows($sql1) == 0) {
    http_response_code(404);
  }
  else {
    $data = array(
      "payment_info" => mysqli_fetch_assoc($sql1), 
      "bill_info" => mysqli_fetch_all($sql2, MYSQLI_ASSOC)
    );
    echo json_encode($data);
    http_response_code(200);
  }
}
else {
  http_response_code(500);
  echo json_encode("Query database failed");
}

mysqli_close($db_connect);
?>