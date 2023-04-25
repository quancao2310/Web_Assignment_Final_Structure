<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: /btl/account/page/login.php");
    exit;
}
include "../modules/connect.php";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$prod_id = test_input($_POST["prod_id"]);
$quantity = test_input($_POST["quantity"]);
$size = test_input($_POST["size"]);
$color = test_input($_POST["color"]);
if (empty($prod_id) || !is_numeric($prod_id) || is_float($prod_id) || (int)$prod_id <= 0) {
    mysqli_close($connection);
    http_response_code(400);
    exit;
}
if (empty($quantity) || !is_numeric($quantity) || is_float($quantity) || (int)$quantity <= 0) {
    mysqli_close($connection);
    http_response_code(400);
    exit;
}
if (empty($size) || $size == "" || empty($color) || $color == "") {
    mysqli_close($connection);
    http_response_code(400);
    exit;
}
$sql = "DELETE FROM cart_info 
        WHERE user_id = " . $_SESSION["user_id"] .
    " AND product_id = " . $prod_id .
    " AND chosen_quantity = " . $quantity .
    " AND chosen_size = '" . $size . "'" .
    " AND chosen_color = '" . $color . "'" .
    " LIMIT 1";
if (mysqli_query($connection, $sql)) {
    echo "Xoá khỏi giỏ hàng thành công!";
} else {
    mysqli_close($connection);
    http_response_code(500);
    exit;
}
mysqli_close($connection);
