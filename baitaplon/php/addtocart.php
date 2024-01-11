
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Thời trang trẻ em</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>

<body>
<div class="main">
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
                        echo '<li><a href="/ULSA/baitaplon/php/products.php">Sản phẩm</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/contact.php">Liên hệ</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/news.php">Tin tức</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/addtocart.php" class="active">Giỏ Hàng</a></li>';
                        echo '<li><a href="/ULSA/baitaplon/php/view_orders.php" >Đơn Hàng</a></li>';
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
    <?php
    require_once('functions.php');
    require_once("connect.php");
    $id = isset($_GET["id"]) ? $_GET["id"] : "";
    $sql = "SELECT * FROM adproduct WHERE ma_sp='$id'";
    $rel = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rel) > 0) {
        $row = mysqli_fetch_assoc($rel);
        $product_id = $row['ma_sp'];
        $product_name = $row['tensp'];
        $product_price = $row['giaxuat'];
        $product_discount = $row['khuyenmai'];
        $product_image = $row['hinhanh'];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'masp' => $product_id,
                'tensp' => $product_name,
                'giaxuat' => $product_price,
                'khuyenmai' => $product_discount,
                'hinhanh' => $product_image,
                'qty' => 0,
            ];
        }

        $_SESSION['cart'][$product_id]['qty']++;
    } else {
        echo "Không có sản phẩm nào";
    }
    ?>
    <?php
    if (isset($_POST["btn_submit"])) {
        if ($_POST["btn_submit"] == "Cập nhật") {
            if (isset($_POST['qty'])) {
                foreach ($_POST['qty'] as $key => $value) {
                    $_SESSION['cart'][$key]['qty'] = $value;
                }
            }
            header('/ULSA/baitaplon/php/addtocart.php');
        }
    }

    ?>
    <div class="content">
        <?php
        if (isset($_SESSION['cart'])) {
            ?>
            <form action="" method="post">
                <table width="992" border="1">
                    <tr>
                        <td colspan="10" style="text-align:center">Danh sách sản phẩm của giỏ hàng</td>
                    </tr>
                    <tr>
                        <td width="40">STT</td>
                        <td width="92">Mã sản phẩm</td>
                        <td width="161">Tên sản phẩm</td>
                        <td width="102">Hình ảnh</td>
                        <td width="216">Số lượng</td>
                        <td width="139">Giá tiền</td>
                        <td width="124">Khuyến mãi</td>
                        <td width="126">Thành tiền</td>
                        <td width="46">Xóa</td>
                    </tr>
                    <?php
                    $i = 0;
                    $tongtien = 0;
                    $tt = 0;
                    foreach ($_SESSION["cart"] as $k => $v) {
                        if ($v['khuyenmai'] > 0) {
                            $tt = $v['qty'] * ($v['giaxuat'] - $v['khuyenmai']);
                        } else {
                            $tt = $v['qty'] * $v['giaxuat'];
                        }
                        $tongtien += $tt;
                        $i++;
                        ?>
                        <tr>
                            <td height="57"><?php echo $i; ?></td>
                            <td><?php echo $v['masp']; ?></td>
                            <td><?php echo $v['tensp']; ?></td>
                            <td>
                                <img src="images/<?php echo $v['hinhanh']; ?>" width="70">
                            </td>
                            <td><input type="text" value="<?php echo $v['qty']; ?>" name="qty[<?php echo $k; ?>]"/></td>
                            <td><?php echo $v['giaxuat']; ?></td>
                            <td><?php echo $v['khuyenmai']; ?></td>
                            <td><?php echo $tt; ?></td>
                            <td>
                                <a href="delete_giohang.php?key=<?php echo $k ?>" style="color:blue">Xóa</a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="9">
                            <?php
                            echo "Tổng tiền cần thanh toán là" . " " . $tongtien;
                            ?>
                        </td>
                    </tr>
                    <?php
                    $total_order_price = 0;

                    function generateUniqueOrderCode($conn)
                    {
                        do {
                            $mahd = "HD" . mt_rand(0, 1000000); // Tạo mã hóa đơn ngẫu nhiên
                            $sql = "SELECT * FROM `order` WHERE ma_hoadon = '$mahd'";
                            $result = mysqli_query($conn, $sql);
                        } while (mysqli_num_rows($result) > 0);

                        return $mahd;
                    }

                    // Hàm này kiểm tra xem mã khách hàng đã tồn tại trong cơ sở dữ liệu hay chưa
                    function generateUniqueCustomerCode($conn)
                    {
                        do {
                            $makh = "KH" . mt_rand(0, 1000000); // Tạo mã khách hàng ngẫu nhiên
                            $sql = "SELECT * FROM customer WHERE ma_khachhang = '$makh'";
                            $result = mysqli_query($conn, $sql);
                        } while (mysqli_num_rows($result) > 0);

                        return $makh;
                    }


                    if (isset($_POST["btn_submit"]) && $_POST["btn_submit"] == "Xác nhận đặt hàng") {
                        // Hàm này kiểm tra xem mã hóa đơn đã tồn tại trong cơ sở dữ liệu hay chưa

                        $txt_tenkh = isset($_POST["txt_tenkhachhang"]) ? $_POST["txt_tenkhachhang"] : "";
                        $txt_email = isset($_POST["txt_email"]) ? $_POST["txt_email"] : "";
                        $txt_sdt = isset($_POST["txt_phone"]) ? $_POST["txt_phone"] : "";
                        $txt_diachi_lienhe = isset($_POST["txt_diachi_lienhe"]) ? $_POST["txt_diachi_lienhe"] : "";
                        $txt_diachi_giaohang = isset($_POST["txt_diachi_giaohang"]) ? $_POST["txt_diachi_giaohang"] : "";
                        $createdate = isset($_POST["createdate"]) ? $_POST["createdate"] : "";
                        foreach ($_SESSION['cart'] as $product_id => $product) {
                            // Tạo mã khách hàng và mã hóa đơn ngẫu nhiên
                            $makh = generateUniqueCustomerCode($conn);
                            $mahd = generateUniqueOrderCode($conn);
                            $product_price = $product['giaxuat'];
                            $product_discount = $product['khuyenmai'];
                            $product_qty = $product['qty'];

                            if ($product_discount > 0) {
                                $subtotal = $product_qty * $product_discount;
                            } else {
                                $subtotal = $product_qty * $product_price;
                            }

                            $total_order_price += $subtotal;
                            // Xử lý đặt hàng

                            // Sau khi tạo mã hóa đơn duy nhất, tiếp tục thêm thông tin đơn hàng
                            $sql1 = "INSERT INTO `order`(`ma_hoadon`, `ma_khachhang`, `tenkhachhang`, `tongtien`, `createdate`) VALUES ('$mahd','$makh','$txt_tenkh','$tongtien','$createdate')";
                            $rel1 = mysqli_query($conn, $sql1);

                            $sql2 = "INSERT INTO `customer`(`ma_khachhang`, `tenkhachhang`, `email`, `phone`, `diachi_lienhe`, `diachi_giaohang`) VALUES ('$makh', '$txt_tenkh', '$txt_email', '$txt_sdt', '$txt_diachi_lienhe', '$txt_diachi_giaohang')";
                            $rel2 = mysqli_query($conn, $sql2);

                            // Lặp qua giỏ hàng để thêm thông tin sản phẩm vào bảng `orderdetail`
                            foreach ($_SESSION['cart'] as $product_id => $product) {
                                $ma_sp = $product['masp'];
                                $tensp = $product['tensp'];
                                $hinhanh = $product['hinhanh'];
                                $giaxuat = $product['giaxuat'];
                                $khuyenmai = $product['khuyenmai'];
                                $soluong = $product['qty'];
                                $mahd = generateUniqueOrderCode($conn);
                                // Thêm chi tiết hóa đơn vào bảng `orderdetail`
                                $sql_order_detail = "INSERT INTO oderdetail (mahd, masp, tensp, soluong, giaxuat, khuyenmai) VALUES ('$mahd', '$ma_sp', '$tensp', $soluong, $giaxuat, $khuyenmai)";
                                $result_order_detail = mysqli_query($conn, $sql_order_detail);
                            }
                            if ($sql_order_detail) {
                                echo "Bạn đã đặt hàng thành công";
                            } else {
                                echo "Đặt hàng thất bại";
                            }
                            $_SESSION['cart'] = array();
                            unset($_SESSION['cart']);

                            // Chuyển hướng người dùng đến trang khác hoặc thông báo đặt hàng thành công
                            header('/ULSA/baitaplon/php/addtocart.php');
                            exit(); // Kết thúc chương trình sau khi chuyển hướng
                        }
                    }
                    ?>
                    <tr>
                        <td height="40" colspan="9">
                            <input name="btn_submit" type="submit" value="Cập nhật"/>
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>Tên khách hàng</td>
                        <td><input name="txt_tenkhachhang" type="text"/></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input name="txt_email" type="text"/></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td><input name="txt_phone" type="text"/></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ liên hệ</td>
                        <td><input name="txt_diachi_lienhe" type="text"/></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ giao hàng</td>
                        <td><input name="txt_diachi_giaohang" type="text"/></td>
                    </tr>
                    <tr>
                        <td>Ngày đặt hàng</td>
                        <td><input name="createdate" type="date"/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" name="btn_submit" value="Xác nhận đặt hàng"></td>
                    </tr>
                </table>
            </form>
            <?php
        }
        ?>
        <footer>
            <p>&copy; 2023 Thời trang trẻ em</p>
        </footer>
        <style>
            /* Reset default margin, padding, use a pleasant background color, and set a readable font */
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f8f8f8;
                margin: 0;
                padding: 0;
            }

            .navbar a {
                float: left;
                display: block;
                color: white;
                text-align: center;
                padding: 14px 20px;
                text-decoration: none;
            }

            .navbar a:hover {
                background-color: #ddd;
                color: black;
            }

            /* Header styling */
            .parallax-header {
                background-image: url('path_to_your_image.jpg'); /* Replace with your image */
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                color: #fff;
                text-align: center;
                padding: 200px 0;
            }

            .parallax-header h1 {
                font-size: 5em;
            }

            /* Main content styling */
            .content {
                width: 80%;
                margin: 20px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            /* Form and table styling */
            form {
                margin-top: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th,
            td {
                border: 1px solid #ccc;
                padding: 12px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            /* Form input elements styling */
            input[type="text"],
            input[type="file"],
            input[type="date"],
            button {
                padding: 10px;
                margin-bottom: 10px;
                width: calc(100% - 20px);
                box-sizing: border-box;
                border-radius: 4px;
                border: 1px solid #ccc;
            }

            /* Form submit button styling */
            input[type="submit"] {
                background-color: #4CAF50;
                color: white;
                border: none;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #45a049;
            }

            /* Hyperlink styling */
            a {
                text-decoration: none;
                color: #4CAF50;
            }

            a:hover {
                text-decoration: underline;
            }
        </style>