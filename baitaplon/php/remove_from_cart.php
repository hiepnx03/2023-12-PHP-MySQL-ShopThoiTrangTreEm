<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["username"])) {
    header("Location: /ULSA/baitaplon/php/login.php"); // Chuyển hướng người dùng đến trang đăng nhập
    exit();
}

// Kiểm tra xem có tham số 'product_id' trong URL không
if (isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    // Kiểm tra xem sản phẩm có trong giỏ hàng không
    if (isset($_SESSION["cart"][$product_id])) {
        // Xóa sản phẩm khỏi giỏ hàng
        unset($_SESSION["cart"][$product_id]);
    }
}

// Chuyển người dùng trở lại trang giỏ hàng
header("Location: /ULSA/baitaplon/php/cart.php");
exit();
?>
