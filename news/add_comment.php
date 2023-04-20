<?php
function testInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

session_start();
// echo (print_r($_SESSION));
if (!isset($_SESSION['user_id']) || $_SERVER["REQUEST_METHOD"] != "POST") {
  die('404');
}
$user_id = $_SESSION['user_id'];
$news_id = $_POST['news_id'];
$content = testInput($_POST['content']);
$reply_id = $_POST['reply_id'];
$current_date = date('Y-m-d');

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

mysqli_query($db_connect, "INSERT INTO news_comment (reply_id, content, timestamp, news_id, user_id) VALUES ($reply_id, '$content', '$current_date', $news_id, $user_id)");

mysqli_close($db_connect);
?>