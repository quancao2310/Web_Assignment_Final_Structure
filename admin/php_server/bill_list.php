<?php
    $page = 1;
    if (isset($_POST["page"])){
        $page = $_POST["page"];
    }
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    $data = mysqli_query($connection,"SELECT * FROM feedback");
    $max_page = intdiv(mysqli_num_rows($data)-1,10)+1;
    if ($page > $max_page) $page=1;
    mysqli_data_seek($data,($page-1)*10);
?>

<div class="container ">
<table class="table table-info table-striped table-hover table-sm">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Người đánh giá</th>
            <th>Đánh giá</th>
            <th>Nội dung</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for($i=0;$i<10;$i++){
            $row = mysqli_fetch_assoc($data);
            if ($row){
                ?>
                <tr>
                    <td> <?php echo $row["feedback_id"]; ?> </td>
                    <td> <a href="../productDetail/productDetail.php?product_id=<?php echo $row["product_id"]; ?>"><?php echo $row["product_name"]; ?></a> </td>
                    <td> <?php echo $row["username"]; ?> </td>
                    <td> <?php star($row["stars"]); ?> </td>
                    <td class="w-25"> <?php echo substr($row["detail"],0,100)."..."; ?> </td>
                    <td> 
                        <button type="button" class="btn btn-sm btn-success" onclick="location.href='edit_product.php?id=<?php echo $row["product_id"]; ?>'">Chi tiết</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="location.href='delete_product.php?id=<?php echo $row['product_id'];?>'">Xóa</button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>

<div class="row mt-2">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end" id="paginatio">
                <?php
                    if ($page !=1){
                ?>
                <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $page-1;?>)">Previous</button></li>
                <?php
                    }
                ?>
                <?php
                    if ($max_page <= 5){
                        for ($i=1; $i<=$max_page;$i++){
                ?>
                <li class="page-item"><button class="page-link <?php if ($page == $i) echo "active";?>" onclick="showPage(<?php echo $i;?>)"><?php echo $i;?></button></li>
                <?php
                        }
                    } else {
                        if ($page<=2){
                            ?>
                            <li class="page-item"><button class="page-link <?php if ($page == 1) echo "active";?>" onclick="showPage(<?php echo 1;?>)">1</button></li>
                            <li class="page-item"><button class="page-link <?php if ($page == 2) echo "active";?>" onclick="showPage(<?php echo 2;?>)">2</button></li>
                            <li class="page-item"><button class="page-link <?php if ($page == 3) echo "active";?>" onclick="showPage(<?php echo 3;?>)">3</button></li>
                            <li class="page-item"><button class="page-link" onclick="showPage(<?php echo 4;?>)">...</button></li>
                            <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $max_page;?>)"><?php echo $max_page;?></button></li>
                            <?php
                                }
                            else if ($page >= $max_page -1){
                            ?>
                            <li class="page-item"><button class="page-link <?php if ($page == 1) echo "active";?>" onclick="showPage(<?php echo 1;?>)">1</button></li>
                            <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $max_page-3;?>)">...</button></li>
                            <li class="page-item"><button class="page-link <?php if ($page == $max_page-2) echo "active";?>" onclick="showPage(<?php echo $max_page-2;?>)"><?php echo $max_page-2; ?></button></li>
                            <li class="page-item"><button class="page-link <?php if ($page == $max_page-1) echo "active";?>" onclick="showPage(<?php echo $max_page-1;?>)"><?php echo $max_page-1; ?></button></li>
                            <li class="page-item"><button class="page-link <?php if ($page == $max_page) echo "active";?>" onclick="showPage(<?php echo $max_page;?>)"><?php echo $max_page; ?></button></li>
                            <?php
                                } else {
                                    ?>
                                    <li class="page-item"><button class="page-link" onclick="showPage(<?php echo 1;?>)">1</button></li>
                                    <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $page-2;?>)">...</button></li>
                                    <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $page-1;?>)"><?php echo $page-1; ?></button></li>
                                    <li class="page-item"><button class="page-link active" onclick="showPage(<?php echo $page;?>)"><?php echo $page; ?></button></li>
                                    <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $page+1;?>)"><?php echo $page+1; ?></button></li>
                                    <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $page+2;?>)">...</button></li>
                                    <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $max_page;?>)"><?php echo $max_page; ?></button></li>

                                    <?php
                                }
                            }
                            ?>
                <?php
                    if ($page !=$max_page){
                ?>
                <li class="page-item"><button class="page-link" onclick="showPage(<?php echo $page+1;?>)">Next</button></li>
                <?php
                    }
                ?>
        </ul>
    </nav>
</div>
</div>
<?php
    mysqli_close($connection);
?>