<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Xây dựng câu truy vấn xóa tin tức dựa trên ID
    $sql = "DELETE FROM `tin_tuc` WHERE `id` = $news_id";

    // Thực thi câu truy vấn xóa
    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, chuyển hướng về trang quản lý tin tức
        header('Location: quanlynews.php');
        exit(); // Đảm bảo không có mã HTML hoặc các lệnh khác được thực thi sau khi chuyển hướng
    } else {
        echo "Lỗi khi xóa tin tức: " . $conn->error;
    }
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
