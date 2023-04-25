<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        header("Location: /btl/page_not_found.html");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="css_format/test.css">
    <title>My website</title>
</head> 
<body>
<?php
    $id = $_GET["id"];
    $for = $_GET["for"];
    $action_url = "authentic.php?for=$for&id=$id";
    $username = $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "localhost"; 
        $user = "root";
        $password = ""; 
        $database = "manager";
        $connection = mysqli_connect($host, $user, $password, $database);
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);
        $account = mysqli_query($connection,"SELECT * FROM account_info WHERE username = '$username'");
        $account = mysqli_fetch_assoc($account);
        if ($account){
            if ($account["role"]!="ADMIN") noPermission($id);
            else {
                if ($for=="ban"){
                    mysqli_close($connection);
                    header("Location: ban.php?id=$id");
                    exit;
                }
                if ($for=="unban"){
                    mysqli_query($connection,"UPDATE account_info SET role = 'GUEST', more = '' WHERE user_id = $id");
                    mysqli_close($connection);
                    header("Location: account_detail.php?id=$id");
                    exit;
                } 
                if ($for=="del"){
                    $username = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM account_info WHERE user_id = $id"))["username"];
                    mysqli_query($connection,"DELETE FROM account_info WHERE user_id = $id");
                    mysqli_query($connection,"DELETE FROM feedback WHERE username = '$username'");
                    mysqli_close($connection);
                    header("Location: account_list.html");
                    exit;
                }
            }
        } else {
            noPermission($id);
        }
        mysqli_close($connection);
?>
<?php } else {
    ?>
<div class="container justify-content-center d-flex">
    <div class="w-75 mt-5 border-2 border border-dark px-2" style="background-color: #FFCCE5;">
        <h2 class="text-center mb-4">Xác Thực</h2>
        <p class="text-center mb-4">Bạn cần xác thực để thực hiện chức năng này</p>
        <form action="<?php echo $action_url;?>" method="POST">
            <div class="mb-3 w-50">
            <label for="username" class="form-label w-50">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3 w-50">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary float-end">Xác thực</button>
            <br>
            <br>
        </form>
    </div>
</div>


<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>
</html>
<?php 
    function noPermission($id){
        ?>
<div class="container justify-content-center d-flex">
    <div class="w-75 mt-5 border-2 border border-dark px-2" style="background-color: #FFCCE5;">
        <h2 class="text-center mb-4 mt-2 text-danger">LỖI !</h2>
        <p class="text-center mb-4">Bạn nhập sai thông tin xác thực hoặc bạn không có quyền thực hiện thao tác này</p>
        <span>
        <button class="btn btn-secondary btn-sm w-25 mb-2" onclick="location.href='account_detail.php?id=<?php echo $id;?>'">Quay lại</button>
        </span>
    </div>
</div>
        <?php
    }
?>