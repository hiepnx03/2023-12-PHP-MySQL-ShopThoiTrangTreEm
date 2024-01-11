<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION["username"])) {
    header("Location: /ULSA/baitaplon/php/login.php"); // Chuyển hướng người dùng đến trang đăng nhập
    exit();
}

// Kiểm tra xem giỏ hàng có dữ liệu không
if (!isset($_SESSION["cart"]) || empty($_SESSION["cart"])) {
    echo "Giỏ hàng của bạn đang trống.";
} else {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "webthoitrang";
    $db = mysqli_connect($servername, $username, $password, $dbname);
    if (!$db) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    $product_ids = array_keys($_SESSION["cart"]);
    $product_ids_string = implode(',', $product_ids);

    $query = "SELECT * FROM Product WHERE id IN ($product_ids_string)";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Lỗi truy vấn cơ sở dữ liệu: " . mysqli_error($db));
    }

    // Khởi tạo biến để tính tổng tiền và số lượng mặt hàng trong giỏ hàng
    $total_price = 0;
    $total_items = 0;


    $vnp_Amount = $total_price;


    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Giỏ hàng</title>
        <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
    </head>
    <body>
    <header>
        <h1 style="color: white">Giỏ hàng</h1>
        <nav>
            <ul>
                <li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>
                <li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>
                <li><a href="/ULSA/baitaplon/php/cart.php" class="active">Giỏ hàng</a></li>
                <li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>
                <?php
                if (isset($_SESSION["username"])) {
                    // Đã đăng nhập
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/logout.php">Đăng xuất</a></li>';

                    // Kiểm tra xem 'access_level' có tồn tại trong $_SESSION không
                    if (isset($_SESSION['access_level']) && $_SESSION['access_level'] === 'Quantri') {
                        echo '<li><a href="/ULSA/baitaplon/php/sell.php">Bán Hàng</a></li>';
                    }
                } else {
                    // Chưa đăng nhập
                    echo '<li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>

    <h2 style="text-align: center">Danh sách Sản phẩm trong giỏ hàng:</h2>
    <div class="product-grid">
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $product_id = $row['id'];
            $product_name = $row['title'];
            $product_description = $row['description'];
            $product_price = $row['price'];
            $product_quantity = $_SESSION["cart"][$product_id];
            $item_total_price = $product_price * $product_quantity;
            $total_price += $item_total_price;
            $total_items += $product_quantity;
            ?>
            <div class="product">
                <strong><?php echo $product_name; ?></strong><br>
                <img src="<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['title']; ?>" width="200" height="200">
                Mô tả: <?php echo $product_description; ?><br>
                Giá: <?php echo $product_price; ?> VNĐ<br>
                Số lượng: <?php echo $product_quantity; ?><br>
                <!-- Thêm nút để cập nhật số lượng hoặc xóa sản phẩm -->
                <form method="POST" action="/ULSA/baitaplon/php/update_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <input type="number" name="quantity" value="<?php echo $product_quantity; ?>" min="1">
                    <input type="submit" value="Cập nhật">
                    <a href="/ULSA/baitaplon/php/remove_from_cart.php?product_id=<?php echo $product_id; ?>">Xóa</a>
                </form>
            </div>
        <?php } ?>
    </div>
    <h2>Thông tin thanh toán:</h2>
    <form method="post" action="process_payment.php">
        <label for="fullname">Họ và tên:</label>
        <input type="text" name="fullname" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <label for="address">Địa chỉ giao hàng:</label>
        <input type="text" name="address" required><br>
        <label for="phone">Số điện thoại:</label>
        <input type="text" name="phone" required><br>
        <h3>Chọn phương thức thanh toán:</h3>
        <input type="radio" name="payment_method" value="cash_on_delivery" checked>
        <label for="cash_on_delivery">Thanh toán khi nhận hàng</label><br>
        <input type="radio" name="payment_method" value="momo">
        <label for="momo">Thanh toán bằng Momo</label><br>
        <input type="hidden" name="vnp_Amount" value="<?php echo $vnp_Amount; ?>">
        <input type="radio" name="payment_method" value="vnpay">
        <label for="vnpay">Thanh toán bằng VNPAY</label><br>
        <input type="submit" value="Thanh toán">
    </form>


    <h3>Tổng số mặt hàng trong giỏ hàng: <?php echo $total_items; ?></h3>
    <h3>Tổng tiền: <?php echo number_format($total_price, 2); ?> VNĐ</h3>

    </body>
    </html>
    <?php
}
?>


<style>
    /*Đảm bảo rằng .product-grid là một lưới có độ rộng tối đa */
    /* Đảm bảo rằng .product-grid là một lưới có độ rộng tối đa */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Hiển thị các sản phẩm trong lưới */
        gap: 20px; /* Khoảng cách giữa các sản phẩm */
        justify-content: center; /* Căn giữa sản phẩm theo hàng ngang */
        align-items: center; /* Căn giữa sản phẩm theo hàng dọc */
    }

    /* Cài đặt căn giữa dọc cho mỗi sản phẩm */
    .product {
        text-align: center; /* Căn giữa theo chiều dọc */
        background-color: #fff; /* Màu nền sản phẩm */
        padding: 20px; /* Khoảng cách nội dung và viền */
        border: 1px solid #ddd; /* Viền */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng bóng đổ */
        max-width: 200px; /* Độ rộng tối đa cho mỗi sản phẩm */
        margin: 0 auto; /* Canh giữa sản phẩm theo hàng ngang */
    }

    /*Các thiết lập CSS khác có thể thêm tùy theo yêu cầu của bạn */
    /* Định dạng các phần tử trong biểu mẫu thanh toán */
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f0f0f0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }


    /* Định dạng các trường nhập thông tin dài hơn */
    input[type="text"],
    input[type="email"] {
        width: 95%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    /* Định dạng nhãn cho các trường nhập */
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        width: 100%;
        max-width: 300px; /* Độ rộng tối đa của nhãn */
    }

    /* Định dạng nút "Thanh toán" */
    input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        margin-top: 10px; /* Khoảng cách giữa nút và trường nhập cuối cùng */
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

</style>
