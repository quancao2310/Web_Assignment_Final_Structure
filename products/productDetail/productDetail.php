<?php
session_start();
if (!isset($_GET["product_id"]) && !isset($_POST["product_id"])) {
    header('location: /btl/products/productList.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="/btl/modules/header-footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/btl/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="/btl/products/productList.php">Sản phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
        </nav>
    </div>
    <div class="container-lg">
        <div class="row mb-3 justify-content-center">
            <div class="col-12 col-md-auto">
                <div class="row justify-content-center">
                    <div style="width:300px">
                        <div id="detail" class="carousel slide">
                            <div class="carousel-inner detailPhotos"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 detailIndicators"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <h1 id="prod_name"></h1>
                <h4>Giá: <span id="prod_price"></span></h4>
                <div class="row my-3">
                    <div class="col-auto">
                        Chọn size:
                    </div>
                    <div class="col-auto">
                        <select class="form-select d-inline" aria-label="Default select example" id="prod_size"></select>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-auto">
                        Chọn màu:
                    </div>
                    <div class="col" id="prod_col"></div>
                </div>
                <div class="row my-3">
                    <div class="col-auto">
                        Số lượng:
                    </div>
                    <div class="col">
                        <div class="input-group" style="width: 130px;">
                            <button type="button" class="btn btn-outline-secondary" id="minus-q" value="-" onclick="changeQuantity(this.value)">-</button>
                            <input type="number" step="1" min="1" class="form-control" value="1" id="quantity" onchange="checkValid()">
                            <button type="button" class="btn btn-outline-secondary" id="add-q" value="+" onclick="changeQuantity(this.value)">+</button>
                        </div>
                    </div>
                </div>
                <div class="row my-3" id="qty-status">
                </div>
                <div class="row my-3">
                    <p class="fst-italic">Lưu ý: hình ảnh chỉ mang tính chất minh hoạ, màu sắc và kích thước khi giao sẽ đúng với những lựa
                        chọn của bạn</p>
                </div>

                <h5>Chi tiết:</h5>
                <p class="lh-lg" id="prod_des"></p>
                <div class="row justify-content-center m-2">
                    <div class="col-auto">
                        <button type="button" class="btn btn-secondary" id="add-to-cart" onclick="add(<?php echo $_POST['product_id']; ?>)">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-4">
            <h1 class="text-center mb-3">Sản phẩm liên quan</h1>
            <div class="relevant"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
    <script>
        $.post("/btl/modules/header.php", function(data) {
            $("body").prepend(data)
        })
        $.post("/btl/modules/footer.php", function(data) {
            $("body").append(data)
        })
        let prod_id = <?php
                        if (isset($_GET["product_id"]))
                            echo $_GET["product_id"];
                        else
                            echo $_POST["product_id"]; ?>;
    </script>
    <script src="productDetail.js"></script>
</body>

</html>