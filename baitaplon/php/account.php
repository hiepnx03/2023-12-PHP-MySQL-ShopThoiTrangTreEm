<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa, nếu chưa, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: /ULSA/baitaplon/php/login.php");
    exit();

}
if (isset($_SESSION['success_message'])) {
    echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Xóa thông báo sau khi đã hiển thị
}
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT `id`, `fullname`, `email`, `username`, `phone`, `gender`, `nationality`, `address`, `access_level`, `created_at`, `avatar` FROM `User` WHERE `username` = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thông tin tài khoản</title>
        <!-- Thêm tệp CSS cho trang -->
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
                        echo '<li><a href="/ULSA/baitaplon/php/account.php" class="active">Tài Khoản</a></li>';
                    } else {
                        // Người dùng thông thường
                        echo '<li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/addtocart.php">Giỏ hàng</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/feedback.php">Góp ý</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/account.php"  class="active">Tài Khoản</a></li>';
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

    <!-- Main Content -->
    <main>
        <div class="container">
            <!-- Cột hiển thị thông tin -->
            <div class="column">
                <h2 style="text-align: center">Thông tin tài khoản <?php echo $user['username']; ?></h2>
                <form action="/ULSA/baitaplon/php/update_user.php" method="POST">

                    <label for="fullname">Họ và tên:</label>
                    <input name="fullname" type="text" value="<?php echo $user['fullname']; ?>"
                           placeholder="Nhập đầy đủ họ tên"/>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required
                           placeholder="Nhập Email">

                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" required placeholder="Nhập mật khẩu">

                    <label for="phone">Số điện thoại:</label>
                    <input name="phone" type="text" value="<?php echo $user['phone']; ?>"
                           placeholder="Nhập số điện thoại"/>

                    <label for="gender">Giới tính:</label>
                    <input type="radio" name="gender"
                           value="Nam" <?php echo ($user['gender'] === 'Nam') ? 'checked' : ''; ?>/>Nam
                    <input type="radio" name="gender"
                           value="Nữ" <?php echo ($user['gender'] === 'Nữ') ? 'checked' : ''; ?>/>Nữ

                    <label for="nationality">Quốc tịch:</label>
                    <select name="nationality">
                        <option value="Mỹ" <?php echo ($user['nationality'] === 'Mỹ') ? 'selected' : ''; ?>>Mỹ</option>
                        <option value="Việt Nam" <?php echo ($user['nationality'] === 'Việt Nam') ? 'selected' : ''; ?>>
                            Việt Nam
                        </option>
                        <option value="Hàn Quốc" <?php echo ($user['nationality'] === 'Hàn Quốc') ? 'selected' : ''; ?>>
                            Hàn Quốc
                        </option>
                    </select>

                    <label for="address">Địa chỉ:</label>
                    <textarea name="address" placeholder="Nhập địa chỉ" cols="50"
                              rows="5"><?php echo $user['address']; ?></textarea>

                    <label for="avatar">Avatar:</label>
                    <img src="/ULSA/baitaplon/php/images/<?php echo $user['avatar']; ?>" alt="Avatar của người dùng"
                         width="200" height="200">
                    <!-- Thêm input cho việc tải lên avatar mới -->
<!--                    <label for="new_avatar">Chọn ảnh đại diện mới:</label>-->
<!--                    <input type="file" id="new_avatar" name="new_avatar" accept="image/*">-->


                    <br>
                    <br>
                    <button type="submit" name="update">Cập nhật thông tin</button>
                </form>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <!-- Nội dung footer -->
    </footer>

    </body>
    </html>

    <?php
} else {
    echo "Không tìm thấy thông tin người dùng.";
}

$stmt->close();
$conn->close();
?>


<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        display: flex;
        justify-content: space-between;
        margin: 20px auto;
        max-width: 1200px;
    }

    .column {
        width: 100%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .column h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select,
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    input[type="radio"] {
        margin-right: 10px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

</style>