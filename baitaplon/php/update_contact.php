<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["username"])) {
    // Nếu chưa đăng nhập, bạn có thể điều hướng người dùng đến trang đăng nhập hoặc hiển thị thông báo
    header("Location: /ULSA/baitaplon/php/login.php");
    exit();
}

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
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

    // Lấy thông tin từ form
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $content = $_POST['content'];

    // Cập nhật thông tin liên hệ vào cơ sở dữ liệu
    $sql = "UPDATE ThongTinLienHe SET so_dien_thoai='$phone', dia_chi='$address', noi_dung='$content' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thông tin liên hệ thành công";
    } else {
        echo "Lỗi khi cập nhật thông tin liên hệ: " . $conn->error;
    }

    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cập nhật thông tin liên hệ</title>
    <!-- Bổ sung CSS, các thẻ style, hoặc các tập tin CSS khác nếu cần -->
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>

<div class="main">
    <h2>Cập nhật thông tin liên hệ</h2>
    <form method="post" action="/ULSA/baitaplon/php/update_contact.php">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Số điện thoại:</label>
        <input type="text" id="phone" name="phone"><br><br>

        <label for="address">Địa chỉ:</label>
        <input type="text" id="address" name="address"><br><br>

        <label for="content">Nội dung:</label><br>
        <textarea id="content" name="content" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Cập nhật">
    </form>
</div>

</body>
</html>

<style>
    /* Thiết lập font chữ chung */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Phần header */
    .parallax-header {
        background-image: url('/path/to/your/image.jpg'); /* Thay đổi đường dẫn đến hình ảnh của bạn */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        text-align: center;
        color: #fff;
        padding: 100px 0; /* Điều chỉnh khoảng cách giữa header và nội dung */
    }

    .parallax-header h1 {
        font-size: 100px;
        margin-bottom: 20px; /* Khoảng cách giữa tiêu đề và menu */
    }

    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px; /* Khoảng cách giữa các mục menu */
    }

    nav ul li a {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
    }

    nav ul li a:hover {
        color: #ffcc00; /* Màu khi di chuột qua các mục menu */
    }

    /* Phần main */
    .main {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }

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