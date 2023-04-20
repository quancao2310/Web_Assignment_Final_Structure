<?php
    $connection = mysqli_connect("localhost", "root", "");
    if (!$connection) {
        die("Connect fail!");
    }
    $db_manager = mysqli_select_db($connection, "manager");
    if (!$db_manager) {
        die("Can't use manager db!");
    }
