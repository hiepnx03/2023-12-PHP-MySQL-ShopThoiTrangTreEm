<?php
session_start();
require_once("connect.php");

$sql = "SELECT * FROM feedback";
$result = mysqli_query($conn, $sql);

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM feedback WHERE feedback_id = $delete_id";
    if (mysqli_query($conn, $delete_sql)) {
        echo '<script>alert("Xóa ý kiến góp ý thành công!");</script>';
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo '<script>alert("Lỗi khi xóa ý kiến góp ý: ' . mysqli_error($conn) . '");</script>';
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Xem ý kiến góp ý</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
    <style>
        /* Thêm CSS cho bảng */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
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
                    echo '<li><a href="/ULSA/baitaplon/php/view_feedback.php" class="active">Góp Ý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/quanlynews.php">Quản Lý Tin Tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
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
<div class="main">
    <div class="feedback-section">
        <h2>Danh sách ý kiến góp ý</h2>
        <?php
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            echo '<tr>';
            echo '<th>Nội dung</th>';
            echo '<th>Người gửi</th>';
            echo '<th>Ngày gửi</th>';
            echo '<th>Xóa</th>';
            echo '</tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['noi_dung'] . '</td>';
                echo '<td>' . $row['nguoi_gui'] . '</td>';
                echo '<td>' . $row['ngay_gui'] . '</td>';
                echo '<td><form method="post" action="' . $_SERVER["PHP_SELF"] . '"><input type="hidden" name="delete_id" value="' . $row['feedback_id'] . '"><input type="submit" name="delete" value="Xóa"></form></td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>Không có ý kiến góp ý được lưu trữ.</p>';
        }
        ?>
    </div>
    <footer class="footer">
    </footer>
</div>
</body>
</html>
