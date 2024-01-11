<?php
// Khởi động session
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION["username"])) {
    // Xóa tất cả các biến session
    session_unset();

    // Hủy session
    session_destroy();
}

// Chuyển hướng đến trang đăng nhập sau khi đăng xuất
header("Location: /ULSA/baitaplon/php/login.php");
exit();
?>
