<?php 

include_once '../include/header.php';

if (isset($_POST['change'])) {
  
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $birthday = $_POST['birthday'];
  $phone = $_POST['phone'];

  if (isset($_POST['name'])) {
    $sql = 'UPDATE account SET email = ? WHERE account.id = $_SESSION[\'id\'];';
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../page/register.php?error=stmtfailed');
        exit();
    }

    // $hashPwd = password_hash($password, PASSWORD_DEFAULT);
    $role = 'GUEST';
    mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $password, $role);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../../page/register.php?error=none');
    exit();
  }

}

?>

<div class="content">
  <div class="wrapper info-box">
    <div class="form-box info-form">
      <h2>Change information</h2>
      <form action="../include/info.inc.php" method="post">
        <div class="input-box">
          <span class="icon">
            <ion-icon name="pencil-outline"></ion-icon>
          </span>
          <input type="text" name="name" id="name" required pattern="^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐ][a-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ]*)*$" title="Enter your name" placeholder="Name">
        </div>
        <div class="input-box-gender">
          <span>Gender</span>
          <div>
            <input type="radio" id="male" name="gender" value="male" checked title="Male">
            <label for="male">Male</label>
          </div>
          <div>
            <input type="radio" id="female" name="gender" value="female" title="Female">
            <label for="female">Female</label>
          </div>
          <div>
            <input type="radio" id="other" name="gender" value="other" title="Other">
            <label for="other">Other</label>
          </div>
        </div>
        <div class="input-box" id="bday">
          <label for="birthday">Birthday</label>
          <input type="date" name="birthday" id="birthday" required title="Enter your birthday">
        </div>
        <div class="input-box">
          <span class="icon">
            <ion-icon name="call"></ion-icon>
          </span>
          <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" required title="Enter your phone number, must contain 10 number" placeholder="Phone">
        </div>
        <button type="submit" class="btn" name="change" title="Register">Change</button>
      </form>
    </div>
  </div>
</div>

<?php

include_once '../include/footer.php';

?>