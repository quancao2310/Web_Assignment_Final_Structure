<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        header("Location: /btl/page_not_found.html");
        exit;
    }
    if (!isset($_GET["id"])){
        header("Location: page_not_found.html");
        exit;
    }
    $id=$_GET["id"];
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    $data = mysqli_query($connection,"SELECT * FROM account_info WHERE user_id = $id");
    $data = mysqli_fetch_assoc($data);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $detail = $_POST["detail"];
        mysqli_query($connection,"UPDATE account_info SET role = 'BAN', more = '$detail' WHERE user_id = $id");
        mysqli_close($connection);
        header("Location: account_list.html");
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
  <title>Cấm tài khoản</title>
</head>
<body>
    <div class="container">
    <div class="row border border-1 border-dark">
      <nav class="navbar navbar-expand-sm bg-light">
      <a class="navbar-brand ms-3" href="#" style="font-size: x-large;">Khóa tài khoản</a>
      </nav>
    </div>
    <div class="row m-3">
      <button type="button" class="btn-secondary btn btn-sm w-50" onclick="window.history.back(); window.history.back()">Hủy</button>
    </div>
        <form method="post" action="<?php echo "ban.php?id=$id";?>">
            <div class="my-3 d-flex">
                <label for="username" class="form-label">Userame</label>
                <input type="text" class="form-control ms-2 w-25" id="username" name="username" value="<?php echo $data['username'];?>" disabled>
            </div>
            <div class="my-3">
                <label for="detail" class="form-label">Tin nhắn chi tiết</label>
                <textarea type="text" class="form-control ms-2" id="detail" name="detail" rows="7" required></textarea>
            </div>
            <button type="submit" class="btn btn-sm btn-warning">Khóa</button>
        </form>
    </div>
</body>
</html>

<?php
    mysqli_close($connection);
?>