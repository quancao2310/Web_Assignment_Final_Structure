<?php
  session_start();
  if (isset($_SESSION['change_info_signal'])) {
    if ($_SESSION['change_info_signal'] == '0') {
      $_SESSION['change_info_signal'] = '1';
    } else if ($_SESSION['change_info_signal'] == '2') {
      $_SESSION['change_info_signal'] = '3';
    } else {
      unset($_SESSION['change_info_signal']);
    }
  }
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Đổi thông tin cá nhân</title>
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
      <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Đổi thông tin</li>
    </ol>
  </nav>

  <div class="content">
      <?php
        if (!isset($_SESSION['change_info_signal']) || (isset($_SESSION['change_info_signal']) && $_SESSION['change_info_signal'] == '3')) {
      ?>
      <div class="wrapper info-box">
        <div class="form-box info-form">
          <h2>Xác nhận mật khẩu</h2>
          <form action="include/info.inc.php" method="post">
            <div class="input-box">
              <span class="icon">
                <ion-icon name="lock-closed"></ion-icon>
              </span>
              <input type="password" name="password" id="password" placeholder="Mật khẩu" autofocus>
            </div>
            <button type="submit" class="button" name="submit" title="Confirm">Xác nhận</button>
          </form>
          <br>
          <?php
          if (isset($_SESSION['change_info_signal'])) {
            if ($_SESSION['change_info_signal'] == '3') {
              echo '<p class="error-msg">Wrong password!</p>';
            }
          }
          ?>
        </div>
      </div>
      <?php
        } 
        
        if (isset($_SESSION['change_info_signal'])) {
          if ($_SESSION['change_info_signal'] == '1') {
      ?>
        <div class="wrapper info-box">
          <div class="form-box info-form">
            <h2>Thay đổi thông tin</h2>
            <p class="help-msg">Nếu không muốn thay đổi, hãy để trống!</p>
            <form action="include/info.inc.php" method="post">
              <div class="input-box">
                <span class="icon">
                  <ion-icon name="pencil-outline"></ion-icon>
                </span>
                <input type="text" name="name" id="name" pattern="^[A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐa-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ0-9]*(?:[ ][A-ZÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐa-zàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ0-9]*)*$" title="Nhập họ và tên" placeholder="Họ và tên" autofocus>
              </div>
              <div class="input-box-gender">
                <span>Giới tính</span>
                <div>
                  <input type="radio" id="male" name="gender" value="Nam" title="Nam">
                  <label for="male">Nam</label>
                </div>
                <div>
                  <input type="radio" id="female" name="gender" value="Nữ" title="Nữ">
                  <label for="female">Nữ</label>
                </div>
                <div>
                  <input type="radio" id="other" name="gender" value="Khác" title="Khác">
                  <label for="other">Khác</label>
                </div>
              </div>
              <div class="input-box" id="bday">
                <label for="birthday">Ngày sinh</label>
                <input type="date" name="birthday" id="birthday" title="Nhập ngày sinh">
              </div>
              <div class="input-box">
                <span class="icon">
                  <ion-icon name="call"></ion-icon>
                </span>
                <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" title="Nhập số điện thoại" placeholder="Số điên thoại">
              </div>
              <button type="submit" class="button" name="change" title="Xác nhận">Xác nhận</button>
            </form>
            <br>
          </div>
        </div>
        <?php
          }
        }
    ?>
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