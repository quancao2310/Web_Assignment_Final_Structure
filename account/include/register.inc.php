<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $r_password = $_POST['r-password'];

    require_once 'config.php';
    require_once 'functions.inc.php';

    if (emptyInputRegister($username, $email, $password, $r_password) !== false) {
        header("location:../../page/register.php?error=emptyinput");
        exit();
    }

    if (invalidUsername($username) !== false) {
        header("location:../../page/register.php?error=invalidusername");
        exit();
    }

    if (invalidPwd($password) !== false) {
        header("location:../../page/register.php?error=invalidpassword");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location:../../page/register.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($password, $r_password) !== false) {
        header("location:../../page/register.php?error=notmatchpassword");
        exit();
    }
    
    if (userExist($conn, $username, $email) !== false) {
        header("location:../../page/register.php?error=usernametaken");
        exit();
    }

    createUser($conn, $username, $email, $password);
    
}
else {
    header('location:../../page/register.php');
}
