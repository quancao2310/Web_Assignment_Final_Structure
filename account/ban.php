<?php
session_start();
include '../include/config.php';
if (isset($_SESSION["user_id"])){
  $id = $_SESSION["user_id"];
  $data = mysqli_query($conn, "SELECT * FROM account_info WHERE user_id = $id");
  $data = mysqli_fetch_assoc($data);
  $username = $data["username"];
  $feedback = mysqli_query($conn,"SELECT * FROM feedback WHERE username = '$username'");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Ban</title>
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
  <div class="content">
    <div class="wrapper info-box">
      <div class="form-box info-form">
        <h2>Trạng thái tài khoản</h2>
        <?php
        if ($data["role"] != "BAN") {
          echo " Hoạt động";
        } else {
          echo " Cấm hoạt động <br> Lý do: " . $data["more"];
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