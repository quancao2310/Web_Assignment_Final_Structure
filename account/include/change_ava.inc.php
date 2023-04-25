<?php
session_start();
include 'config.php';
if (isset($_POST['change'])) {

    $pwd = $_POST['password'];
    $ava = $_POST['image'];
    $id = $_SESSION['user_id'];

    $sql = "SELECT * FROM account_info WHERE user_id = ? AND password = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location: change_pwd.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($stmt, 'ss', $id, $pwd);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        $sql = "UPDATE account_info SET avatar = ? WHERE user_id = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header('location: change_pwd.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'ss', $ava, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        mysqli_close($conn);
        header('location: /btl/account/change_pwd.php?error=wrongpwd');
        exit();
    }

    mysqli_close($conn);
    header('location: /btl/account/change_pwd.php?error=none');
    exit();
}
