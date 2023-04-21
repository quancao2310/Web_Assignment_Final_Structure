<?php

include_once '../include/header.php';

?>

<?php
  if (!isset($_SESSION['id'])) {
?>
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
        <form action="../include//register.inc.php" method="post">
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
          <button type="submit" class="btn" name="register">Đăng kí</button>
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
                header('location: /btl/account/page/login.php');
              }
            }

          ?>
        </div>
      </div>
    </div>
  </div>

  <?php
    } 
  ?>


<?php

include_once '../include/footer.php';

?>