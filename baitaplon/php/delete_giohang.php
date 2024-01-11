<?php
session_start();

if (isset($_GET['key'])) {
    $product_id_to_delete = $_GET['key'];
    // Xóa mục đơn hàng cụ thể từ giỏ hàng
    if (isset($_SESSION['cart'][$product_id_to_delete])) {
        unset($_SESSION['cart'][$product_id_to_delete]);
        // Redirect hoặc làm điều gì đó tiếp theo sau khi xóa
        header("Location: /ULSA/baitaplon/php/addtocart.php");
        exit(); // Kết thúc chương trình sau khi chuyển hướng
    }
}
?>
