<?php
  session_start();
  include 'config.php';
  if (isset($_POST['change'])) {
  
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $id = $_SESSION['user_id'];
  
    if ($name != "") {
      $sql = "UPDATE account_info SET name = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../register.php?error=stmtfailed');
        exit();
      }
  
      mysqli_stmt_bind_param($stmt, 's', $name);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
  
    if ($gender != "") {
      $sql = "UPDATE account_info SET gender = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../register.php?error=stmtfailed');
        exit();
      }
  
      mysqli_stmt_bind_param($stmt, 's', $gender);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
  
    if ($birthday != "") {
      $sql = "UPDATE account_info SET birthday = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../register.php?error=stmtfailed');
        exit();
      }
  
      mysqli_stmt_bind_param($stmt, 's', $_POST['birthday']);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
  
    if ($phone != "") {
      $sql = "UPDATE account_info SET phone = ? WHERE user_id = $id;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: ../register.php?error=stmtfailed');
        exit();
      }
  
      mysqli_stmt_bind_param($stmt, 's', $phone);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }
  
    mysqli_close($conn);
    header('location: /btl/account/user_page.php');
    exit();
  }
  
  if (isset($_POST['submit'])) {
    $pwd = $_POST['password'];
    $id = $_SESSION['user_id'];
  
    $sql = "SELECT * FROM account_info WHERE user_id = ? AND password = ?;";
  
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header('location: ../register.php?error=stmtfailed');
      exit();
    }
  
    mysqli_stmt_bind_param($stmt, 'ss', $id, $pwd);
    mysqli_stmt_execute($stmt);
  
    $resultData = mysqli_stmt_get_result($stmt);
  
    mysqli_stmt_close($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
      $_SESSION['change_info_signal'] = '0';
    } else {
      $_SESSION['change_info_signal'] = '2';
    }
    mysqli_close($conn);
    header('location: /btl/account/info.php');
    exit();
  }
?>