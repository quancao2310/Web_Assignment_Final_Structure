<?php

include '../include/header.php';

if (isset($_SESSION["user_id"])){
  $id = $_SESSION["user_id"];
  $data = mysqli_query($conn, "SELECT * FROM account_info WHERE user_id = $id");
  $data = mysqli_fetch_assoc($data);
  $username = $data["username"];
  $feedback = mysqli_query($conn,"SELECT * FROM feedback WHERE username = '$username'");
}
?>

<?php
  if (isset($_SESSION['user_id'])) {
?>
    <div id="body" class="row">
        <div class="col-4">
        <div class="card" style="background-color: #E9EDC9;">
        <img src="../<?php echo $data['avatar'];?>" alt="avatar" class="card-img-top">
        <div class="card-body">
           <h1 style="text-decoration: underline;"><?php echo $data["name"];?></h1>
           <h3><?php echo $data["username"];?></h3>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Ngày tháng năm sinh: <?php echo $data["birthday"];?></li>
            <li class="list-group-item">Giới tính: <?php echo $data["gender"];?></li>
        </ul>
        <div class="card-footer text-muted">
            Truy cập lần cuối: <?php echo $data["last_access"];?>
        </div>
        </div>
        </div>
        <div class="col-8">
        <div class="card w-100 row">
            <div class="card-body">
                <h5 class="card-title">Chi tiết người dùng:</h5>
                <a href="info.php">
                  <button class="edit-btn">
                    <ion-icon name="create-outline"></ion-icon>
                  </button>
                </a>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      Họ và tên: <?php echo $data["name"];?>
                    </li>
                    <li class="list-group-item">
                      Ngày tháng năm sinh: <?php echo $data["birthday"];?>
                    </li>
                    <li class="list-group-item">
                      Giới tính: <?php echo $data["gender"];?>
                    </li>
                    <li class="list-group-item">
                      Email: <?php echo $data["email"];?>
                    </li>
                    <li class="list-group-item">
                      Số điện thoại: <?php echo $data["phone"];?>
                    </li>
                    <li class="list-group-item">Tình trạng tài khoản: 
                        <?php 
                        if ($data["role"]!="BAN"){
                            echo " Hoạt động";
                        } else {
                            echo " Cấm hoạt động <br> Lý do: ".$data["more"];
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
                    while ($active){
                        $productid = $active["product_id"];
                        $product = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM product_info WHERE product_id = $productid"));
                    ?>
                    <li class="list-group-item">Đánh giá <?php star($active["stars"]);?> cho <a href="#"> <?php echo $product["product_name"];?></a></li>
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $(body).show();
      $("span").click(function() {
        alert( "Handler for .click() called." );
      });
    })
  </script>
  <script src="../js/test.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
  mysqli_close($conn);
?>
<?php 
    function star($num){
        echo '<span class="text-warning">';
        for ($i=0;$i<5;$i++){
            if ($i < $num){
                echo '<i class="bi bi-star-fill"></i>';
            } else {
                echo '<i class="bi bi-star"></i>';
            }
        }
        echo "</span>";
    }
?>