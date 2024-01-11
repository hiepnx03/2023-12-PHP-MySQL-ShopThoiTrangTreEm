<?php
// Kết nối đến cơ sở dữ liệu và session
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $tieu_de = $_POST['tieu_de'];
    $noi_dung = $_POST['noi_dung'];
    $ngay_dang = $_POST['ngay_dang'];
    $hang_san_xuat = $_POST['hang_san_xuat'];
    $model = $_POST['model'];
    $mo_ta = $_POST['mo_ta'];
    $gia = $_POST['gia'];
    $ngay_ra_mat = $_POST['ngay_ra_mat'];

    $sql = "UPDATE tin_tuc SET tieu_de='$tieu_de', noi_dung='$noi_dung', ngay_dang='$ngay_dang', hang_san_xuat='$hang_san_xuat', 
            model='$model', mo_ta='$mo_ta', gia='$gia', ngay_ra_mat='$ngay_ra_mat' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật tin tức thành công!";
        header('location: quanlynews.php');
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tin_tuc WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Không tìm thấy tin tức.";
        exit();
    }
} else {
    echo "ID tin tức không được cung cấp.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chỉnh sửa Tin Tức</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<header class="parallax-header">
    <h1 style="font-size: 100px;">Thời trang trẻ em</h1>
    <!-- Navbar -->
    <!-- ... -->
</header>

<h1>Chỉnh Sửa Tin Tức</h1>

<div class="edit-news-form">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="tieu_de">Tiêu đề:</label><br>
        <input type="text" id="tieu_de" name="tieu_de" value="<?php echo $row['tieu_de']; ?>" required><br><br>

        <label for="noi_dung">Nội dung:</label><br>
        <textarea id="noi_dung" name="noi_dung" rows="4" cols="50" required><?php echo $row['noi_dung']; ?></textarea><br><br>

        <label for="ngay_dang">Ngày đăng:</label><br>
        <input type="date" id="ngay_dang" name="ngay_dang" value="<?php echo $row['ngay_dang']; ?>"><br><br>

        <label for="hang_san_xuat">Hãng sản xuất:</label><br>
        <input type="text" id="hang_san_xuat" name="hang_san_xuat" value="<?php echo $row['hang_san_xuat']; ?>"><br><br>

        <label for="model">Model:</label><br>
        <input type="text" id="model" name="model" value="<?php echo $row['model']; ?>"><br><br>

        <label for="mo_ta">Mô tả:</label><br>
        <textarea id="mo_ta" name="mo_ta" rows="4" cols="50"><?php echo $row['mo_ta']; ?></textarea><br><br>

        <label for="gia">Giá:</label><br>
        <input type="text" id="gia" name="gia" value="<?php echo $row['gia']; ?>"><br><br>

        <label for="ngay_ra_mat">Ngày ra mắt:</label><br>
        <input type="date" id="ngay_ra_mat" name="ngay_ra_mat" value="<?php echo $row['ngay_ra_mat']; ?>"><br><br>

        <!-- Thêm các trường thông tin cần chỉnh sửa -->

        <input type="submit" name="submit" value="Cập Nhật">
        <a href="/ULSA/baitaplon/php/quanlynews.php">Trở về</a>
    </form>
</div>
</body>
</html>

<style>
    /* CSS cho form chỉnh sửa tin tức */
    .edit-news-form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .edit-news-form label {
        font-weight: bold;
    }

    .edit-news-form input[type="text"],
    .edit-news-form input[type="date"],
    .edit-news-form textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .edit-news-form input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    .edit-news-form input[type="submit"]:hover {
        background-color: #45a049;
    }

    .edit-news-form a {
        display: block;
        margin-top: 10px;
        text-decoration: none;
        color: #333;
    }

    .edit-news-form a:hover {
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
