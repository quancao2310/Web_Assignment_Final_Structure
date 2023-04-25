<?php
include "../../modules/connect.php";
$sql1 = "SELECT product_type FROM product_info WHERE product_id=" . $_POST["product_id"];
$result1 = mysqli_query($connection, $sql1);
$product_type = mysqli_fetch_array($result1)[0];
$sql2 = "SELECT product_info.product_id, product_info.product_name, product_info.product_price, product_image.image_1
            FROM product_info
            LEFT JOIN product_image 
            ON product_info.product_id = product_image.product_id
            WHERE product_info.product_type LIKE '%" . $product_type . "%'" . 
            " AND product_info.product_id <> " . $_POST["product_id"];
$result2 = mysqli_query($connection, $sql2);
if (mysqli_num_rows($result2) == 0) {
    echo "";
}
else {
    $product_data = mysqli_fetch_all($result2);
    echo json_encode($product_data);
}
mysqli_close($connection);
exit;