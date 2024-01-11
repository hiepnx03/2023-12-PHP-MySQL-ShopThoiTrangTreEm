<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Thêm Tin Tức</title>
    <!-- Bổ sung CSS, các thẻ style, hoặc các tập tin CSS khác nếu cần -->
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
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php"class="active">Chỉnh Sửa Web</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                } else {
                    // Người dùng thông thường
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/addtocart.php">Giỏ hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/feedback.php">Góp ý</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                }
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                // Chưa đăng nhập
                echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<!-- Phần header và các thẻ HTML khác -->

<!-- Một phần trong trang chính của bạn -->
<div class="main">
    <?php
    // Kết nối cơ sở dữ liệu
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "webthoitrang";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Truy vấn thông tin liên hệ
    $sql = "SELECT * FROM ThongTinLienHe";
    $result = $conn->query($sql);

    // Hiển thị thông tin liên hệ
    if ($result->num_rows > 0) {
        // Duyệt qua từng hàng kết quả
        while ($row = $result->fetch_assoc()) {
            echo "<h2>Thông tin liên hệ</h2>";
            echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
            if (isset($row["so_dien_thoai"])) {
                echo "<p><strong>Số điện thoại:</strong> " . $row["so_dien_thoai"] . "</p>";
            } else {
                echo "<p>Số điện thoại không có sẵn.</p>";
            }
            echo "<p><strong>Địa chỉ:</strong> " . $row["dia_chi"] . "</p>";
            echo "<p><strong>Nội dung:</strong> " . $row["noi_dung"] . "</p>";
            // Hiển thị các trường thông tin liên hệ khác tương tự
        }
    } else {
        echo "Không có thông tin liên hệ.";
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
    ?>
    <a href="/ULSA/baitaplon/php/update_contact.php" class="edit-button">Chỉnh sửa thông tin liên hệ</a>

</div>

</body>
</html>

<style>
    .edit-button {
        display: inline-block;
        padding: 8px 16px;
        background-color: #337ab7;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }

    .edit-button:hover {
        background-color: #23527c;
    }
</style>