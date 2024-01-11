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

$search_query = ''; // Khởi tạo biến tìm kiếm
if (isset($_GET['search_query'])) {
    $search_query = $_GET['search_query']; // Lấy giá trị tìm kiếm từ form
}

// Lấy danh sách sản phẩm từ cơ sở dữ liệu theo tiêu đề tìm kiếm
$query = "SELECT * FROM adproduct WHERE tensp LIKE '%$search_query%'";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang sản phẩm -->
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<!-- Header -->
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
                echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/products.php" class="active">Sản phẩm</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>

<!-- Main Content -->
<aside class="sidebar">
    <h2>Danh mục sản phẩm</h2>
    <ul>
        <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "webthoitrang";

        // Tạo kết nối đến cơ sở dữ liệu
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if (!$conn) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
        }

        // Truy vấn để lấy danh sách danh mục sản phẩm
        $sql_select_categories = "SELECT * FROM adproducttype";
        $result_categories = mysqli_query($conn, $sql_select_categories);

        // Hiển thị danh sách danh mục sản phẩm
        if (mysqli_num_rows($result_categories) > 0) {
            while ($row = mysqli_fetch_assoc($result_categories)) {
                $ma_loaisp = $row['ma_loaisp'];
                $ten_loaisp = $row['ten_loaisp'];
                // Hiển thị mỗi danh mục sản phẩm là một mục trong danh sách
                echo "<li><a href='products.php?search_query=$ma_loaisp'>$ten_loaisp</a></li>";
            }
        } else {
            echo "Không có danh mục sản phẩm.";
        }
        ?>
    </ul>
</aside>
<main>
    <section class="product-list">
        <form method="GET" action="/ULSA/baitaplon/php/products.php">
            <input type="text" name="search_query" placeholder="Tìm kiếm sản phẩm">
            <button type="submit">Tìm kiếm</button>
        </form>
        <div class="products">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($r = mysqli_fetch_assoc($result)) {
                    //var_dump($r);
                    $hinhanh = $r['hinhanh'];
                    $masp = $r['ma_sp'];
                    $tensp = $r['tensp'];
                    $giatien = $r['giaxuat'];
                    $khuyenmai = $r['khuyenmai'];
                    ?>
                    <div class="product-item">
                        <img src="images/<?php echo $r['hinhanh'] ?>" width="80">
                        <br/>
                        <?php
                        echo $tensp . "<br>";
                        echo "<del>$giatien.</del>" . "<br>";
                        echo $khuyenmai, "<br>";
                        ?>
                        <a href="product_detail.php?id=<?php echo $masp; ?>">Xem chi tiết</a>
                        <br>
                        <a href="addtocart.php?id=<?php echo $masp; ?>" style="color:blue">thêm vào giỏ hàng</a>
                        <?php echo "<br>";
                        ?>
                    </div>
                <?php }
            } else {
                echo "Không tìm thấy sản phẩm.";
            }
            ?>
        </div>
    </section>
</main>


<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>

<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px 0;
    }

    header h1 {
        margin-bottom: 10px;
        font-size: 60px;
    }

    nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    main {
        padding: 20px;
    }

    .product-list {
        margin-bottom: 30px;
    }

    .product-list form input[type="text"] {
        padding: 8px;
        width: 300px;
    }

    .product-list form button {
        padding: 8px 15px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .products {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-gap: 20px;
    }

    .products img {
        width: 100%;
        height: auto;
    }

    .products a {
        text-decoration: none;
        color: blue;
    }

    footer {
        text-align: center;
        padding: 10px 0;
        background-color: #333;
        color: #fff;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>


<script>
    // JavaScript để hiển thị menu dropdown khi di chuột vào và thực hiện tìm kiếm khi người dùng bấm vào mục
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownMenu = document.querySelector('.dropdown-menu');

        // Sự kiện khi di chuột vào danh mục sản phẩm
        dropdownMenu.addEventListener('mouseover', function () {
            this.style.display = 'block';
        });

        // Sự kiện khi di chuột ra khỏi danh mục sản phẩm
        dropdownMenu.addEventListener('mouseout', function () {
            this.style.display = 'none';
        });

        // Sự kiện khi bấm vào một mục danh mục sản phẩm
        dropdownMenu.addEventListener('click', function (event) {
            if (event.target.tagName === 'A') {
                const categoryName = event.target.textContent.trim();
                const searchInput = document.querySelector('input[name="search_query"]');
                searchInput.value = categoryName;
                // Tìm kiếm theo tên danh mục sản phẩm
                // Submit form hoặc gọi hàm tìm kiếm tại đây
                // Ví dụ: document.querySelector('form').submit();
            }
        });
    });

</script>