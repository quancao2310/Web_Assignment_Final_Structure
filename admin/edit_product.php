<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        header("Location: /btl/page_not_found.html");
        exit;
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $product_id = $_POST["product_id"];
        $product_name = $_POST["product_name"];
        $product_description = $_POST["product_description"];
        $size = array();
        if (isset($_POST["size_m"])) array_push($size,$_POST["size_m"]);
        if (isset($_POST["size_l"])) array_push($size,$_POST["size_l"]);
        if (isset($_POST["size_s"])) array_push($size,$_POST["size_s"]);
        $size = implode(", ",$size);
        $color_list = $_POST["color_list"];
        $product_price = $_POST["product_price"];
        $quantity = $_POST["quantity"];
        $product_type = $_POST["product_type"];
        $query = "UPDATE product_info SET product_name='$product_name', product_description='$product_description', product_size='$size', product_color='$color_list', product_price=$product_price, product_type='$product_type', quantity=$quantity WHERE product_id = $product_id";
        $host = "localhost"; 
        $user = "root";
        $password = ""; 
        $database = "manager";
        $connection = mysqli_connect($host, $user, $password, $database);
        mysqli_query($connection,$query);
        $image = "";
        if ($_POST["image_list"]!=""){
            $image = explode(", ",$_POST["image_list"]);
        }
        if ($image){
            $query = "UPDATE product_image SET product_id = $product_id";
            for ($i=0; $i < 5; $i++) { 
                if ($i<count($image)){
                    $image_link = $image[$i];
                    $query = $query .","."image_".($i+1)." ='$image_link'";
                }
            }
            $query = $query."WHERE product_id = $product_id";
            if (mysqli_num_rows(mysqli_query($connection,"SELECT * FROM product_image WHERE product_id = $product_id")))
                mysqli_query($connection,$query);
            else {
                if ($image){
                    $query = "INSERT INTO product_image (product_id,image_1,image_2,image_3,image_4,image_5) VALUES ($product_id ";
                    for ($i=0; $i < 5; $i++) { 
                        if ($i<count($image)){
                            $image_link = $image[$i];
                            $query = $query .","." '$image_link'";
                        } else {
                            $query = $query.",''";
                        }
                    }
                    $query = $query.")";
                    mysqli_query($connection,$query);
                }
            }
        }
        mysqli_close($connection);
        header("Location: products_list.html");
        exit;
    }
?>
<?php
    $id = "";
    if (isset($_GET["id"])){
        $id = $_GET["id"];
    }   else {
        header("Location: page_not_found.html");
        exit;
    }
    
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    $data = mysqli_query($connection,"SELECT * FROM product_info WHERE product_id = $id");
    $data = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<link rel="stylesheet" href="css_format/test.css">
    <title>My website</title>
   
</head>
<body>
    <div class="container-fluid">
        <div id="headerid" class="mb-5">
            <!-- header here -->
        </div>
        <div class="container mt-5">
            <nav aria-label="breadcrumb" class="pt-5">
                <ol class="breadcrumb mt-2">
                    <li class="breadcrumb-item" aria-current="page"><a href="../index.html">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="products_list.html">Danh mục sản phẩm</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa sản phẩm</li>
                </ol>
                </nav>
        <form class="row" action="edit_product.php" method="post" id="edit_form">
            <div class="col-md-6 border-end border-secondary border-2 pe-2">
            <div class="my-1 d-flex">
                <label for="product_id" class="form-label me-2">ID sản phẩm:</label>
                <input type="number" class="form-control w-25" id="product_id" name="product_id" aria-describedby="validate_id" value="<?php echo $data['product_id'];?>" disabled>
            </div>
            <div class="form-text text-danger" id="validate_id"></div>
            <div class="my-1">
                <label for="product_name" class="form-label">Tên sản phẩm:</label>
                <input type="text" id="product_name" name="product_name" class="form-control w-100" placeholder="Nhập tên sản phẩm" value="<?php echo $data['product_name']?>" required>
            </div>
            <div class="my-1">
                <label class="form-label" for="product_description">Mô tả:</label>
                <textarea class="form-control w-100" rows="5" id="product_description" name="product_description" placeholder="Nhập mô tả" required><?php echo $data['product_description']?></textarea>
            </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                <div class="form-label">Size:</div>
                <div class="form-check mx-5 d-flex" id="check-area">
                    <div class="mx-2">
                    <input class="form-check-input mx-2" type="checkbox" value="S" id="size_s" name="size_s" <?php if(strpos($data['product_size'],"S")!==false) { ?>checked <?php }?>>
                    <label class="form-check-label" for="size_s">
                        S
                    </label>
                    </div>
                    <div class="mx-2">
                    <input class="form-check-input mx-2" type="checkbox" value="M" id="size_m" name="size_m" <?php if(strpos($data['product_size'],"M")!==false) { ?>checked <?php }?>>
                    <label class="form-check-label" for="size_m" >
                        M
                    </label>
                    </div>
                    <div class="mx-2">
                    <input class="form-check-input mx-2" type="checkbox" value="L" id="size_l" name="size_l"<?php if(strpos($data['product_size'],"L")!==false) { ?>checked <?php }?>>
                    <label class="form-check-label" for="size_l">
                        L
                    </label>
                    </div>
                  </div>
                </div>
                <div class="my-1">
                    <div class="form-group d-flex">
                        <label for="product_type" class="form-label w-auto me-3">Loại sản phẩm:</label>
                        <select class="form-select w-auto" id="product_type" name="product_type">
                          <option value="T-SHIRT" <?php if($data['product_type']=="T-SHIRT") { ?>selected <?php }?>>T-SHIRT</option>
                          <option value="HOODIE" <?php if($data['product_type']=="HOODIE") { ?>selected <?php }?>>HOODIE</option>
                          <option value="SHORT PANTS" <?php if($data['product_type']=="SHORT PANTS") { ?>selected <?php }?>>SHORT PANTS</option>
                          <option value="JEANS" <?php if($data['product_type']=="JEANS") { ?>selected <?php }?>>JEANS</option>
                          <option value="WALLET" <?php if($data['product_type']=="WALLET") { ?>selected <?php }?>>WALLET</option>
                        </select>
                      </div>
                </div>
                <div class="my-1"> 
                    <div>
                        Màu sắc:
                    </div>
                    <div class="d-flex">
                        <input type="text" class="form-control w-50" id="color_name" placeholder="Nhập màu">
                        <button type="button" class="btn btn-primary" id="add_color_button">Thêm màu</button>
                        <button type="button" class="btn btn-danger" id="del_color_button">Xóa màu</button>
                    </div>
                    <textarea type="text" class="mt-1 form-control" id="color_list" name="color_list" disabled><?php echo $data["product_color"]; ?></textarea>
                </div>
                <div class="my-1 d-flex">
                    <label for="product_price" class="form-label mx-2">Giá sản phẩm:</label>
                    <input type="number" class="form-control w-50" id="product_price" name="product_price" placeholder="Nhập giá" value="<?php echo $data['product_price']; ?>" required>
                </div>
                <div class="my-1 d-flex">
                    <label for="quantity" class="form-label mx-2">Số lượng:</label>
                    <input type="number" class="form-control w-50" id="quantity" name="quantity" placeholder="Nhập số lượng" value="<?php echo $data['quantity']; ?>" required>
                </div>
            </div>
            <div class="my-1 row">
                <div class="d-flex">
                    <label class="form-label mx-2" for="link">Hình ảnh:</label>
                    <input type="text" class="form-control w-50 mx-2" id="link" placeholder="Nhập liên kết">
                    <button type="button" class="btn btn-primary" id="add_image_button">Thêm Ảnh</button>
                </div>
            </div>
            <div class="my-1 row" id="show-images">
                <div class="col-md-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg" class="w-100 img-thumbnail" alt="image1">
                    <button type="button" class="btn btn-sm btn-secondary deleteImage" onclick="deleteImage(0)">Xóa</button>
                </div>
                <div class="col-md-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg" class="w-100 img-thumbnail" alt="image2">
                    <button type="button" class="btn btn-sm btn-secondary deleteImage" onclick="deleteImage(1)">Xóa</button>
                </div>
                <div class="col-md-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg" class="w-100 img-thumbnail" alt="image3">
                    <button type="button" class="btn btn-sm btn-secondary deleteImage" onclick="deleteImage(2)">Xóa</button>
                </div>
                <div class="col-md-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg" class="w-100 img-thumbnail" alt="image4">
                    <button type="button" class="btn btn-sm btn-secondary deleteImage" onclick="deleteImage(3)">Xóa</button>
                </div>
                <div class="col-md-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg" class="w-100 img-thumbnail" alt="image5">
                    <button type="button" class="btn btn-sm btn-secondary deleteImage" onclick="deleteImage(4)">Xóa</button>
                </div> 
            </div>
            <div>
                <input type="hidden" name="image_list" id="image_list">
            </div>
            <div class="row justify-content-end">
                <button type="submit" class="btn btn-sm w-auto px-5 btn-success" id="submit" disabled>Xác nhận</button>
            </div>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        let color_list = $("#color_list").val().split(", ");
        let images_list = [<?php
                $image = mysqli_query($connection,"SELECT image_1, image_2, image_3,image_4,image_5 FROM product_image WHERE product_id = $id");
                if (mysqli_num_rows($image)){
                    $image = mysqli_fetch_array($image);
                    $count = 0;
                    for ($i=0 ;$i < count($image)/2 ;$i++) {
                        $value = $image[$i];
                        if ($value){ 
                            if ($count!=0) echo ',';
                            echo "'$value'";
                            $count+=1;
                        }
                    }
                }
            ?>];
        
        function showImage(){
            if (images_list.length == 5) $("#add_image_button").attr("disabled",true);
                else $("#add_image_button").attr("disabled",false);
            let image = $(".img-thumbnail");
            let deleteImage = $(".deleteImage");
            for (let i = 0; i < 5; i++) {
                if (i<images_list.length){
                    image[i].setAttribute("src",images_list[i]);
                    deleteImage[i].hidden = false;
                } else {
                    image[i].setAttribute("src","https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg");
                    deleteImage[i].hidden = true;
                }
            }
            $("#image_list").val(images_list.join(", "));
        }
        function deleteImage(x){
            images_list.splice(x,1);
            showImage();
        }
        $("form").submit(function(){
            $("#color_list").attr("disabled",false);
            $("#product_id").attr("disabled",false);
        });
        function submit_valid(){
            let checked = $("input[type=checkbox]:checked").length;
            $("#submit").attr("disabled", (!checked));

        }
        function showHeader(){
                $.ajax(
                    {
                        url: 'header.php',
                        type: 'GET',
                        success: function(data) {
                            $("#headerid").html(data);
                            }, 
                        error: function(xhr, status, error) {
                            console.log('Error: ' + error);
                            }
                    }
                )
            }
        showHeader();
        $("#add_color_button").click(function(){
            let color = $("#color_name").val();
            if (!(color_list.includes(color))){
                color_list.push(color);
            }
            $("#color_name").val("");
            $("#color_list").html(color_list.join(", "));
        });
        $("#del_color_button").click(function(){
            let color = $("#color_name").val();
            if (color_list.includes(color)){
                let idx = color_list.indexOf(color);
                color_list.splice(idx,1)
            }
            $("#color_name").val("");
            $("#color_list").html(color_list.join(", "));
        });
        $("#add_image_button").click(function(){
            let image_link = $("#link").val();
            if (image_link) images_list.push(image_link);
            showImage();
            $("#link").val("");
        });
        $("#product_id").change(submit_valid);
        $("#check-area").click(submit_valid);
        submit_valid();
        showImage()
    </script>
</body>
</html>


<?php
mysqli_close($connection);
?>