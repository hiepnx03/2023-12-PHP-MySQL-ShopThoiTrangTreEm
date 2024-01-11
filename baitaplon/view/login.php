<?php
session_start();
if (isset($_POST['login'])) {
    $txt_username = $_REQUEST['username'];
    $txt_password = $_REQUEST['password'];
    if ($txt_username === "admin" && $txt_password === "123456789Â!") {
        $_SESSION['username'] = $txt_username;
        header('Location: index.php');
        exit();
    } else {
        $error_message = "Sai tên đăng nhập hoặc mật khẩu. Vui lòng thử lại.";
    }
}

// Check if the user is already logged in and redirect to index.php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang đăng nhập (nếu có) -->
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
            <li><a href="register.php">Đăng ký</a></li>
        </ul>
    </nav>
</header>

<!-- Main Content -->
<main>
    <h2>Đăng nhập</h2>
    <form action="login.php" method="POST">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit" name="login">Đăng nhập</button>
    </form>


</main>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>

</footer>
</body>
</html>

<style>
    /* CSS cho trang đăng nhập và đăng ký */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
    }

    header h1 {
        margin: 0;
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
        text-decoration: none;
        color: #fff;
    }

    main {
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        width: 80%;
        max-width: 400px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    main h2 {
        text-align: center;
        margin-top: 0;
    }

    form {
        text-align: center;
    }

    form label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    form input[type="text"],
    form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    form button {
        background-color: #333;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #555;
    }

    footer {
        text-align: center;
        background-color: #333;
        color: #fff;
        padding: 10px 0;
    }

    /* Đổi màu liên kết "Liên hệ" và "Đăng ký" thành màu xanh dương */
    .footer-center a {
        color: #1877f2;
    }

    /* Đổi màu liên kết "Đăng nhập" và "Đăng ký" trong header thành màu xanh dương */
    nav ul li a {
        color: #1877f2;
    }
</style>


