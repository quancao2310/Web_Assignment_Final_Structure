<?php
session_start();
include 'include/config.php';
if (isset($_SESSION["user_id"])) {
  $id = $_SESSION["user_id"];
  $data = mysqli_query($conn, "SELECT * FROM account_info WHERE user_id = $id");
  $data = mysqli_fetch_assoc($data);
  $username = $data["username"];
  $feedback = mysqli_query($conn, "SELECT * FROM feedback WHERE username = '$username'");
} else {
  header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <title>Thông tin cá nhân</title>
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

  <?php
  if (isset($_SESSION['user_id'])) {
  ?>
    <nav aria-label="breadcrumb" class="bg-light p-2 py-lg-3">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="/btl/" class="text-dark fw-bold text-decoration-none">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Thông tin cá nhân</li>
      </ol>
    </nav>
    <div class="m-3 d-grid gap-2 d-sm-flex gap-sm-3 justify-content-sm-end">
      <a class="btn btn-primary" href="info.php" role="button">
        Thay đổi thông tin
        <ion-icon name="create-outline"></ion-icon>
      </a>
      <a class="btn btn-primary" href="change_pwd.php" role="button">
        Đổi mật khẩu
        <ion-icon name="create-outline"></ion-icon>
      </a>
    </div>
    <div id="body" class="row">
      <div class="col-3">
        <div class="card" style="background-color: #fff;">
          <img src="<?php echo $data['avatar']; ?>" alt="avatar" class="card-img-top rounded-circle ratio ratio-1x1">
          <a class="change-img" href="change_ava.php" role="button"><ion-icon name="create-outline"></ion-icon></a>
          <div class="card-body">
            <h1><?php echo $data["name"]; ?></h1>
            <h3><?php echo $data["username"]; ?></h3>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Ngày tháng năm sinh: <?php echo $data["birthday"]; ?></li>
            <li class="list-group-item">Giới tính: <?php echo $data["gender"]; ?></li>
          </ul>
          <div class="card-footer text-muted">
            Truy cập lần cuối: <br> <?php echo $data["last_access"]; ?>
          </div>
        </div>
      </div>
      <div class="col-9">
        <div class="card w-100 row">
          <div class="card-body">
            <h5 class="card-title">Chi tiết người dùng:</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Họ và tên: <?php echo $data["name"]; ?>
              </li>
              <li class="list-group-item">
                Ngày tháng năm sinh: <?php echo $data["birthday"]; ?>
              </li>
              <li class="list-group-item">
                Giới tính: <?php echo $data["gender"]; ?>
              </li>
              <li class="list-group-item">
                Email: <?php echo $data["email"]; ?>
              </li>
              <li class="list-group-item">
                Số điện thoại: <?php echo $data["phone"]; ?>
              </li>
              <li class="list-group-item">Tình trạng tài khoản:
                <?php
                if ($data["role"] != "BAN") {
                  echo " Hoạt động";
                } else {
                  echo " Cấm hoạt động <br> Lý do: " . $data["more"];
                }
                ?>
              </li>
            </ul>
          </div>
        </div>
        <div class="card w-100 row mt-5">
          <div class="card-body">
            <h5 class="card-title">Danh sách hoạt động:</h5>
            <?php
            if ($data["role"] != "BAN") {
            ?>
              <ul class="list-group list-group-flush">
                <?php
                $active = $data = mysqli_fetch_assoc($feedback);
                while ($active) {
                  $productid = $active["product_id"];
                  $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product_info WHERE product_id = $productid"));
                ?>
                  <li class="list-group-item">Đánh giá <?php star($active["stars"]); ?> cho <a href="#"> <?php echo $product["product_name"]; ?></a></li>
                <?php
                  $active = $data = mysqli_fetch_assoc($feedback);
                }
                ?>
              </ul>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  <?php
  }
  ?>
  <script>
    $(document).ready(function() {
      $.get("/btl/modules/header.php", function(data) {
        $("body").prepend(data);
      });
      $.get("/btl/modules/footer.php", function(data) {
        $("body").append(data);
      });
    });
  </script>

</body>

</html>
<?php
  mysqli_close($conn);
?>
<?php
function star($num)
{
  echo '<span class="text-warning">';
  for ($i = 0; $i < 5; $i++) {
    if ($i < $num) {
      echo '<i class="bi bi-star-fill"></i>';
    } else {
      echo '<i class="bi bi-star"></i>';
    }
  }
  echo "</span>";
}
?>