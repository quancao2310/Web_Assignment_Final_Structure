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

// Xoa binh luan
$comment_id = $_POST['comment_id'];
$query = mysqli_query($db_connect, "DELETE FROM news_comment WHERE comment_id=$comment_id");

// Xoa binh luan reply neu co
$query = mysqli_query($db_connect, "DELETE FROM news_comment WHERE reply_id=$comment_id");

echo ($query) ? 'Success' : 'Failed';
mysqli_close($db_connect);
?>