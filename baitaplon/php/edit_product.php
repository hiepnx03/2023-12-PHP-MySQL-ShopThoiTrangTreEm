<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";
}

include_once 'product_class.php'; // Class Product

// Kiểm tra đăng nhập
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Kiểm tra nếu 'id' của sản phẩm không được truyền vào từ trang 'sell.php'
if (!isset($_GET['id'])) {
    header("Location: sell.php");
    exit();
}

// Tạo một đối tượng Product
$product = new Product($db);

// Lấy thông tin sản phẩm cần sửa
$product_id = $_GET['id'];
$productInfo = $product->getProductById($product_id);

// Xử lý cập nhật sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_product_name = $_POST['new_product_name'];
    $new_product_description = $_POST['new_product_description'];
    $new_product_price = $_POST['new_product_price'];

    $result = $product->updateProduct($product_id, $new_product_name, $new_product_description, $new_product_price);

    if ($result) {
        echo "Sản phẩm đã được cập nhật thành công.";
    } else {
        echo "Lỗi khi cập nhật sản phẩm.";
    }
}

?>

<!DOCTYPE html>
<head>
    <title>Sửa Sản phẩm</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<!-- Giao diện HTML để sửa thông tin sản phẩm -->

</body>
