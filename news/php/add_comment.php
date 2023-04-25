<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SERVER["REQUEST_METHOD"] != "POST") {
  http_response_code(403);
  die();
}

$user_id = $_SESSION['user_id'];
$news_id = $_POST['news_id'];
$content = testInput($_POST['content']);
$reply_id = $_POST['reply_id'];
$current_date = date('Y-m-d');

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  http_response_code(500);
  die("Database connection failed.");
}

$query = mysqli_query($db_connect, "INSERT INTO news_comment (reply_id, content, timestamp, news_id, user_id) VALUES ($reply_id, '$content', '$current_date', $news_id, $user_id)");
if ($query) {
  http_response_code(200);
}
else {
  http_response_code(500);
}

mysqli_close($db_connect);

function testInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}
?>