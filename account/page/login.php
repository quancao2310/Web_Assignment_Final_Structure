<?php
  include_once '../include/header.php';
?>

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
          <button type="submit" class="btn" name="login">Đăng nhập</button>
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
                } else {
                  header('location: /btl/');
                  exit();
                }
              }
            }

          ?>
        </div>
      </div>
    </div>
  </div>

<?php

include_once '../include/footer.php';

?>