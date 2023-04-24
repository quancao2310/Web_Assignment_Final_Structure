<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: /btl/account/page/login.php");
    exit;
}
include "../modules/connect.php";
$sql = "SELECT cart_info.*, product_name 
        FROM cart_info 
        INNER JOIN product_info 
        ON cart_info.product_id = product_info.product_id
        WHERE cart_info.user_id = " .  $_SESSION["user_id"];
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "";
} else {
    $productList = mysqli_fetch_all($result);
    echo json_encode($productList);
}
mysqli_close($connection);
exit;
