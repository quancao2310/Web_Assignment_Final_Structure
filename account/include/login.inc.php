<?php
include 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once 'config.php';
    require_once 'functions.inc.php';

    if (emptyInputLogin($username, $password) !== false) {
        header("location: /btl/account/page/login.php?error=emptyinput");
        exit();
    }

    if (!checkedUid($conn, $username) !== false) {
        header("location: /btl/account/page/login.php?error=wrongusername");
        exit();
    }

    if (!checkedPwd($conn, $username, $password) !== false) {
        header("location: /btl/account/page/login.php?error=wrongpassword");
        exit();
    }

    loginUser($conn, $username, $password);
    
}
else {
    header('location:../../page/login.php');
}
