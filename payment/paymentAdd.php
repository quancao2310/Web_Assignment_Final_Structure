<?php
session_start();
include "../utilities/connect.php";
function validateVietnameseName($name)
{
    $regex = '/^[\p{L}\s]+$/u';
    return preg_match($regex, $name);
}
function validateEmail($email)
{
    $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($emailRegex, $email);
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset($_SESSION["prod_list"]) || empty($_SESSION["prod_list"]) || $_SESSION["prod_list"] == []) {
    mysqli_close($connection);
    echo "Empty";
    exit;
}
$clientName = test_input($_POST["clientName"]);
$address = test_input($_POST["address"]);
$email = test_input($_POST["email"]);
$phoneNumber = test_input($_POST["phoneNumber"]);
$deliveryMethod = test_input($_POST["deliveryMethod"]);
$paymentMethod = test_input($_POST["paymentMethod"]);
if (
    (!validateVietnameseName($clientName))
    || (empty($address) || $address == "")
    || (!validateEmail($email) && $email != "")
    || (!preg_match('/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/', $phoneNumber))
    || (empty($deliveryMethod) || $deliveryMethod == "")
    || (empty($paymentMethod) || $paymentMethod == "")
) {
    mysqli_close($connection);
    http_response_code(400);
    exit;
}

for ($k = 0; $k < count($_SESSION["prod_list"]); $k++) {
    $sql_qty = "SELECT quantity FROM product_info 
                WHERE product_id = " . $_SESSION["prod_list"][$k][0] .
        " AND product_size LIKE '%" . $_SESSION["prod_list"][$k][2] . "%'" .
        " AND product_color LIKE '%" . $_SESSION["prod_list"][$k][3] . "%'";
    $get_qty = mysqli_query($connection, $sql_qty);
    if (mysqli_num_rows($get_qty) == 0) {
        mysqli_close($connection);
        http_response_code(500);
        exit;
    } else {
        $qty = mysqli_fetch_array($get_qty)[0];
        if ($_SESSION["prod_list"][$k][1] > $qty) {
            echo "Full";
            mysqli_close($connection);
            exit;
        }
    }
}

$total_price = 30000;
$discount = 0;
for ($i = 0; $i < count($_SESSION["prod_list"]); $i++) {
    $total_price += $_SESSION["prod_list"][$i][4];
}
$final_price = $total_price - $discount;
$sql = "INSERT INTO payment_info (user_id, customer_name, customer_address, customer_email, customer_phone,
                                    delivery_method, payment_method, total_price, discount, final_price, status)
        VALUES (" . $_SESSION["user_id"] . ",'"
    . $clientName . "','"
    . $address . "','"
    . $email . "','"
    . $phoneNumber . "','"
    . $deliveryMethod . "','"
    . $paymentMethod . "',"
    . $total_price . ","
    . $discount . ","
    . $final_price . ","
    . "'Đang xử lí'" . ")";
if (mysqli_query($connection, $sql)) {
    $sql2 = "SELECT LAST_INSERT_ID()";
    $getBillID = mysqli_query($connection, $sql2);
    if (mysqli_num_rows($getBillID) > 0) {
        $billID = mysqli_fetch_array($getBillID);
        for ($j = 0; $j < count($_SESSION["prod_list"]); $j++) {
            $sql3 = "INSERT INTO bill_info VALUES (" . $billID[0] . ","
                . $_SESSION["user_id"] . ","
                . $_SESSION["prod_list"][$j][0] . ",'"
                . $_SESSION["prod_list"][$j][5] . "',"
                . $_SESSION["prod_list"][$j][1] . ",'"
                . $_SESSION["prod_list"][$j][2] . "','"
                . $_SESSION["prod_list"][$j][3] . "',"
                . $_SESSION["prod_list"][$j][4] . ")";
            if (!mysqli_query($connection, $sql3)) {
                mysqli_close($connection);
                http_response_code(500);
                exit;
            }
            $sql_qty_2 = "SELECT quantity FROM product_info 
                WHERE product_id = " . $_SESSION["prod_list"][$j][0] .
                " AND product_size LIKE '%" . $_SESSION["prod_list"][$j][2] . "%'" .
                " AND product_color LIKE '%" . $_SESSION["prod_list"][$j][3] . "%'";
            $get_qty_2 = mysqli_query($connection, $sql_qty_2);
            if (mysqli_num_rows($get_qty_2) == 0) {
                mysqli_close($connection);
                http_response_code(500);
                exit;
            } else {
                $qty_2_arr = mysqli_fetch_array($get_qty_2);
                $left = $qty_2_arr[0] - $_SESSION["prod_list"][$j][1];
                $update_sql = "UPDATE product_info SET quantity=" . $left.
                    " WHERE product_id=" . $_SESSION["prod_list"][$j][0];
                if (!mysqli_query($connection, $update_sql)) {
                    mysqli_close($connection);
                    http_response_code(500);
                    exit;
                }
            }
        }
        $_SESSION["prod_list"] = [];
        mysqli_close($connection);
        exit;
    } else {
        mysqli_close($connection);
        http_response_code(500);
        exit;
    }
} else {
    mysqli_close($connection);
    http_response_code(500);
    exit;
}
