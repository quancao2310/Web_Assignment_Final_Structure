<?php
include "../utilities/connect.php";
$sql = "SELECT product_info.product_id, product_info.product_type, product_info.product_name, product_info.product_price, product_image.image_1
            FROM product_info
            LEFT JOIN product_image 
            ON product_info.product_id = product_image.product_id";
$result = mysqli_query($connection,$sql);
if (mysqli_num_rows($result) == 0) {
    echo "";
}
else {
    $productList = mysqli_fetch_all($result);
    echo json_encode($productList);
}
mysqli_close($connection);
exit;