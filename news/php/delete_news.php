<?php
session_start();
if ($_SESSION['role'] != 'ADMIN') {
  header('Location: news.html');
  die();
}

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

// Xoa tin tuc
$news_id = $_POST['news_id'];
$query = mysqli_query($db_connect, "DELETE FROM news WHERE news_id=$news_id");

// Xoa binh luan cua tin tuc nay
$query = mysqli_query($db_connect, "DELETE FROM news_comment WHERE news_id=$news_id");

echo ($query) ? 'Success' : 'Failed';
mysqli_close($db_connect);
?>