<?php
session_start();
header('Content-Type: application/json');

if (!isset($_POST['news_id'])) {
  die("404");
}
$id = $_POST['news_id'];

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

$row = mysqli_query($db_connect, "SELECT * FROM news WHERE news_id=$id");
if (mysqli_num_rows($row) == 0) {
  die("No id in database");
}
$row = mysqli_fetch_assoc($row);
$comments = mysqli_query($db_connect, "SELECT cmt.*, acc.name FROM news_comment cmt INNER JOIN account_info acc ON cmt.user_id = acc.user_id WHERE cmt.news_id=$id ORDER BY cmt.reply_id ASC, cmt.timestamp DESC");
$comments = mysqli_fetch_all($comments, MYSQLI_ASSOC);
$data = array('newsInfo' => $row, 'newsComment' => $comments);
echo json_encode($data);


mysqli_close($db_connect);
?>