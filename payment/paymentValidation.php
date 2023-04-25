<?php
session_start();
include "../modules/connect.php";
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (isset($_SESSION["prod_list"])) {
    $_SESSION["prod_list"] = array();
}
$prod_list = json_decode($_POST["prod_list"]);
if (empty($prod_list) || count($prod_list) == 0) {
    mysqli_close($connection);
    http_response_code(400);
    exit;
}
for ($i = 0; $i < count($prod_list); $i++) {
    $prod_id = test_input($prod_list[$i][0]);
    $prod_quantity = test_input($prod_list[$i][1]);
    $prod_size = test_input($prod_list[$i][2]);
    $prod_col = test_input($prod_list[$i][3]);
    if (empty($prod_id) || !is_numeric($prod_id) || is_float($prod_id) || (int)$prod_id <= 0) {
        mysqli_close($connection);
        http_response_code(400);
        exit;
    }
    if (empty($prod_quantity) || !is_numeric($prod_quantity) || is_float($prod_quantity) || (int)$prod_quantity <= 0) {
        mysqli_close($connection);
        http_response_code(400);
        exit;
    }
    if (empty($prod_size) || $prod_size == "" || empty($prod_col) || $prod_col == "") {
        mysqli_close($connection);
        http_response_code(400);
        exit;
    }
    $sql = "SELECT product_price, product_name, quantity FROM product_info 
            WHERE product_id = " . $prod_id .
        " AND product_size LIKE '%" . $prod_size . "%'" .
        " AND product_color LIKE '%" . $prod_col . "%'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 0) {
        mysqli_close($connection);
        http_response_code(404);
        exit;
    } else {
        $price = mysqli_fetch_array($result);
        if ($price[2] >= (int)$prod_quantity)
            array_push($prod_list[$i], $price[0] * (int)$prod_quantity, $price[1], $price[2]);
        else {
            mysqli_close($connection);
            echo "Full";
            exit;
        }
    }
}
for ($i = 0; $i < count($prod_list); $i++) {
    if (!isset($_SESSION["prod_list"])) {
        $_SESSION["prod_list"] = array();
    }
    array_push($_SESSION["prod_list"], $prod_list[$i]);
}
mysqli_close($connection);
echo "Success";
exit;
