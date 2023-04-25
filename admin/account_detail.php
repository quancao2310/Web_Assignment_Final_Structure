<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        header("Location: /btl/page_not_found.html");
        exit;
    }
    $id = 1;
    if (isset($_GET["id"])){
        $id = $_GET["id"];
    }
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    $data = mysqli_query($connection,"SELECT * FROM account_info WHERE user_id = $id");
    $data = mysqli_fetch_assoc($data);
    $username = $data["username"];
    $feedback = mysqli_query($connection,"SELECT * FROM feedback WHERE username = '$username'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css_format/test.css">
    <title>My website</title>
</head>

    
<body>
<div class="container-fluid">
    <div id="headerid" class="mb-5">
        <!-- header here -->
    </div>
<div class="row px-5">
    <div class="row mt-5 ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-2">
                <li class="breadcrumb-item"><a href="account_list.html">Danh sách thành viên</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết</li>
            </ol>
        </nav>
        <?php 
            if ($data["role"]=="GUEST"){
                ?>
                <button type="button" class="btn mx-2 btn-warning w-25 mb-2" onclick="location.href='authentic.php?for=ban&id=<?php echo $data["user_id"];?>'">Cấm tài khoản này</button>
                <button type="button" class="btn mx-2 btn-danger w-25 mb-2" onclick="location.href='authentic.php?for=del&id=<?php echo $data["user_id"];?>'">Xóa tài khoản này</button>
                <?php
            } else if ($data["role"]=="BAN"){
                ?>
                <button type="button" class="btn mx-2 btn-success w-25 mb-2" onclick="location.href='authentic.php?for=unban&id=<?php echo $data["user_id"];?>'">Mở khóa tài khoản này</button>
                <button type="button" class="btn mx-2 btn-danger w-25 mb-2" onclick="location.href='authentic.php?for=del&id=<?php echo $data["user_id"];?>'">Xóa tài khoản này</button>
                <?php
            }
        ?>
    </div>
    <div id="body" class="row">
        <div class="col-4">
        <div class="card" style="background-color: #CCE5FF;">
        <img src="<?php echo $data['avatar'];?>" alt="avatar" class="card-img-top">
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
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Họ và tên: <?php echo $data["name"];?></li>
                    <li class="list-group-item">Ngày tháng năm sinh: <?php echo $data["birthday"];?></li>
                    <li class="list-group-item">Giới tính: <?php echo $data["gender"];?></li>
                    <li class="list-group-item">Email: <?php echo $data["email"];?></li>
                    <li class="list-group-item">Số điện thoại: <?php echo $data["phone"];?></li>
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
                <ul class="list-group list-group-flush">
                    <?php 
                    $active = $data = mysqli_fetch_assoc($feedback);
                    while ($active){
                        $productid = $active["product_id"];
                        $product = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM product_info WHERE product_id = $productid"));
                    ?>
                    <li class="list-group-item">Đánh giá <?php star($active["stars"]);?> cho <a href="/btl/products/productDetail/productDetail.php?product_id=<?php echo $product["product_id"]; ?>"> <?php echo $product["product_name"];?></a></li>
                    <?php 
                        $active = $data = mysqli_fetch_assoc($feedback);
                    } 
                    ?>
                </ul>
            </div>
        </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    function showHeader(){
            $.ajax(
                {
                    url: 'header.php',
                    type: 'GET',
                    success: function(data) {
                        $("#headerid").html(data);
                        },
                    error: function(xhr, status, error) {
                        console.log('Error: ' + error);
                        }
                }
            )
        }
    showHeader();
</script>
</body>
</html>
<?php 
    mysqli_close($connection);
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