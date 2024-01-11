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

// Xử lý khi người dùng gửi biểu mẫu để thêm sản phẩm
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // Xử lý tải lên ảnh
    $target_dir = "/ULSA/baitaplon/images/uploads/"; // Thư mục để lưu trữ ảnh
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là hình ảnh hợp lệ
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $target_file)) {
            // Ảnh đã được tải lên thành công, tiếp tục lưu thông tin sản phẩm vào cơ sở dữ liệu
            $query = "INSERT INTO Product (title, description, price, thumbnail) VALUES ('$product_name', '$product_description', $product_price, '$target_file')";
            $result = mysqli_query($db, $query);

            if ($result) {
                echo "Sản phẩm đã được thêm thành công.";
            } else {
                echo "Lỗi: " . mysqli_error($db);
            }
        } else {
            echo "Lỗi khi tải lên ảnh.";
        }
    } else {
        echo "Tệp không phải là hình ảnh hợp lệ.";
    }
}

// Lấy danh sách các sản phẩm từ cơ sở dữ liệu
$query = "SELECT * FROM Product";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý Sản phẩm</title>
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
            if (isset($_SESSION["username"])) {
                // Người dùng đã đăng nhập
                if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 'Quantri') {
                    // Quản trị viên
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/sell.php" class="active">Bán Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/order.php">Đơn Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/viewuser.php">Quản Lý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/view_feedback.php">Góp Ý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/quanlynews.php">Quản Lý Tin Tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                } else {
                    // Người dùng thông thường
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php" >Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/addtocart.php">Giỏ hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/feedback.php">Góp ý</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                }
                echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';
            } else {
                // Chưa đăng nhập
                echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
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

<!-- Biểu mẫu để thêm sản phẩm -->
<div class="admin_col1" style="text-align:center";>
    <div class="admin_col1_left" >
        <a href="sell.php?action=adproducttype">Quản lý danh mục loại sản phẩm   </a>
    </div>
    <div class="admin_col1_left">
        <a href="sell.php?action=adproduct">Quản lý danh sách sản phẩm  </a>
    </div>
    <div class="admin_col1_left">
        <a href="sell.php?action=customer">Quản lý thông tin khách hàng</a>
    </div>
</div>
<div class="admin_col2">
    <!--Nội dung-->
    <?php
    if (isset($_GET["action"])) {
        $action = $_GET["action"];
        switch ($action) {
            case 'adproducttype':
                require_once('adproducttype.php');
                break;
            case 'adproduct':
                require_once('adproduct.php');
                break;
            case 'themsp':
                require_once('themsp.php');
                break;
            case 'customer': // Changed this line
                require_once('customer.php');
                break;
            default:
                echo "";
                break;
        }
    }
    ?>
</div>
<!-- Danh sách các sản phẩm -->



</body>
</html>




<style>
    /* Thiết lập font chữ mặc định cho toàn bộ trang */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0; /* Màu nền */
    }

    /* Định dạng tiêu đề h1 */
    h1 {
        color: white; /* Màu chữ */
        text-align: center; /* Canh giữa tiêu đề */
    }

    /* Biểu mẫu thêm sản phẩm */
    form {
        margin: 30px auto; /* Canh giữa biểu mẫu */
        max-width: 1000px; /* Độ rộng tối đa */
        padding: 20px;
        background-color: #fff; /* Màu nền biểu mẫu */
        border: 1px solid #ddd; /* Viền */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
    }

    label {
        font-weight: bold; /* Chữ đậm */
    }

    input[type="text"],
    textarea,
    input[type="number"] {
        width: 100%; /* Độ rộng 100% */
        padding: 10px; /* Khoảng cách giữa nội dung và viền */
        margin-bottom: 10px; /* Khoảng cách dưới */
        border: 1px solid #ccc; /* Viền */
        border-radius: 4px; /* Góc bo tròn */
    }

    input[type="submit"] {
        background-color: #007bff; /* Màu nền nút */
        color: #fff; /* Màu chữ nút */
        border: none; /* Không có viền */
        padding: 10px 20px; /* Kích thước nút */
        cursor: pointer; /* Con trỏ chuột thành bàn tay khi di chuyển qua nút */
    }

    /* Danh sách sản phẩm */
    ul {
        list-style-type: none; /* Loại bỏ dấu đầu dòng */
        padding: 0;
    }

    li {
        margin: 10px 0; /* Khoảng cách giữa các sản phẩm */
        padding: 10px; /* Khoảng cách nội dung và viền */
    }
    /* Các thiết lập CSS khác có thể thêm tùy theo yêu cầu của bạn */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* Chia thành 4 cột bằng nhau */
        gap: 20px; /* Khoảng cách giữa các sản phẩm */
    }

    .product {
        background-color: #fff; /* Màu nền sản phẩm */
        padding: 20px; /* Khoảng cách nội dung và viền */
        border: 1px solid #ddd; /* Viền */
    }

    /* Các thiết lập CSS khác có thể thêm tùy theo yêu cầu của bạn */

</style>