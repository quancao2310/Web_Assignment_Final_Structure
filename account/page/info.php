<?php 
  session_start();
  include '../include/config.php';
  if (isset($_POST['change'])) {
    
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];

    if (isset($_POST['name'])) {
      $sql = "UPDATE account_info SET name = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header('location: ../page/register.php?error=stmtfailed');
          exit();
      }

      mysqli_stmt_bind_param($stmt, 's', $name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }

    if (isset($_POST['gender'])) {
      $sql = "UPDATE account_info SET gender = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header('location: ../page/register.php?error=stmtfailed');
          exit();
      }

      mysqli_stmt_bind_param($stmt, 's', $gender);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }

    if (isset($_POST['birthday'])) {
      $sql = "UPDATE account_info SET birthday = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header('location: ../page/register.php?error=stmtfailed');
          exit();
      }

      mysqli_stmt_bind_param($stmt, 's', $_POST['birthday']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }

    if (isset($_POST['phone'])) {
      $sql = "UPDATE account_info SET phone = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header('location: ../page/register.php?error=stmtfailed');
          exit();
      }

      mysqli_stmt_bind_param($stmt, 's', $phone);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
    header('location: /btl/account/page/info.php?error=none');
    exit();
  }
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

<div class="content">
  <div class="wrapper info-box">
    <div class="form-box info-form">
      <h2>Thay đổi thông tin</h2>
      <form action="" method="post">
        <div class="input-box">
          <span class="icon">
            <ion-icon name="pencil-outline"></ion-icon>
          </span>
          <input type="text" name="name" id="name" required pattern="^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$" title="Enter your name" placeholder="Name" autofocus>
        </div>
        <div class="input-box-gender">
          <span>Giới tính</span>
          <div>
            <input type="radio" id="male" name="gender" value="Nam" checked title="Male">
            <label for="male">Nam</label>
          </div>
          <div>
            <input type="radio" id="female" name="gender" value="Nữ" title="Female">
            <label for="female">Nữ</label>
          </div>
          <div>
            <input type="radio" id="other" name="gender" value="Khác" title="Other">
            <label for="other">Khác</label>
          </div>
        </div>
        <div class="input-box" id="bday">
          <label for="birthday">Ngày sinh</label>
          <input type="date" name="birthday" id="birthday" required title="Enter your birthday">
        </div>
        <div class="input-box">
          <span class="icon">
            <ion-icon name="call"></ion-icon>
          </span>
          <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" required title="Enter your phone number, must contain 10 number" placeholder="Phone">
        </div>
        <button type="submit" class="button" name="change" title="Confirm">Thay đổi</button>
      </form>
      <?php
        if (isset($_GET['error'])) {
          echo '<p class="error-msg">Update successfully!</p>';
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
?>