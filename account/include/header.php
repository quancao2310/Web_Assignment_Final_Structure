<?php 

include 'include/config.php';

?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css">
  <title>Document</title>
</head>

<body>
  <header>
    <div class="logo">
        <img src="../../images/logo.png" alt="QN2H" width="42px" height="30px">
    </div>
    <ul class="navbar">
        <li><a href="/btl/">Home</a></li>
        <li><a href="#">Product</a></li>
        <li><a href="#">News</a></li>
        <li><a href="/btl/account/page/user_page.php<?php if (isset($_SESSION['id'])) {
          echo "?id=" . $_SESSION['id']; } ?>">User</a></li>
        <li>
          <?php
            if (!isset($_SESSION['username'])) {
              echo "<a href=\"/btl/account/include/logout.php\"><button type=\"button\" name=\"logout\" class=\"register-btn\">Logout</button></a>";
            } else {
              echo "<a href=\"../include/logout.php\"><button type=\"button\" name=\"logout\" class=\"register-btn\">Logout</button></a>";
            }
          ?>
        </li>
    </ul>
  </header>