<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

// Tạo kết nối đến cơ sở dữ liệu
$db = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$db) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
}
?>
