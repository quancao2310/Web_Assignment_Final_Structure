<?php 

include_once '../include/header.php';

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

<div class="content">
  <div class="wrapper info-box">
    <div class="form-box info-form">
      <h2>Thay đổi thông tin</h2>
      <form action="" method="post">
        <div class="input-box">
          <span class="icon">
            <ion-icon name="pencil-outline"></ion-icon>
          </span>
          <input type="text" name="name" id="name" required pattern="^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$" title="Enter your name" placeholder="Name">
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
        <button type="submit" class="btn" name="change" title="Register">Thay đổi</button>
      </form>
      <?php
        if (isset($_GET['error'])) {
          echo '<p class="error-msg">Update successfully!</p>';
        }
      ?>
    </div>
  </div>
</div>

<?php

include_once '../include/footer.php';

?>