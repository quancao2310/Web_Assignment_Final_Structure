<?php
function testInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'ADMIN' || $_SERVER["REQUEST_METHOD"] != "POST") {
  die('404');
}

// Validate
$name = testInput($_POST['name']);
$summary = testInput($_POST['summary']);
$content = ($_POST['content']);
$thumbnail = testInput($_POST['thumbnail']);
$current_date = date('Y-m-d');

$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

mysqli_query($db_connect, "INSERT INTO news (name, author, date_modified, summary, content, thumbnail) VALUES ('$name', 'ADMIN', '$current_date', '$summary', '$content', '$thumbnail')");

mysqli_close($db_connect);
header("Location: /btl/news/news.html");
die();
?>