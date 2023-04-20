<?php
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    $id = $_POST["product_id"];
    $data = mysqli_query($connection,"SELECT * FROM product_info WHERE product_id = $id");
    if (mysqli_num_rows($data)==0) echo true;
        else echo false;
    mysqli_close($connection);
?>