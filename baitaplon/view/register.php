<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang đăng ký (nếu có) -->
    <link rel="stylesheet" href="/baitaplon/css/style.css">
    <link rel="stylesheet" href="/baitaplon/css/loginandregister.css">

</head>
<body>
<!-- Header -->
<header>
    <h1>Thời trang trẻ em</h1>
    <nav>
        <ul>
            <li><a href="index.php">Trang chủ</a></li>
            <li><a href="login.php">Đăng nhập</a></li>
        </ul>
    </nav>
</header>

<!-- Main Content -->
<main>
    <h2>Đăng ký tài khoản</h2>
    <form action="/baitaplon/php/process-registration.php" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="confirm_password">Xác nhận mật khẩu:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <br>
        <button type="submit">Đăng ký</button>
    </form>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>

