<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang liên hệ -->
    <link rel="stylesheet" href="/baitaplon/css/style.css">
</head>
<body>
<!-- Header -->
<header>
    <h1>Thời trang trẻ em</h1>
    <nav>
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="products.php">Sản phẩm</a></li>
            <li><a href="cart.php">Giỏ hàng</a></li>
            <li><a href="contact.php">Liên hệ</a></li>
            <li><a href="login.php">Đăng nhập</a></li> <!-- Thêm liên kết Đăng nhập -->
            <li><a href="register.php">Đăng ký</a></li> <!-- Thêm liên kết Đăng ký -->
        </ul>
    </nav>
</header>

<!-- Main Content -->
<main>
    <h2>Liên hệ</h2>
    <p>Để liên hệ với chúng tôi, vui lòng gửi email đến:
        <a href="mailto:hiepnx@gmail.com">
            <i class="far fa-envelope">
            </i>hiepnx03@gmail.com</a>
    </p>
    <p>facebook:
        <a href="https://www.facebook.com/ga.vit123">
            <i class="fab fa-facebook">
            </i>Nguyễn Xuân Hiệp</a>
    </p>

    <!-- Thêm biểu mẫu liên hệ hoặc thông tin liên hệ khác ở đây -->
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>

<style>
    /* CSS cho biểu tượng Facebook và Gmail */
    .fab, .far {
        font-size: 24px; /* Kích thước của biểu tượng */
        margin-right: 8px; /* Khoảng cách giữa biểu tượng và văn bản */
        transition: color 0.3s; /* Hiệu ứng chuyển đổi màu sắc trong 0.3 giây */
    }

    /* CSS cho hiệu ứng hover */
    .fab:hover {
        color: #1877f2; /* Màu sắc khi di chuột qua biểu tượng Facebook */
    }

    .far:hover {
        color: #ff0000; /* Màu sắc khi di chuột qua biểu tượng Gmail */
    }
</style>
