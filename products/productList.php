<?php
session_start();
include "../modules/connect.php";
if (isset($_SESSION["login"]) && $_SESSION["login"]) {
    if (!isset($_SESSION["role"])) {
        $sql = "SELECT role FROM account_info WHERE user_id=" . $_SESSION["user_id"];
        $result = mysqli_query($connection, $sql);
        $_SESSION["role"] = $result;
    }
}
else {
    $_SESSION["login"] = true;
    $_SESSION["user_id"] = 5;
}
mysqli_close($connection);
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../utilities/header-footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-sm-3">
                <div id="list-example" class="list-group list-group-flush productType"></div>
            </div>
            <div class="col-sm-9">
                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example productSlide" tabindex="0"></div>
            </div>
        </div>


    <script src="productList.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

</body>

</html>