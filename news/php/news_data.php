<?php
session_start();
header('Content-Type: application/json');

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  http_response_code(500);
  die("Database connection failed.");
}

$news = mysqli_query($db_connect, "SELECT * FROM news ORDER BY date_modified DESC");
if (mysqli_num_rows($news) == 0) {
  http_response_code(500);
}
else {
  $news = mysqli_fetch_all($news, MYSQLI_ASSOC);
  echo json_encode($news);
  http_response_code(200);
}

mysqli_close($db_connect);
?>