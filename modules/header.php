<?php
session_start();
$login = $role = '';
if (isset($_SESSION['user_id'])) {
  $login = true;
  $role = $_SESSION['role'];
}
else {
  $login = false;
}
?>

<header class="sticky-xl-top">
  <nav class="navbar navbar-expand-lg p-1 navbar-light bg-white sticky-top">
    <div class="container">
      <button class="navbar-toggler" id="nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#qn2h-nav" aria-controls="qn2h-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="/btl/">
        <img src="/btl/images/logo.png" alt="QN2H">
      </a>
      <div class="d-flex gap-2 order-lg-last mx-lg-3">
        <?php
        if ($login) {
        ?>
        <div class="dropdown">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/btl/images/standard_avt.jpg" alt="Avatar" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start text-small">
            <li>
              <a href="/btl/account/user_page.php" class="dropdown-item">Thông tin cá nhân</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a href="/btl/account/include/logout.php" class="dropdown-item">Đăng xuất</a>
            </li>
          </ul>
        </div>
        <?php
        }
        ?>
        <a type="button" href="/btl/cart/cart.php" class="position-relative d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <!--<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cart-count">0</span>-->
        </a>
      </div>
      <div class="collapse navbar-collapse" id="qn2h-nav">
        <ul class="navbar-nav fw-semibold text-lg-center me-auto">
          <li class="nav-item">
            <a href="/btl/" class="nav-link text-black" aria-current="page">Trang chủ</a>
          </li>
          <li class="nav-item">
            <a href="/btl/products/productList.php" class="nav-link text-black">Cửa hàng</a>
          </li>
          <li class="nav-item">
            <a href="/btl/home/about.html" class="nav-link text-black">Giới thiệu</a>
          </li>
          <li class="nav-item">
            <a href="/btl/home/contact.html" class="nav-link text-black">Liên hệ</a>
          </li>
          <li class="nav-item">
            <a href="/btl/news/news.html" class="nav-link text-black">Tin tức</a>
          </li>
          <?php
          if ($login && $role == 'ADMIN') {
          ?>
          <li class="nav-item">
            <a href="/btl/admin/" class="nav-link text-black">Trang quản trị</a>
          </li>
          <?php
          }
          ?>
        </ul>
        <?php
        if (!$login) {
        ?>
        <ul class="navbar-nav fw-semibold me-auto d-lg-none">
          <li class="nav-item">
            <a href="/btl/account/login.php" class="nav-link text-black">Đăng nhập</a>
          </li>
          <li class="nav-item">
            <a href="/btl/account/register.php" class="nav-link text-black">Đăng ký</a>
          </li>
        </ul>
        <?php
        }
        ?>
        <form class="d-flex my-3 my-lg-0 mx-lg-3" id="header-search" role="search">
          <input class="form-control" name="search" id="search1" type="search" placeholder="Tìm kiếm" aria-label="Search">
          <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center search-icon" title="Search button">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
          </button>
        </form>
        <?php
        if (!$login) {
        ?>
        <ul class="navbar-nav fw-semibold me-auto me-lg-0 d-none d-lg-flex">
          <li class="nav-item me-3">
            <a href="/btl/account/login.php" type="button" class="btn btn-primary text-white">Đăng nhập</a>
          </li>
          <li class="nav-item">
            <a href="/btl/account/register.php" type="button" class="btn btn-primary text-white">Đăng ký</a>
          </li>
        </ul>
        <?php
        } 
        ?>
      </div>
    </div>
  </nav>
</header>