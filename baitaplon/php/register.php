<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Các dữ liệu khác từ biểu mẫu
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $phone = $_POST["sodienthoai"];
    $gender = $_POST["gioitinh"];
    $nationality = $_POST["quoctich"];
    $address = $_POST["diachi"];
    $access_level = $_POST["mucdotruycap"];

    // Avatar
    $hinhanh = ""; // Khởi tạo tên file rỗng

    if (isset($_FILES['uploadfile'])) {
        $file_name = $_FILES['uploadfile']['name'];
        $file_tmp = $_FILES['uploadfile']['tmp_name'];

        // Thư mục lưu trữ file ảnh
        $target_dir = "images/";
        // Đường dẫn hoàn chỉnh của file ảnh sẽ lưu
        $target_file = $target_dir . basename($file_name);

        // Di chuyển file tạm sang thư mục lưu trữ
        if (move_uploaded_file($file_tmp, $target_file)) {
            $hinhanh = $file_name; // Gán tên file vào biến $hinhanh
            echo "Upload ảnh thành công.";
        } else {
            echo "Không thể upload ảnh.";
        }
    }

    // Tạo truy vấn SQL để thêm thông tin người dùng mới vào cơ sở dữ liệu
    $sql = "INSERT INTO `User` (`fullname`, `email`, `username`, `password`, `phone`, `gender`, `nationality`, `address`, `access_level`, `avatar`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bảo vệ truy vấn để tránh SQL injection
    $stmt->bind_param("ssssssssss", $fullname, $email, $username, $password, $phone, $gender, $nationality, $address, $access_level, $hinhanh);

    // Thực thi truy vấn và kiểm tra kết quả
    if ($stmt->execute()) {
        echo "Đăng ký thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang đăng ký -->
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
    <link rel="stylesheet" href="/ULSA/baitaplon/css/loginandregister.css">
</head>
<body>
<!-- Header -->
<header>
    <h1>Thời trang trẻ em</h1>
    <nav>
        <ul>
            <li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>
            <li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>
            <li><a href="/ULSA/baitaplon/php/register.php" class="active">Đăng ký</a></li>

        </ul>
    </nav>
</header>

<!-- Main Content -->
<main>
    <h2>Đăng ký</h2>
    <form action="/ULSA/baitaplon/php/register.php" method="POST" enctype="multipart/form-data">
        <label for="fullname">Fullname</label>
        <input name="fullname" type="text" placeholder="Nhập đầy đủ họ tên"/>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required placeholder="Nhập Email">

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required placeholder="Nhập tên đăng nhập">

        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">

        <label for="sodienthoai">Phone</label>
        <input name="sodienthoai" type="text" placeholder="Nhập số điện thoại"/>

        <label for="gioitinh">Giới tính</label>
        <input type="radio" name="gioitinh" value="Nam"/>Nam
        <input type="radio" name="gioitinh" value="Nữ" checked="checked"/>Nữ

        <label for="quoctich">Quốc tịch</label>
        <select name="quoctich">
            <option value="Mỹ">Mỹ</option>
            <option value="Việt Nam" selected="selected">Việt Nam</option>
            <option value="Hàn Quốc">Hàn Quốc</option>
        </select>

        <label for="diachi">Address</label>
        <textarea name="diachi" placeholder="Nhập địa chỉ" cols="50" rows="5"></textarea>

        <label for="avatar">Avatar</label>
        <?php
        if (isset($_FILES['uploadfile'])) {
            $file_name = $_FILES['uploadfile']['name'];
            $file_tmp = $_FILES['uploadfile']['tmp_name'];
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "images/" . $file_name);
                echo " Up load thành công";
            } else {
                echo "upload không thành công";
            }
        } ?>
        <input type="file" name="uploadfile"/>

        <label for="mucdotruycap">Mức độ truy cập</label>
        <select name="mucdotruycap">
            <option value="Quantri">Quản trị người dùng</option>
            <option value="Nguoidung" selected="selected">Người dùng</option>
        </select>

        <button type="submit" name="register">Đăng ký</button>
    </form>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>


<style>
    /* CSS cho trang đăng ký */

    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    header h1 {
        margin: 0;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    main {
        max-width: 400px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
    }

    form {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 95%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #555;
    }

    footer {
        text-align: center;
        background-color: #333;
        color: #fff;
        padding: 10px 0;
    }

</style>