<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Sản phẩm</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">

</head>
<body>
<header>
    <h1 style="color: white">Quản lý Sản phẩm</h1>
    <nav>
        <ul>
            <li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>
            <li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>
            <li><a href="/ULSA/baitaplon/php/cart.php" >Giỏ hàng</a></li>
            <li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>
            <?php
            if (isset($_SESSION["username"])) {
                // Nếu người dùng đã đăng nhập, hiển thị liên kết Đăng xuất
                echo '<li><a href="/ULSA/baitaplon/php/sell.php" class="active" >Bán Hàng</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                // Nếu chưa đăng nhập, hiển thị liên kết Đăng nhập và Đăng ký
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>