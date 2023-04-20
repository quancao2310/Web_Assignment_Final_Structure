<?php
  include_once '../include/header.php';
?>

  <div class="content">
    <div class="wrapper login-box">
      <div class="form-box login-form">
        <h2>Login</h2>
        <form method="post" action="">
          <div class="input-box">
            <span class="icon">
              <ion-icon name="person"></ion-icon>
            </span>
            <input type="username" name="username" id="username" required placeholder="Username or email" autofocus>
          </div>
          <div class="input-box">
            <span class="icon">
              <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="password" id="login-password" required placeholder="Password">
          </div>
          <div class="remember-forgot">
            <label for="login-remember"><input type="checkbox" name="remember" id="login-remember">Remember me</label>
            <a href="#">Forgot password</a>
          </div>
          <button type="submit" class="btn" name="login">Log in</button>
          <div class="login-register">
            <p>Don't have a account? <a href="register.php" class="register-link">Register</a></p>
          </div>
        </form>
        <div class="error">
          <?php

            if (isset($_GET['error'])) {
              if ($_GET['error'] == 'emptyinput') {
                echo '<p class="error-msg">Fill in all fields!</p>';
              } else if ($_GET['error'] == 'wrongusername') {
                echo '<p class="error-msg">Wrong username or email!</p>';
              } else if ($_GET['error'] == 'wrongpassword') {
                echo '<p class="error-msg">Wrong password!</p>';
              } else {
                header('location: /btl/');
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