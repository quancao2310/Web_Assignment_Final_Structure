<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Đổi avatar</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
      <li class="breadcrumb-item"><a href="/btl/account/user_page.php" class="text-dark fw-bold text-decoration-none">Thông tin cá nhân</a></li>
      <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Đổi avatar</li>
    </ol>
  </nav>
  <div class="content">
    <div class="wrapper info-box">
      <div class="form-box info-form">
        <h2>Đổi Avatar</h2>
        <form action="include/change_ava.inc.php" method="post">
          <div class="input-box">
            <span class="icon">
                <ion-icon name="link"></ion-icon>
            </span>
            <input type="text" name="image" id="image" placeholder="Link">
          </div>
          <div class="input-box">
            <span class="icon">
              <ion-icon name="lock-closed"></ion-icon>
            </span>
            <input type="password" name="password" id="password" placeholder="Mật khẩu">
          </div>
          <button type="submit" class="button" name="change" title="Confirm">Thay đổi</button>
        </form>
        <br>
        <?php
        if (isset($_GET['error'])) {
          if ($_GET['error'] == "wrongpwd") {
            echo '<p class="error-msg">Wrong password!</p>';
          } else if ($_GET['error'] == "none") {
            echo '<p class="error-msg">Update successfully!</p>';
          } else if ($_GET['error'] == "stmtfailed") {
            echo '<p class="error-msg">Something went wrong!</p>';
          }
        }
        ?>
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