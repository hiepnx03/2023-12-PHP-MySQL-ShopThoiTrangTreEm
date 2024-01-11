<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (!isset($_SESSION["username"])) {
        header("Location: /ULSA/baitaplon/php/login.php"); // Chuyển hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
        exit();
    }

    // Kiểm tra xem giỏ hàng có dữ liệu không
    if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
        echo "Giỏ hàng của bạn đang trống.";
        exit();
    }

    // Lấy product_id và quantity từ biểu mẫu POST
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    // Đảm bảo quantity là số nguyên dương
    $quantity = max(1, intval($quantity));

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    $_SESSION["cart"][$product_id] = $quantity;

    // Chuyển hướng người dùng đến trang giỏ hàng
    header("Location: /ULSA/baitaplon/php/cart.php");
    exit();
} else {
    // Nếu không phải là POST request, chuyển hướng người dùng đến trang 404 hoặc trang khác tùy ý
    header("Location: /ULSA/baitaplon/php/404.php");
    exit();
}
?>
