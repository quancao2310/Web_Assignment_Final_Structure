<?php
include "../utilities/connect.php";
$sql = "SELECT product_info.*, product_image.image_1, product_image.image_2, product_image.image_3, product_image.image_4, product_image.image_5
            FROM product_info
            LEFT JOIN product_image 
            ON product_info.product_id = product_image.product_id
            WHERE product_info.product_id = " . $_GET["product_id"];
$result = mysqli_query($connection,$sql);
if (mysqli_num_rows($result) == 0) {
    echo "";
}
else {
    $productDetail = mysqli_fetch_all($result);
    echo json_encode($productDetail);
}
mysqli_close($connection);
exit;