<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href="/btl/modules/header-footer.css" rel="stylesheet">
  <link rel="stylesheet" href="/btl/account/css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav aria-label="breadcrumb" class="bg-light p-2 py-lg-3">
    <ol class="breadcrumb m-0">
      <li class="breadcrumb-item"><a href="/btl/" class="text-dark fw-bold text-decoration-none">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Đăng nhập</li>
    </ol>
  </nav>
  <div class="content">
    <div class="wrapper login-box">
      <div class="form-box login-form">
        <h2>Đăng nhập</h2>
        <form method="post" action="/btl/account/include/login.inc.php">
          <div class="input-box">
            <span class="icon">
              <ion-icon name="person"></ion-icon>
            </span>
            <input type="username" name="username" id="username" required placeholder="Tên đăng nhập hoặc email" autofocus>
          </div>
          <div class="input-box">
            <span class="icon">
              <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="password" id="login-password" required placeholder="Mật khẩu">
          </div>
          <button type="submit" class="button" name="login">Đăng nhập</button>
          <div class="login-register">
            <p>Chưa có tài khoản? <a href="register.php" class="register-link">Đăng kí</a></p>
          </div>
        </form>
        <div class="error">
          <?php

            if (isset($_GET['error'])) {
              if ($_GET['error'] == 'emptyinput') {
                echo '<p class="error-msg">Thiếu thông tin đăng nhập!</p>';
              } else if ($_GET['error'] == 'wrongusername') {
                echo '<p class="error-msg">Sai tên đăng nhập hoặc email!</p>';
              } else if ($_GET['error'] == 'wrongpassword') {
                echo '<p class="error-msg">Sai mật khẩu!</p>';
              } else {
                if ($_SESSION['role'] == 'ADMIN') {
                  header('location: /btl/admin/');
                  exit();
                } else if ($_SESSION['role'] == 'GUEST'){
                  header('location: /btl/');
                  exit();
                } else {
                  header('location: /btl/account/page/ban.html');
                  exit();
                }
              }
            }

          ?>
        </div>
      </div>
    </div>
  </div>

<script>
  $(document).ready(function() {
    $.get("/btl/modules/header.php", function(data) {
      $("body").prepend(data);
    });
    $.get("/btl/modules/footer.php", function(data) {
      $("body").append(data);
    });
  })
</script>

</body>
</html>