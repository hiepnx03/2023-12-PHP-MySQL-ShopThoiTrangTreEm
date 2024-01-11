<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chào mừng - Thời trang trẻ em</title>
    <!-- Thêm tệp CSS cho trang chào mừng -->
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
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php" class="active">Trang chủ</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/sell.php">Bán Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/order.php">Đơn Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/viewuser.php">Quản Lý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/view_feedback.php">Góp Ý Khách Hàng</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/quanlynews.php">Quản Lý Tin Tức</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/editinfoweb.php">Chỉnh Sửa Web</a></li>';
                    echo '<li><a href="/ULSA/baitaplon/php/account.php">Tài Khoản</a></li>';
                } else {
                    // Người dùng thông thường
                    echo '<li><a href="/ULSA/baitaplon/php/welcome.php" class="active">Trang chủ</a></li>';
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
                echo '<li><a href="/ULSA/baitaplon/php/welcome.php" class="active">Trang chủ</a></li>';
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
    <!--    <h1>Chào mừng -->
    <?php //echo isset($_SESSION["username"]) ? $_SESSION["username"] : 'bạn'; ?><!-- đã đến với cửa hàng thời trang trẻ em!</h1>-->

    <h1>Chào mừng <?php if (isset($_SESSION["username"])) {
            echo $_SESSION["username"] . ' đã quay trở lại';
        } else {
            echo 'bạn đã đến với thời trang trẻ em';
        }
        ?>
    </h1>
    <p>Bạn đang tìm kiếm những chiếc áo thời trang đẹp cho con của mình? Hãy khám phá bộ sưu tập sản phẩm đa dạng của
        chúng tôi!</p>
    <p>Tại Thời trang trẻ em, chúng tôi cam kết mang đến cho bạn những lựa chọn thời trang phong cách và chất lượng cho
        bé yêu của bạn.</p>
    <p>Hãy trải nghiệm mua sắm trực tuyến dễ dàng và tiện lợi với chúng tôi. Xem sản phẩm <a
                href="/ULSA/baitaplon/php/products.php">tại đây</a> và đặt hàng ngay hôm nay!</p>
    <?php
    if (isset($_SESSION["username"])) {
        // Nếu đã đăng nhập, hiển thị thông báo chào mừng
        echo '<p></p>';
    } else {
        // Nếu chưa đăng nhập, hiển thị thông báo yêu cầu đăng nhập
        echo '<br><p>Vui lòng <a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a> hoặc <a href="/ULSA/baitaplon/php/register.php">Đăng ký</a> để trải nghiệm đầy đủ dịch vụ của chúng tôi.</p>';
    }
    ?>

    <!-- Bộ sưu tập sản phẩm -->
    <section>
        <h2>Bộ sưu tập sản phẩm</h2>
        <p>Khám phá bộ sưu tập sản phẩm đa dạng của chúng tôi, từ quần áo cho bé trai đến bé gái và thậm chí cả sản phẩm
            unisex.</p>
        <p>Chúng tôi luôn cập nhật với những xu hướng thời trang mới nhất để bạn và con bạn luôn thời trang.</p>
    </section>

    <!-- Cách bạn chăm sóc khách hàng -->
    <section>
        <h2>Cách bạn chăm sóc khách hàng</h2>
        <p>Chúng tôi tự hào về dịch vụ khách hàng xuất sắc của mình. Chúng tôi luôn ở đây để hỗ trợ bạn và đảm bảo bạn
            có trải nghiệm mua sắm tốt nhất.</p>
        <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu đặc biệt nào, vui lòng liên hệ với chúng tôi. Chúng tôi sẽ phản hồi
            sớm nhất có thể.</p>
    </section>

    <!-- Hướng dẫn mua sắm -->
    <section>
        <h2>Hướng dẫn mua sắm</h2>
        <p>Mua sắm tại cửa hàng của chúng tôi rất dễ dàng. Hãy xem qua cách tìm sản phẩm, thêm vào giỏ hàng và hoàn tất
            giao dịch trực tuyến.</p>
        <p>Chúng tôi đã thiết kế trang web để bạn có trải nghiệm mua sắm thuận tiện và thú vị.</p>
    </section>

    <!-- Bài viết blog hoặc tin tức -->
    <section>
        <h2>Bài viết blog và tin tức</h2>
        <p>Đừng quên kiểm tra bài viết blog của chúng tôi để cập nhật với các xu hướng thời trang mới nhất cho trẻ
            em.</p>
        <p>Bạn cũng có thể tìm hiểu về cách chăm sóc con cái, sáng tạo phong cách và nhiều chủ đề khác.</p>
    </section>

    <!-- Sản phẩm nổi bật -->
    <section>
        <h2>Sản phẩm nổi bật</h2>
        <p>Hãy xem qua các sản phẩm nổi bật hoặc các ưu đãi đặc biệt mà chúng tôi đang cung cấp. Đừng bỏ lỡ cơ hội để
            mua sắm với giá ưu đãi.</p>
    </section>

    <!-- Câu chuyện thành công của khách hàng -->
    <section>
        <h2>Câu chuyện thành công của khách hàng</h2>
        <p>Đọc về những câu chuyện thành công của khách hàng khác nhau khi họ mua sắm tại cửa hàng Thời trang trẻ
            em.</p>
        <p>Chúng tôi luôn hạnh phúc khi nhận được phản hồi tích cực từ khách hàng của mình.</p>
    </section>

    <!-- Thông tin liên hệ -->
    <section>
        <?php
        // Kết nối cơ sở dữ liệu
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "webthoitrang";

        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Truy vấn thông tin liên hệ
        $sql = "SELECT * FROM ThongTinLienHe";
        $result = $conn->query($sql);

        // Hiển thị thông tin liên hệ
        if ($result->num_rows > 0) {
            // Duyệt qua từng hàng kết quả
            while ($row = $result->fetch_assoc()) {
                echo "<h2>Thông tin liên hệ</h2>";
                echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                if (isset($row["so_dien_thoai"])) {
                    echo "<p><strong>Số điện thoại:</strong> " . $row["so_dien_thoai"] . "</p>";
                } else {
                    echo "<p>Số điện thoại không có sẵn.</p>";
                }
                echo "<p><strong>Địa chỉ:</strong> " . $row["dia_chi"] . "</p>";
                echo "<p><strong>Nội dung:</strong> " . $row["noi_dung"] . "</p>";
                // Hiển thị các trường thông tin liên hệ khác tương tự
            }
        } else {
            echo "Không có thông tin liên hệ.";
        }

        // Đóng kết nối cơ sở dữ liệu
        $conn->close();
        ?>
    </section>

    <!-- FAQ (Câu hỏi thường gặp) -->
    <section>
        <h2>FAQ (Câu hỏi thường gặp)</h2>
        <p>Dưới đây là một số câu hỏi thường gặp mà khách hàng thường đặt. Nếu bạn có câu hỏi khác, hãy liên hệ với
            chúng tôi.</p>
        <!-- Thêm danh sách các câu hỏi thường gặp và câu trả lời của bạn -->
    </section>

    <!-- Biểu đồ kích thước -->
    <section>
        <h2>Biểu đồ kích thước</h2>
        <p>Nếu bạn mua quần áo cho trẻ em, hãy tham khảo biểu đồ kích thước dưới đây để chọn kích thước phù hợp cho con
            của bạn.</p>
        <!-- Thêm biểu đồ kích thước -->
    </section>

    <div id="scroll-to-top">
        <a href="#top">&#8593;</a>
    </div>
</main>

<!-- Footer -->
<footer>
    <p>&copy; 2023 Thời trang trẻ em</p>
</footer>
</body>
</html>


<script>
    window.addEventListener('scroll', function () {
        const parallaxHeader = document.querySelector('.parallax-header');
        let scrollPosition = window.pageYOffset;
        parallaxHeader.style.backgroundPositionY = scrollPosition * 0.5 + 'px'; // Thay đổi 0.5 để điều chỉnh tốc độ parallax
    });


    // Lắng nghe sự kiện scroll
    window.addEventListener('scroll', function () {
        const scrollButton = document.getElementById('scroll-to-top');
        if (window.scrollY > 200) {
            // Hiển thị biểu tượng mũi tên khi cuộn xuống dưới 200px
            scrollButton.style.display = 'block';
        } else {
            // Ẩn biểu tượng mũi tên khi cuộn lên trên 200px
            scrollButton.style.display = 'none';
        }
    });

    // Xử lý sự kiện khi người dùng nhấp vào biểu tượng mũi tên
    document.getElementById('scroll-to-top').addEventListener('click', function (e) {
        e.preventDefault();
        // Cuộn lên đầu trang
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Tạo hiệu ứng cuộn mượt (tuỳ chọn)
        });
    });

</script>

<style>

    .parallax-header {
        background-image: url('/ULSA/baitaplon/images/background-thoi-trang.jpg '); /* Thay đổi đường dẫn đến hình nền của bạn */
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        height: 100vh; /* Đảm bảo chiều cao đầy đủ cho tiêu đề */
        position: relative;
        background-color: #333;
    }

    .parallax-header h1 {
        text-align: center;
        padding-top: 20%; /* Điều chỉnh vị trí của tiêu đề */
        font-size: 3rem;
        color: #fff; /* Màu chữ */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Đổ bóng chữ (tuỳ chọn) */
    }
    #scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: none;
    }

    #scroll-to-top a {
        font-size: 24px;
        text-decoration: none;
        background-color: #333; /* Màu nền ban đầu */
        color: #fff; /* Màu chữ ban đầu */
        padding: 15px; /* Khoảng cách giữa biểu tượng và nền */
        border-radius: 50%; /* Để làm tròn biểu tượng thành hình tròn */
        transition: background-color 0.3s; /* Hiệu ứng chuyển đổi màu nền */
    }

    #scroll-to-top a:hover {
        background-color: #ff5722; /* Màu nền khi di chuột qua */
    }

    /* CSS để đổi cỡ chữ cho các liên kết trong danh sách menu */
    .parallax-header nav ul li a {
        font-size: 50px;
    }

    /* CSS để đổi màu chữ cho liên kết "Liên hệ" */
    .parallax-header a {
        color: black; /* Thay 'your-color' bằng màu bạn muốn sử dụng */
    }

</style>
