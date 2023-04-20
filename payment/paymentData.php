<?php
session_start();
if (!isset($_SESSION["prod_list"]) || empty($_SESSION["prod_list"]) || $_SESSION["prod_list"] == []) {
    echo "";
} else {
    echo json_encode($_SESSION["prod_list"]);
}
exit;
