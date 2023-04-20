<?php
session_start();
include "../utilities/connect.php";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset($_SESSION["login"]) && !$_SESSION["login"]) {
    mysqli_close($connection);
    http_response_code(400);
    exit;
} else {
    $price = 0;
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

    $getPrice = "SELECT product_price FROM product_info 
        WHERE product_id = " . $prod_id .
        " AND product_size LIKE '%" . $size . "%'" .
        " AND product_color LIKE '%" . $color . "%'";
    $result = mysqli_query($connection, $getPrice);
    if (mysqli_num_rows($result) == 0) {
        mysqli_close($connection);
        http_response_code(404);
        exit;
    } else {
        $priceData = mysqli_fetch_array($result);
        $price = $priceData[0] * $quantity;
    }

    $sql = "INSERT INTO cart_info VALUES (" . $_SESSION["user_id"] . ","
        . $prod_id . ","
        . $quantity . ",'"
        . $size . "','"
        . $color . "',"
        . $price . ")";
    if (mysqli_query($connection, $sql)) {
        echo "Đã thêm sản phẩm vào giỏ hàng!";
    } else {
        mysqli_close($connection);
        http_response_code(500);
        exit;
    }
}
mysqli_close($connection);
exit;
