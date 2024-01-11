<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
?>