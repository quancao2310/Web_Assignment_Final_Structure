<?php

include '../include/config.php';

session_start();
session_unset();
if (ini_get("session.use_cookies")) {
  foreach ($_COOKIE as $key => $value) {
    setcookie($key, $value, time() - 86400 * 30, '/btl');
  }
}
session_destroy();

header('location: /btl/');

?>