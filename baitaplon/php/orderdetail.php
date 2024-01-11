<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>website bán hàng</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>

<body>
<!-- code header -->
<header class="parallax-header">
    <h1 style="font-size: 100px;">Thời trang trẻ em</h1>
    <nav>
        <ul>
            <li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>
            <li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>
            <li><a href="/ULSA/baitaplon/php/cart.php">Giỏ hàng</a></li>
            <li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>
            <li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>
            <?php
            session_start();
            if (isset($_SESSION["username"])) {
                if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 'Quantri') {
                    echo '<li><a href="/ULSA/baitaplon/php/sell.php">Bán Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/order.php"class="active">Đơn Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/update_news.php">Thêm Tin Tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
                }
                echo '<li><a href="/ULSA/baitaplon/php/feedback.php">Góp ý</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                // Chưa đăng nhập
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<!-- code content -->
<div class="content">
    <?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "webthoitrang";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }
    //chi tiết hàng hóa
    $mahd = isset($_POST["mahd"]) ? $_POST["mahd"] : "";
    $masp = isset($_POST["masp"]) ? $_POST["masp"] : "";
    $tensp = isset($_POST["tensp"]) ? $_POST["tensp"] : "";
    $soluong = isset($_POST["soluong"]) ? $_POST["soluong"] : "";
    $giaxuat = isset($_POST["giaxuat"]) ? $_POST["giaxuat"] : "";
    $khuyenmai = isset($_POST["khuyenmai"]) ? $_POST["khuyenmai"] : "";

    if (isset($_POST["btn_save"])) {
        $sql = "SELECT * FROM oderdetail WHERE mahd ='$mahd'";
        $rel = mysqli_query($conn, $sql);
        if (mysqli_num_rows($rel) > 0) {
            echo "Đã tồn tại mã hóa đơn này";
        } else {
            $sql1 = "INSERT INTO oderdetail VALUE('$mahd','$masp','$tensp', '$soluong', '$giaxuat', '$khuyenmai')";
            $rel1 = mysqli_query($conn, $sql1);
            echo "Bạn đã thêm thành công";
        }
    }
    ?>
    <table>
        <tr>
            <a href="javascript:history.go(-1)" style="color: blue;">Trở lại</a>
            <h2 style="text-align: center">Chi tiết đơn hàng</h2>
            <td>Mã hóa đơn</td>
            <td>Mã sản phẩm</td>
            <td>Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Gia xuất</td>
            <td>Khuyến mãi</td>
            <td>Xóa</td>

        </tr>
        <?php
        $sql2 = "SELECT * FROM oderdetail";
        $rel2 = mysqli_query($conn, $sql2);
        while ($r = mysqli_fetch_assoc($rel2)) {
            //var_dump($r);
            ?>
            <tr>
                <td>
                    <?php echo $r["mahd"]; ?>
                </td>
                <td>
                    <?php echo $r["masp"]; ?>
                </td>
                <td>
                    <?php echo $r["tensp"]; ?>
                </td>
                <td>
                    <?php echo $r["soluong"]; ?>
                </td>
                <td>
                    <?php echo $r["giaxuat"]; ?>
                </td>
                <td>
                    <?php echo $r["khuyenmai"]; ?>
                </td>
                <td>
                    <a href="/ULSA/baitaplon/php/delete_order.php?mahd=<?php echo $r['mahd']; ?>&masp=<?php echo $r['masp']; ?>" style="color: red;">Xóa</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
<footer class="footer">
</footer>
</body>
</html>

<style>
    /* Reset các thuộc tính mặc định của các phần tử */
    body, h1, h2, h3, h4, h5, h6, p, ul, li {
        margin: 0;
        padding: 0;
    }

    /* Đặt phông chữ và màu nền cho body */
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f8f8; /* Màu nền xám nhạt */
        color: #333; /* Màu chữ xám đậm */
        line-height: 1.6; /* Chiều cao dòng để đọc dễ dàng hơn */
    }

    /* Style cho header */
    .parallax-header {
        background-image: url('your-header-image.jpg'); /* Thay 'your-header-image.jpg' bằng đường dẫn thực tế của bạn */
        background-size: cover; /* Scale hình nền */
        color: #fff; /* Màu chữ cho header */
        padding: 50px;
        text-align: center;
    }

    /* Style cho navigation */
    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 15px;
    }

    nav ul li a {
        color: #fff; /* Màu chữ cho link */
        text-decoration: none;
    }

    /* Style cho nội dung chính */
    .content {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff; /* Màu nền trắng */
    }

    /* Style cho bảng */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    /* Style cho footer */
    footer {
        text-align: center;
        padding: 10px;
        background-color: #333; /* Màu nền đậm cho footer */
        color: #fff; /* Màu chữ cho footer */
        position: fixed;
        bottom: 0;
        width: 100%;
    }

</style>