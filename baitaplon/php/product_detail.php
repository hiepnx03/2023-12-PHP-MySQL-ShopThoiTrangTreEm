
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<header class="parallax-header">
    <h1 style="font-size: 100px;">Thời trang trẻ em</h1>
    <nav>
        <ul>
            <!--            <li><a href="/ULSA/baitaplon/php/welcome.php" class="active">Trang chủ</a></li>-->
            <!--            <li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>-->
            <!--            <li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>-->
            <!--            <li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>-->
            <?php
            session_start();
            if (isset($_SESSION["username"])) {
                // Người dùng đã đăng nhập
                if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 'Quantri') {
                    // Quản trị viên
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php"Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/sell.php">Bán Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/order.php">Đơn Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/viewuser.php">Quản Lý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/view_feedback.php">Góp Ý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/quanlynews.php">Quản Lý Tin Tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                } else {
                    // Người dùng thông thường
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/products.php" class="active">Sản phẩm</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/addtocart.php">Giỏ hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/feedback.php">Góp ý</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                }
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                // Chưa đăng nhập
                echo '<li><a href="/ULSA/baitaplon/php/welcome.php" >Trang chủ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<header>
    <h1>Thông tin sản phẩm</h1>
</header>
<div class="container">
    <?php
    require_once("connect.php"); // Kết nối đến cơ sở dữ liệu

    if (isset($_GET['id'])) {
        $product_id = $_GET['id']; // Lấy mã sản phẩm từ URL

        // Truy vấn cơ sở dữ liệu để lấy thông tin chi tiết của sản phẩm
        $query = "SELECT * FROM adproduct WHERE ma_sp = '$product_id'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            // Hiển thị thông tin chi tiết của sản phẩm
            echo "<h2>Thông tin chi tiết sản phẩm:</h2>";
            echo "<p>Mã sản phẩm: {$product['ma_sp']}</p>";
            echo "<p>Tên sản phẩm: {$product['tensp']}</p>";
            echo "<p>Hình ảnh: <img src='images/{$product['hinhanh']}' alt='{$product['tensp']}' /></p>";
//            echo "<p>Giá nhập: {$product['gianhap']}</p>";
            echo "<p>Giá xuất: {$product['giaxuat']}</p>";
            echo "<p>Khuyến mãi: {$product['khuyenmai']}</p>";
            echo "<p>Số lượng: {$product['soluong']}</p>";
            echo "<p>Mô tả sản phẩm: {$product['mota_sp']}</p>";
            echo "<p>Ngày tạo: {$product['create_date']}</p>";
        } else {
            echo "Không tìm thấy thông tin chi tiết sản phẩm.";
        }
    } else {
        echo "Mã sản phẩm không hợp lệ.";
    }
    ?>
    <!-- Nút "Trở về" -->

    <a href="products.php" class="back-button">Trở về</a>

</div>
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>


<style>
    /* styles.css */

    /* CSS cho header */
    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    header h1 {
        margin: 0;
        font-size: 40px;
    }

    /* CSS cho nút "Trở về" */
    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #f44336;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #d32f2f;
    }

    /* CSS cho phần container chứa nội dung chi tiết */
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    /* CSS cho footer */
    footer {
        text-align: center;
        padding: 10px 0;
        background-color: #333;
        color: #fff;
    }

</style>