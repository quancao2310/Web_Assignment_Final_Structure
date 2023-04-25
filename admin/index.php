<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
    header("Location: /btl/page_not_found.html");
    exit;
}
header("Location: home.html");
exit;
?>
