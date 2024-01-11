<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["username"])) {
    echo "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.";
    exit();
}

// Lấy thông tin sản phẩm muốn thêm vào giỏ hàng từ biểu mẫu hoặc URL
if (isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];
} else {
    echo "Không có sản phẩm để thêm vào giỏ hàng.";
    exit();
}

// Thêm sản phẩm vào giỏ hàng (sử dụng một biến phiên để lưu trữ giỏ hàng)
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}

// Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
if (array_key_exists($product_id, $_SESSION["cart"])) {
    // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên 1
    $_SESSION["cart"][$product_id] += 1;
} else {
    // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm mới với số lượng là 1
    $_SESSION["cart"][$product_id] = 1;
}

// Chuyển người dùng trở lại trang sản phẩm hoặc trang khác tùy ý
header("Location: /ULSA/baitaplon/php/products.php");
?>
