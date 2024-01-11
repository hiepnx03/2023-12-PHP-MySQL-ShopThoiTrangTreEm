<?php
session_start();
// Kiểm tra nếu form được gửi đi (nút submit được nhấn)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "webthoitrang";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form
    $feedback_content = $_POST['feedback_content'];
    $sender_name = $_POST['sender_name'];

    // Chuẩn bị truy vấn để chèn phản hồi vào cơ sở dữ liệu
    $sql = "INSERT INTO `feedback` (`noi_dung`, `nguoi_gui`, `ngay_gui`) VALUES ('$feedback_content', '$sender_name', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Phản hồi của bạn đã được gửi đi thành công!";
    } else {
        echo "Lỗi khi gửi phản hồi: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ý kiến góp ý</title>
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
                    echo '<li><a href="/ULSA/baitaplon/php/addtocart.php">Giỏ hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/feedback.php" class="active">Góp ý</a></li>';
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
        <h2 style="text-align: center">Ý kiến góp ý</h2>
        <?php
        if (isset($_SESSION['feedback_success'])) {
            echo '<p>' . $_SESSION['feedback_success'] . '</p>';
            unset($_SESSION['feedback_success']);
        }
        ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table>
                <tr>
                    <td><label for="user_name">Tên người gửi:</label></td>
                    <td><input type="text" id="user_name" name="sender_name"></td>
                </tr>
                <tr>
                    <td><label for="user_feedback">Nhập ý kiến góp ý:</label></td>
                    <td><textarea id="user_feedback" name="feedback_content" rows="4" cols="50"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Gửi ý kiến"></td>
                </tr>
            </table>
        </form>

    </div>

    <footer class="footer">
    </footer>
</div>
</body>
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</html>



<style>
    /* style.css */

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
    }

    header {
        background-color: #444;
        color: white;
        padding: 20px;
        text-align: center;
    }

    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 10px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
    }

    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    form input[type="text"],
    form input[type="date"],
    form textarea {
        width: calc(100% - 12px);
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form textarea {
        height: 100px;
    }

    form input[type="submit"] {
        padding: 10px 20px;
        background-color: #444;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #333;
    }

</style>