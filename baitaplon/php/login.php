<?php
session_start(); // Bắt đầu phiên làm việc

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('connect.php');
    $username = $_POST["username"];
    $password = $_POST["password"];
    $mucdotruycap = $_POST["mucdotruycap"];

    if ($mucdotruycap == "Quantri") {
        $sql = "SELECT * FROM User WHERE username='$username' AND password='$password' AND access_level='$mucdotruycap'";
        $rel = mysqli_query($conn, $sql);
        if (mysqli_num_rows($rel) > 0) {
            echo "bạn đăng nhập thành công";
            $_SESSION['username'] = $username;
            $access_level = "Quantri";
            $_SESSION['access_level'] = $access_level;
            header("location: welcome.php");
        } else {
            echo "bạn nhập sai thông tin";
        }
    }
    if ($mucdotruycap == "Nguoidung") {
        $sql = "SELECT * FROM User WHERE username='$username' AND password='$password' AND access_level='$mucdotruycap'";
        $rel = mysqli_query($conn, $sql);
        if (mysqli_num_rows($rel) > 0) {
            echo "bạn đăng nhập thành công";
            $_SESSION['username'] = $username;
            header("location: welcome.php");
        } else {
            echo "bạn nhập sai thông tin";
        }
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang đăng nhập (nếu có) -->
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
            <li><a href="/ULSA/baitaplon/php/login.php" class="active">Đăng nhập</a></li>
            <li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>
        </ul>
    </nav>
</header>

<!-- Main Content -->
<main>
    <h2>Đăng nhập</h2>
    <form action="/ULSA/baitaplon/php/login.php" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text1" id="username" name="username" required>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <tr>
            <td>Mức độ truy cập</td>
            <td>
                <select name="mucdotruycap">
                    <option value="Quantri">Quản trị người dùng</option>
                    <option value="Nguoidung" selected="selected">Người dùng</option>
                </select>
            </td>
        </tr>
        <br>
        <br>
        <button type="submit" name="login">Đăng nhập</button>
        <a href="/ULSA/baitaplon/php/reset_password.php">Quên mật khẩu?</a>
    </form>
</main>
<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>


<style>
    input[type="text1"],
    input[type="password"] {
        width: 95%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }
</style>