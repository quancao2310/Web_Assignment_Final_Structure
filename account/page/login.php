<?php
  include_once '../include/header.php';
  if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = "SELECT * FROM account_info WHERE username = '$username' && password = '$password'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['username'] = $row['name'];
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['role'] = $row['role'];
      setcookie('user_id', $data['id'], time() + 86400 * 30, '/btl');
      setcookie('username', $data['username'], time() + 86400 * 30, '/btl');
      mysqli_close($conn);
      if ($row['role'] == 'ADMIN') {
        header('location: /btl/admin/');
        exit();
      } else {
        header('location: /btl/');
        exit();
      }
    } else {
      $error[] = 'Incorrect email or password!'; 
    }
  }
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
        <?php
          if (isset($error)) {
            foreach($error as $error) {
              echo '<p class="error-msg">' . $error . '</p>';
            }
          }
        ?>
      </div>
    </div>
  </div>

<?php

include_once '../include/footer.php';

?>