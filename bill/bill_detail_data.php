<?php
session_start();
include "../utilities/connect.php";
$sql = "SELECT * FROM bill_info WHERE bill_id=" . $_POST["bill_id"]
    . " AND user_id=" . $_SESSION["user_id"];
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) == 0) {
    // Handle the case when the bill ID and/or user ID is/are not exist or has/have been deleted
    // Using reponse code 404 and exit
    mysqli_close($connection);
    http_response_code(404);
    exit;
} else {
    // Get all data of the choosing bill
    $billDetail = mysqli_fetch_all($result);
    // Encode them
    echo json_encode($billDetail);
    // They should have the following format:
    // [ [bill_id, user_id, product_id, ... price], [bill_id, user_id, product_id, ... price], ...]
}
mysqli_close($connection);
exit;
?>