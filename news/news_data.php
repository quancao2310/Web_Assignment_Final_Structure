<?php
session_start();
// $login = true;
// if (!isset($_SESSION['username'])) {
//   $login = false;
// }


$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

$news = mysqli_query($db_connect, "SELECT * FROM news ORDER BY date_modified DESC");
$news = mysqli_fetch_all($news, MYSQLI_ASSOC);
?>

<nav aria-label="breadcrumb" class="bg-light p-2 py-lg-3">
  <ol class="breadcrumb m-0">
    <li class="breadcrumb-item"><a href="../index.html" class="text-dark fw-bold text-decoration-none">Trang chủ</a></li>
    <li class="breadcrumb-item active" aria-current="page" class="text-secondary">Tin tức</li>
  </ol>
</nav>
<div class="container-fluid py-2">
  <div class="row">
    <div class="sidebar col-lg-3 border border-dark border-opacity-25 ms-2 mb-3">
      <h5 class="text-uppercase text-primary text-center py-3 mx-3" id="sidebar-header">Bài viết mới nhất</h5>
      <nav class="nav flex-column p-3" id="sidebar-menu">
        <?php
        $no_of_items_in_sidebar = min(count($news), 3);
        for ($i = 0; $i < $no_of_items_in_sidebar; $i++) {
          $row = $news[$i];
        ?>
          <div class="row py-2 g-3">
            <div class="col-4">
              <a href="<?php echo "news_post.html?id=".$row['news_id']; ?>"><img src="<?php echo $row['thumbnail']; ?>" alt="News thumbnail" style="width: 100%"></a>
            </div>
            <div class="col-8 mt-2">
              <a href="<?php echo "news_post.html?id=".$row['news_id']; ?>" class="text-primary text-decoration-none fw-bold" style="font-size: 0.75rem;"><?php echo $row['name']; ?></a>
              <div class="text-secondary" style="font-size: 0.75rem;">
                <?php 
                $tmp_date = $row['date_modified'];
                $new_date = date('d/m/Y', strtotime($tmp_date));
                echo $row['author']." - ".$new_date;
                ?>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </nav>
    </div>
    <div class="col-lg-8 ms-3">
      <h1 class="text-primary fw-semibold mb-3">Tin tức</h1>
      <?php
      if ($_SESSION['role'] == 'ADMIN') {
      echo "<a href='news_add_form.html' role='button' class='btn btn-primary' id='add-news'>Thêm tin</a>";
      }
      ?>
      <?php
      for ($i = 0; $i < count($news); $i++) {
        $row = $news[$i];
      ?>
      <div class="row py-2 g-3">
        <div class="col-4">
          <a href="<?php echo "news_post.html?id=".$row['news_id']; ?>"><img src="<?php echo $row['thumbnail']; ?>" alt="News thumbnail" style="width: 100%"></a>
        </div>
        <div class="col-7">
          <a href="<?php echo "news_post.html?id=".$row['news_id']; ?>" class="text-primary text-decoration-none fw-bold fs-5"><?php echo $row['name']; ?></a>
          <div class="text-secondary">
            <?php 
            $tmp_date = $row['date_modified'];
            $new_date = date('d/m/Y', strtotime($tmp_date));
            echo "Người viết: ".$row['author']." - ".$new_date;
            ?>
          </div>
        </div>
        <?php
        if ($_SESSION['role'] == 'ADMIN') {
        ?>
        <div class="col dropdown">
          <a role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
              <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
            </svg>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><button type="button" class="dropdown-item delete-news" id="del-news-<?php echo $row['news_id']; ?>">Xóa tin</button></li>
          </ul>
        </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
    </div>
  </div>
</div>

<?php
mysqli_close($db_connect);
?>