<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location: /btl/account/page/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="../modules/header-footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/btl/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/btl/cart/cart.php">Giỏ hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
            </ol>
        </nav>
    </div>
    <div class="container-lg">
        <div class="row">
            <div class="col-md-7">
                <h3 class="text-center"> Thông tin thanh toán </h3>
                <form method="post" id="paymentInfo">
                    <div class="input-group mb-3">
                        <span class="input-group-text">Họ tên khách hàng</span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="clientName" placeholder="Họ tên" value="" required>
                            <label for="clientName">Họ tên</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Địa chỉ giao hàng</span>
                        <div class="form-floating">
                            <input type="text" class="form-control" id="address" placeholder="Địa chỉ" value="" required>
                            <label for="address">Địa chỉ</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Email</span>
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email" value="">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group mb-3">
                                <span class="input-group-text">SĐT</span>
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="phoneNumber" placeholder="Số điện thoại" value="" required>
                                    <label for="phoneNumber">Số điện thoại</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row border border-secondary-subtle rounded g-0 p-2">
                        <h5>Phương thức vận chuyển</h5>
                        <p>Phí vận chuyển: <span class="bg-secondary-subtle rounded p-2">30000</span></p>
                        <div class="col-12">
                            <input type="radio" class="form-check-input" name="deliveryMethod" id="deliveryMethod1" value="Chuyển phát nhanh tận nhà" checked>
                            <label class="form-check-label" for="deliveryMethod1"> Chuyển phát nhanh tận nhà
                            </label>
                        </div>
                        <div class="col-12">
                            <input type="radio" class="form-check-input" name="deliveryMethod" id="deliveryMethod2" value="Chuyển phát tiết kiệm tận nhà">
                            <label class="form-check-label" for="deliveryMethod2"> Chuyển phát tiết kiệm tận nhà
                            </label>
                        </div>
                        <div class="col-12">
                            <input type="radio" class="form-check-input" name="deliveryMethod" id="deliveryMethod3" value="Vận chuyển qua bưu điện">
                            <label class="form-check-label" for="deliveryMethod3"> Vận chuyển qua bưu điện </label>
                        </div>
                    </div>
                    <div class="row">
                        <h5>Phương thức thanh toán</h5>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        <input type="radio" class="form-check-input" name="paymentMethod" id="paymentMethod1" value="Thanh toán khi nhận hàng" checked>
                                        <label class="form-check-label" for="paymentMethod1"> Thanh toán khi nhận hàng
                                        </label>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Thanh toán trực tiếp khi nhận hàng. Cho phép đồng kiểm trước khi giao dịch.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <input type="radio" class="form-check-input" name="paymentMethod" id="paymentMethod2" value="Chuyển khoản">
                                        <label class="form-check-label" for="paymentMethod2"> Chuyển khoản
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Thực hiện chuyển khoản vào số tài khoản: ..., ngân hàng ..., tên chủ tài khoản:
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-5 g-0">
                        <button class="btn btn-secondary" type="submit">Hoàn tất đơn hàng</button>
                    </div>
                </form>

            </div>
            <div class="col-md-5">
                <table class="table">
                </table>
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <h6>Tổng giá sản phẩm</h6>
                    </div>
                    <div class="col-auto text-end" id="totalPrice">
                    </div>
                </div>
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <h6>Phí vận chuyển</h6>
                    </div>
                    <div class="col-auto text-end" id="shippingFee">
                        30000
                    </div>
                </div>
                <div class="row justify-content-between border-top border-secondary-subtle my-2 p-2">
                    <div class="col-auto">
                        <h5>Tổng cộng</h5>
                    </div>
                    <div class="col-auto text-end">
                        <h5 class="bg-secondary-subtle border border-secondary rounded p-1" id="finalPrice"></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script src="payment.js"></script>
</body>

</html>