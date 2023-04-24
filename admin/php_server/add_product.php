<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        header("Location: /btl/page_not_found.html");
        exit;
    }
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
        $image = "";
        if ($_POST["image_list"]!=""){
            $image = explode(", ",$_POST["image_list"]);
            echo var_dump($image);
        }
        
        mysqli_query($connection,"INSERT INTO `product_info` (`product_id`, `product_type`, `product_name`, `product_color`, `product_size`, `product_description`, `product_price`, `quantity`) VALUES ($product_id, '$product_type', '$product_name', '$color_list', '$size', '$product_description', $product_price, $quantity)");
        if ($image){
            $query = "INSERT INTO product_image (product_id,image_1,image_2,image_3,image_4,image_5) VALUES ($product_id ";
            for ($i=0; $i < 5; $i++) { 
                if ($i<count($image)){
                    $image_link = $image[$i];
                    $query = $query .","." '$image_link'";
                } else {
                    $query = $query.",''";
                }
            }
            $query = $query.")";
            mysqli_query($connection,$query);
        }
    }
    mysqli_close($connection);
    header("Location: ../products_list.html");
    exit;
?>
