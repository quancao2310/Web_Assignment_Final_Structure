<?php
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $product_description = $_POST["product_description"];
        $size = array();
        if (isset($_POST["size_m"])) array_push($size,$_POST["size_m"]);
        if (isset($_POST["size_l"])) array_push($size,$_POST["size_l"]);
        if (isset($_POST["size_s"])) array_push($size,$_POST["size_s"]);
        $size = implode(", ",$size);
        $color_list = $_POST["color_list"];
        $product_price = $_POST["product_price"];
        $quantity = $_POST["quantity"];
        $product_type = $_POST["product_type"];
        mysqli_query($connection,"INSERT INTO `product_info` (`product_id`, `product_type`, `product_name`, `product_color`, `product_size`, `product_description`, `product_price`, `quantity`) VALUES ($product_id, '$product_type', '$product_name', '$color_list', '$size', '$product_description', $product_price, $quantity)");
    }
    mysqli_close($connection);
    header("Location: products_list.html");
    exit;
?>
