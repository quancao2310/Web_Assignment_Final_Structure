<?php
$db_connect = mysqli_connect('localhost', 'root', '', 'manager');
if (!$db_connect) {
  die("Database connection failed.");
}

$prods_bestseller = mysqli_query($db_connect, 
"SELECT info.*, img.image_1 
FROM 
  product_info info 
INNER JOIN ( 
  SELECT product_id, image_1 
  FROM product_image 
) img 
ON info.product_id=img.product_id
LIMIT 6
");

$prods_latest = mysqli_query($db_connect, 
"SELECT info.*, img.image_1 
FROM 
  product_info info 
INNER JOIN ( 
  SELECT product_id, image_1 
  FROM product_image 
) img 
ON info.product_id=img.product_id 
ORDER BY img.product_id DESC 
LIMIT 6
");

echo json_encode(array(mysqli_fetch_all($prods_bestseller, MYSQLI_ASSOC), mysqli_fetch_all($prods_latest, MYSQLI_ASSOC)));

mysqli_close($db_connect);
?>