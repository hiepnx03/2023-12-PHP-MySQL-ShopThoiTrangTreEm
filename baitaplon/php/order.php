<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>website bán hàng</title>
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
                session_start();
                if (isset($_SESSION["username"])) {
                    // Người dùng đã đăng nhập
                    if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 'Quantri') {
                        // Quản trị viên
                        echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/sell.php">Bán Hàng</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/order.php" class="active">Đơn Hàng</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/viewuser.php">Quản Lý Khách Hàng</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/view_feedback.php">Góp Ý Khách Hàng</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/quanlynews.php">Quản Lý Tin Tức</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                    } else {
                        // Người dùng thông thường
                        echo '<li><a href="/ULSA/baitaplon/php/welcome.php" >Trang chủ</a></li>';
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
            <?php
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname = "webthoitrang";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
            }
            if (isset($_GET["delete_id"])) {
                $delete_id = $_GET["delete_id"];

                // Xóa đơn hàng từ cơ sở dữ liệu
                $sql_delete = "DELETE FROM `order` WHERE ma_hoadon = '$delete_id'";
                $result_delete = mysqli_query($conn, $sql_delete);

                if ($result_delete) {
                    echo "Đã xóa đơn hàng thành công.";
                } else {
                    echo "Xóa đơn hàng không thành công.";
                }

                // Sau khi xóa, chuyển hướng trở lại trang danh sách đơn hàng
                header('Location: /ULSA/baitaplon/php/order.php');
                exit();
            }
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $sql = "UPDATE `order` SET `trangthai`='1' WHERE ma_hoadon = '$id'";
                $result = mysqli_query($conn, $sql);
                echo "update thanh cong";
                header('Location: /ULSA/baitaplon/php/order.php');
            }
            else {
            $sql = "SELECT * FROM `order`";
            $rel = mysqli_query($conn, $sql);
            $res = mysqli_fetch_all($rel, MYSQLI_ASSOC);
            ?>
            <div class="container">
                <h1 style="color: black">Danh sách đơn hàng</h1>
                <table class="table">
                    <tr>
                        <td width="100px">Mã hóa đơn</td>
                        <td width="200px">Mã khách hàng</td>
                        <td width="200px">Tên khách hàng</td>
                        <td width="100px">Tổng tiền</td>
                        <td width="200px">Ngày</td>
                        <td width="200px">Trạng thái</td>
                        <td width="200px">Hành Động</td>
                        <td width="200px">Xem Chi Tiết</td>
                        <td width="200px">Xóa</td>

                    </tr>
                    <?php
                    for ($i = 0; $i < count($res); $i++) {
                        ?>
                        <tr>
                            <td><?= $res[$i]['ma_hoadon'] ?></td>
                            <td><?= $res[$i]['ma_khachhang'] ?></td>
                            <td><?= $res[$i]['tenkhachhang'] ?></td>
                            <td><?= $res[$i]['tongtien'] ?></td>
                            <td><?= $res[$i]['createdate'] ?></td>
                            <td><?php echo $res[$i]["trangthai"] == '0' ? "Chưa hoàn thành" : "Hoàn thành" ?></td>
                            <td>
                                <button><a href="?id=<?php echo $res[$i]['ma_hoadon'] ?>" style="color:blue">Hoàn thành</a>
                                </button>
                            </td>
                            <td>
                                <button><a href="orderdetail.php" style="color:blue">Chi tiết</a></button>
                            </td>
                            <td>
                                <button><a href="?delete_id=<?php echo $res[$i]['ma_hoadon'] ?>" style="color:red">Xóa</a></button>
                            </td>
                        </tr>
                        <?php
                    }
                    }
                    ?>
                </table>
            </div>
        </div>
        <footer class="footer">
        </footer>
    </body>
</html>

<style>
    /* Reset default margin and padding for elements */
    body, h1, h2, h3, h4, h5, h6, p, ul, li {
        margin: 0;
        padding: 0;
    }

    /* Set a background color and font styles for the body */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0; /* Light gray background */
        color: #333; /* Dark gray text color */
        line-height: 1.6; /* Line height for better readability */
    }

    /* Header styles */
    .parallax-header {
        background-image: url('your-header-image.jpg'); /* Replace 'your-header-image.jpg' with your actual image path */
        background-size: cover; /* Scale the background image */
        color: #fff; /* Header text color */
        padding: 50px;
        text-align: center;
    }

    /* Navigation styles */
    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 15px;
    }

    nav ul li a {
        color: #fff; /* Link color */
        text-decoration: none;
    }

    /* Main content container */
    .main {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff; /* White background */
    }

    /* Table styles */
    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    /* Footer styles */
    .footer {
        text-align: center;
        background-color: #333; /* Dark background for footer */
        color: #fff; /* Footer text color */
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
