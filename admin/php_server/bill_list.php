<?php
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role']!="ADMIN") {
        http_response_code(404);
        exit;
    }
    $page = 1;
    if (isset($_POST["page"])){
        $page = $_POST["page"];
    }
    $host = "localhost"; 
    $user = "root";
    $password = ""; 
    $database = "manager";
    $connection = mysqli_connect($host, $user, $password, $database);
    if (isset($_POST["id"]) && isset($_POST["type"])){
        $bill_id = $_POST["id"];
        $query_type = $_POST["type"];
        if ($query_type == "cancel") {
            $data = mysqli_query($connection, "SELECT * FROM bill_info WHERE bill_id = $bill_id");
            $row = mysqli_fetch_assoc($data);
            while ($row){
                $product_id = $row["product_id"];
                $quantity = $row["chosen_quantity"];
                mysqli_query($connection, "UPDATE product_info set quantity = quantity + $quantity WHERE product_id = $product_id");
                $row = mysqli_fetch_assoc($data);
            }
            mysqli_query($connection,"DELETE FROM bill_info WHERE bill_id = $bill_id");
        } else if ($query_type == "confirm"){
            mysqli_query($connection,"DELETE FROM bill_info WHERE bill_id = $bill_id");
        }
    }
    $data = mysqli_query($connection,"SELECT bill_id, user_id, GROUP_CONCAT(DISTINCT product_id) as product_ids, SUM(price) as prices FROM bill_info GROUP BY bill_id, user_id ORDER BY bill_id;");
    $max_page = intdiv(mysqli_num_rows($data)-1,10)+1;
    if ($page > $max_page) $page=1;
    mysqli_data_seek($data,($page-1)*10);
?>

<div class="container ">
<table class="table table-info table-striped table-hover table-sm">
    <thead>
        <tr>
            <th>Mã hóa đơn</th>
            <th>Người đặt</th>
            <th>Mã sản phẩm</th>
            <th>Số lượng</th>
            <th>Size</th>
            <th>Màu sắc</th>
            <th>Thành tiền</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        for($i=0;$i<10;$i++){
            $row = mysqli_fetch_assoc($data);
            
            if ($row){
                $bill_id = $row["bill_id"];
                ?>
                <tr>
                    <td> <?php echo $bill_id; ?> </td>
                    <td> <?php 
                    $user_id = $row["user_id"];
                    $user = mysqli_query($connection,"SELECT * FROM account_info WHERE user_id = $user_id");
                    $user = mysqli_fetch_assoc($user);
                    echo $user["username"]; 
                    ?> </td>
                    <?php
                        $products = explode(",",$row["product_ids"]);
                        echo "<td>";
                        foreach ($products as $product) {
                            echo $product."<br>";
                        }
                        echo "</td>";
                        echo "<td>";
                        foreach ($products as $product) {
                            $detail_data = mysqli_query($connection,"SELECT chosen_quantity from bill_info WHERE bill_id = $bill_id AND product_id = $product");
                            $detail_data = mysqli_fetch_assoc($detail_data);
                            echo $detail_data["chosen_quantity"]."<br>";
                        }
                        echo "</td>";
                        echo "<td>";
                        foreach ($products as $product) {
                            $detail_data = mysqli_query($connection,"SELECT chosen_size from bill_info WHERE bill_id = $bill_id AND product_id = $product");
                            $detail_data = mysqli_fetch_assoc($detail_data);
                            echo $detail_data["chosen_size"]."<br>";
                        }
                        echo "</td>";
                        echo "<td>";
                        foreach ($products as $product) {
                            $detail_data = mysqli_query($connection,"SELECT chosen_color from bill_info WHERE bill_id = $bill_id AND product_id = $product");
                            $detail_data = mysqli_fetch_assoc($detail_data);
                            echo $detail_data["chosen_color"]."<br>";
                        }
                        echo "</td>";
                    ?>
                    <td> <?php echo $row["prices"]; ?> </td>
                    <td> 
                        <button type="button" class="btn btn-sm btn-success" onclick="duyet(<?php echo $bill_id;?>)">Duyệt đơn</button>
                        <button type="button" class="btn btn-sm btn-warning" onclick="huy(<?php echo $bill_id;?>)">Hủy đơn</button>
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