<?php
// Thực hiện kết nối đến cơ sở dữ liệu
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy ID người dùng cần xóa từ tham số truyền vào
$user_id = $_GET["id"];

// Xây dựng truy vấn xóa người dùng
$sql = "DELETE FROM `user` WHERE `id` = $user_id";

// Thực hiện truy vấn xóa người dùng
if ($conn->query($sql) === TRUE) {
    echo "Người dùng đã được xóa thành công.";
    header("Location: /ULSA/baitaplon/php/viewuser.php");
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
