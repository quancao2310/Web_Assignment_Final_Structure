<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
  http_response_code(403);
  die();
}

$user_id = $_SESSION['user_id'];

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  http_response_code(500);
  echo json_encode("Database connection failed.");
  exit;
}

$sql1 = mysqli_query($db_connect, "SELECT * FROM payment_info WHERE user_id=$user_id ORDER BY bill_id DESC");
$sql2 = mysqli_query($db_connect, "SELECT bi.*, img.image_1 FROM bill_info bi INNER JOIN product_image img ON bi.product_id=img.product_id WHERE bi.user_id=$user_id");
if ($sql1 && $sql2) {
  http_response_code(200);
  if (mysqli_num_rows($sql1) == 0) {
    echo json_encode("");
  }
  else {
    $data = array(
      "payment_info" => mysqli_fetch_all($sql1, MYSQLI_ASSOC), 
      "bill_info" => mysqli_fetch_all($sql2, MYSQLI_ASSOC)
    );
    echo json_encode($data);
  }
}
else {
  http_response_code(500);
  echo json_encode("Query database failed");
}

mysqli_close($db_connect);
?>