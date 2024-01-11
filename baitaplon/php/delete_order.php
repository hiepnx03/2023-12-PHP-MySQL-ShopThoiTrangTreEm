<?php
// Kết nối đến cơ sở dữ liệu
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Lấy mã hóa đơn và mã sản phẩm từ tham số trên URL
$mahd = isset($_GET["mahd"]) ? $_GET["mahd"] : "";
$masp = isset($_GET["masp"]) ? $_GET["masp"] : "";

// Xóa dữ liệu từ cơ sở dữ liệu
$sql = "DELETE FROM oderdetail WHERE mahd = '$mahd' AND masp = '$masp'";
if ($conn->query($sql) === TRUE) {
    echo "Đã xóa thành công!";
    header('location: orderdetail.php');
} else {
    echo "Lỗi khi xóa: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
