<?php
session_start();
// Kết nối đến cơ sở dữ liệu
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

// Kiểm tra nếu có tham số 'id' trong URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin chi tiết của sản phẩm
    $query = "SELECT * FROM Product WHERE id = $product_id";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit();
    }
} else {
    echo "Thiếu tham số 'id' trong URL.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi tiết Sản phẩm</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<header>
    <h1 style="color: white">Chi tiết Sản phẩm</h1>
    <nav>
        <ul>
            <li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>
            <li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>
            <li><a href="/ULSA/baitaplon/php/cart.php">Giỏ hàng</a></li>
            <li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>
            <?php
            if (isset($_SESSION["username"])) {
                echo '<li><a href="/ULSA/baitaplon/php/sell.php" >Bán Hàng</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<!-- Hiển thị thông tin chi tiết của sản phẩm -->
<div class="product-details">
    <h2><?php echo $product['title']; ?></h2>
    <img src="<?php echo $product['thumbnail']; ?>" alt="<?php echo $product['title']; ?>" width="300" height="300">
    <p>Mô tả: <?php echo $product['description']; ?></p>
    <p>Giá: <?php echo $product['price']; ?> VNĐ</p>
</div>
</body>
</html>
