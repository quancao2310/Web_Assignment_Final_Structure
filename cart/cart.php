<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: /btl/account/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../modules/header-footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Giỏ hàng</title>
</head>

<body>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/btl/" class="text-dark fw-bold text-decoration-none">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
            </ol>
        </nav>
    </div>
    <h2 class="text-center">Giỏ hàng</h2>
    <div class="container-lg">
        <form method="post" id="payment">
            <div class="row">

                <div class="col-lg-8">
                    <h4>Danh sách hàng hoá</h4>
                    <p id="isNone"></p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá tổng</th>
                                <th scope="col">Xoá</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h4>Thanh toán</h4>
                    <div class="row bg-secondary-subtle border border-secondary justify-content-between rounded">
                        <div class="col">
                            <h5>Tổng đơn hàng:</h5>
                        </div>
                        <div class="col text-end" id="totalPrice">
                            0
                        </div>
                    </div>
                    <div class="row my-5">
                        <button type="submit" class="btn btn-dark" id="paybegin">Thanh toán</button>
                    </div>
                </div>

            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="cart.js"></script>
</body>

</html>