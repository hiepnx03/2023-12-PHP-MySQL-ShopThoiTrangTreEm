<?php
session_start();
require_once('connect.php'); // Kết nối đến cơ sở dữ liệu

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); // Điều hướng người dùng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

$username = $_SESSION['username'];

// Truy vấn dữ liệu đơn hàng
$sql = "SELECT * FROM `order` WHERE ma_khachhang = '$username'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Tiêu đề và các thẻ meta -->
    <title>Danh sách đơn hàng đã đặt</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<header class="parallax-header">
    <h1 style="font-size: 100px;">Thời trang trẻ em</h1>
    <nav>
        <ul>
            <!--            <li><a href="/ULSA/baitaplon/php/welcome.php" class="active">Trang chủ</a></li>-->
            <!--            <li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>-->
            <!--            <li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>-->
            <!--            <li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>-->
            <?php
            if (isset($_SESSION["username"])) {
                // Người dùng đã đăng nhập
                if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 'Quantri') {
                    // Quản trị viên
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/sell.php">Bán Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/order.php">Đơn Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/viewuser.php">Quản Lý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/view_feedback.php">Góp Ý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/quanlynews.php">Quản Lý Tin Tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                } else {
                    // Người dùng thông thường
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/addtocart.php" >Giỏ Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/view_orders.php"class="active" >Đơn Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/feedback.php">Góp ý</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                }
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                // Chưa đăng nhập
                echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/products.php" class="active">Sản phẩm</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<h1>Danh sách đơn hàng đã đặt</h1>
<table border="1">
    <tr>
        <th>Mã đơn hàng</th>
        <th>Tổng tiền</th>
        <th>Ngày đặt hàng</th>
        <!-- Thêm các cột thông tin khác tại đây nếu cần -->
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ma_hoadon'] . "</td>";
            echo "<td>" . $row['tongtien'] . "</td>";
            echo "<td>" . $row['createdate'] . "</td>";
            // Hiển thị thông tin khác của đơn hàng ở đây nếu có
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Không có đơn hàng nào.</td></tr>";
    }
    ?>
</table>
</body>
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</html>
