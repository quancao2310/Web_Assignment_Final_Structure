<?php
  session_start();
  if (isset($_SESSION["user_id"])) {
    header('location: /btl/');
  }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <title>Đăng kí</title>
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
      <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Đăng kí</li>
    </ol>
  </nav>
  <div class="content">
    <div class="wrapper register-box">
      <div class="form-box register-form">
        <h2>Đăng kí</h2>
        <?php
          if (isset($error)) {
            foreach($error as $error) {
              echo '<h3 class="error-msg"> - ' . $error . ' - </h3>';
            }
          }
        ?>
        <form action="../include/register.inc.php" method="post">
          <div class="input-box">
            <span class="icon">
              <ion-icon name="person"></ion-icon>
            </span>
            <input type="text" name="username" id="username" placeholder="Tên đăng nhập" autofocus>
          </div>
          <div class="input-box">
            <span class="icon">
              <ion-icon name="mail"></ion-icon>
            </span>
            <input type="email" name="email" id="email" placeholder="Email">
          </div>
          <div class="input-box">
            <span class="icon">
              <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="password" id="password" placeholder="Mật khẩu">
          </div>
          <div class="input-box">
            <span class="icon">
              <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="r-password" id="r-password" placeholder="Xác nhận mật khẩu">
          </div>
          <button type="submit" class="button" name="register">Đăng kí</button>
          <div class="login-register">
            <p>Đã có tài khoản? <a href="login.php" class="login-link">Đăng nhập</a></p>
          </div>
        </form>
        <div class="error">
          <?php

            if (isset($_GET['error'])) {
              if ($_GET['error'] == 'emptyinput') {
                echo '<p class="error-msg">Fill in all fields!</p>';
              } else if ($_GET['error'] == 'invalidusername') {
                echo '<p class="error-msg">Choose other username!</p>';
              } else if ($_GET['error'] == 'invalidpassword') {
                echo '<p class="error-msg">Choose other password!</p>';
              } else if ($_GET['error'] == 'invalidemail') {
                echo '<p class="error-msg">Incorrect Email!</p>';
              } else if ($_GET['error'] == 'notmatchpassword') {
                echo '<p class="error-msg">Password doesn\'t match!</p>';
              } else if ($_GET['error'] == 'usernametaken') {
                echo '<p class="error-msg">Username or email already exist!</p>';
              } else if ($_GET['error'] == 'stmtfailed') {
                echo '<p class="error-msg">Something wrong!</p>';
              } else {
                header('location: /btl/account/login.php');
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