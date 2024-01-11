<?php
// Bắt đầu session và kết nối đến cơ sở dữ liệu
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
    // Xử lý thông tin gửi từ form
    $tieu_de = $_POST['tieu_de'];
    $noi_dung = $_POST['noi_dung'];
    $ngay_dang = date('Y-m-d'); // Ngày đăng sẽ lấy ngày hiện tại
    $hang_san_xuat = $_POST['hang_san_xuat'];
    $model = $_POST['model'];
    $mo_ta = $_POST['mo_ta'];
    $gia = $_POST['gia'];
    $ngay_ra_mat = $_POST['ngay_ra_mat'];

    // Chuẩn bị truy vấn SQL để thêm dữ liệu vào bảng tin_tuc
    $sql = "INSERT INTO tin_tuc (tieu_de, noi_dung, ngay_dang, hang_san_xuat, model, mo_ta, gia, ngay_ra_mat) 
        VALUES ('$tieu_de', '$noi_dung', '$ngay_dang', '$hang_san_xuat', '$model', '$mo_ta', '$gia', '$ngay_ra_mat')";


    if ($conn->query($sql) === TRUE) {
        echo "Thêm tin tức thành công!";
        header('location: quanlynews.php');
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm Tin Tức</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<header class="parallax-header">
    <h1 style="font-size: 100px;">Thời trang trẻ em</h1>
    <!-- Navbar -->
    <!-- ... -->
</header>

<h1>Thêm Tin Tức Mới</h1>

<div class="add-news-form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="tieu_de">Tiêu đề:</label><br>
        <input type="text" id="tieu_de" name="tieu_de" required><br><br>

        <label for="noi_dung">Nội dung:</label><br>
        <textarea id="noi_dung" name="noi_dung" rows="4" cols="50" required></textarea><br><br>

        <label for="hang_san_xuat">Hãng sản xuất:</label><br>
        <input type="text" id="hang_san_xuat" name="hang_san_xuat"><br><br>

        <label for="model">Model:</label><br>
        <input type="text" id="model" name="model"><br><br>

        <label for="mo_ta">Mô tả:</label><br>
        <textarea id="mo_ta" name="mo_ta" rows="4" cols="50"></textarea><br><br>

        <label for="gia">Giá:</label><br>
        <input type="text" id="gia" name="gia"><br><br>

        <label for="ngay_ra_mat">Ngày ra mắt:</label><br>
        <input type="date" id="ngay_ra_mat" name="ngay_ra_mat"><br><br>

        <input type="submit" value="Thêm Tin Tức">
        <a href="/ULSA/baitaplon/php/quanlynews.php">Trở về</a>
    </form>
</div>
</body>
</html>

<style>
    /* CSS cho form thêm tin tức */
    .add-news-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .add-news-form label {
        font-weight: bold;
    }

    .add-news-form input[type="text"],
    .add-news-form input[type="date"],
    .add-news-form textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .add-news-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .add-news-form input[type="submit"]:hover {
        background-color: #45a049;
    }

    .add-news-form a {
        display: block;
        margin-top: 10px;
        text-decoration: none;
        color: #333;
    }

    .add-news-form a:hover {
        text-decoration: underline;
    }

    /* CSS cho header và phần còn lại của trang web */
    .parallax-header {
        background-image: url('path_to_your_image.jpg');
        background-size: cover;
        text-align: center;
        color: #fff;
        padding: 100px 0;
    }

    h1 {
        text-align: center;
    }

    /* Các đoạn CSS khác để tùy chỉnh giao diện tổng thể của trang web */
    /* ... */

</style>
