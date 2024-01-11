<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang chủ -->
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
    <?php
    // Display the welcome message with the username
    if (isset($_SESSION['username'])) {
        echo '<h2>Chào mừng bạn ' . $_SESSION['username'] . ' đến với cửa hàng thời trang trẻ em!</h2>';
    }
    ?>
    <p>Bạn đang tìm kiếm những chiếc áo thời trang đẹp cho con của mình? Hãy khám phá bộ sưu tập sản phẩm đa dạng của chúng tôi!</p>
    <p>Tại Thời trang trẻ em, chúng tôi cam kết mang đến cho bạn những lựa chọn thời trang phong cách và chất lượng cho bé yêu của bạn.</p>
    <p>Hãy trải nghiệm mua sắm trực tuyến dễ dàng và tiện lợi với chúng tôi. Xem sản phẩm <a href="products.php">tại đây</a> và đặt hàng ngay hôm nay!</p>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>
