<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        http_response_code(404);
        exit;
    }
?>
<nav class="navbar bg-light navbar-light navbar-expand-sm mb-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.html">
                <img src="Images/logo.png" alt="logo" style="width:100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav fw-semibold text-lg-center me-auto">
                    <li class="nav-item me-1">
                        <a class="nav-link text-black" href="bill_list.html">Danh mục đơn hàng</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link text-black" href="../news/news.html">Quản lý tin đăng</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link text-black" href="feedback.html">Phản hồi khách hàng</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link text-black" href="account_list.html">Danh mục thành viên</a>
                    </li>
                    <li class="nav-item me-1">
                        <a class="nav-link text-black" href="products_list.html">Danh Mục Sản Phẩm</a>
                    </li>
                </ul>
                <form class="d-flex">
                <a href="/btl/account/include/logout.php" class="btn btn-primary" role="button">
                    Đăng xuất
                </a>
                </form>
            </div>
        </div>
    </nav>