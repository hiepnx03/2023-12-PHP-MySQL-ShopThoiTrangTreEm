<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>website bán hàng</title>
    <link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="main">
    <?php
    require_once("connect.php");

    $id = $_GET["id"];
    $sql = "SELECT * FROM customer WHERE ma_khachhang = '$id'";
    $rel = mysqli_query($conn, $sql);
    $khachhang = mysqli_fetch_assoc($rel);
    if (!$khachhang) {
        echo "Không tìm thấy khách hàng";
        exit();
    }
    $ma_khachhang = isset($_POST["ma_khachhang"]) ? $_POST["ma_khachhang"] : "";
    $tenkhachhang = isset($_POST["tenkhachhang"]) ? $_POST["tenkhachhang"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $diachi_lienhe = isset($_POST["diachi_lienhe"]) ? $_POST["diachi_lienhe"] : "";
    $diachi_giaohang = isset($_POST["diachi_giaohang"]) ? $_POST["diachi_giaohang"] : "";

    if (isset($_POST["btn_update"])) {
        $sql1 = "UPDATE customer SET ma_khachhang='$ma_khachhang', tenkhachhang='$tenkhachhang', email='$email',  phone='$phone', diachi_lienhe='$diachi_lienhe', diachi_giaohang='$diachi_giaohang' WHERE ma_khachhang='$id'";
        $rel1 = mysqli_query($conn, $sql1);
        echo "Bạn đã cập nhật thành công";
        header('location: sell.php?action=customer');
    }
    ?>


    <form action="" method="post">
        <table width="600" border="1">
            <tr>
                <td colspan="2">Danh sách khách hàng</td>
            </tr>
            <tr>
                <td>Mã khách hàng</td>
                <td><?php
                    $sql = "SELECT * FROM customer ";
                    $rel = mysqli_query($conn, $sql);
                    ?>
                    <select name="ma_khachhang">
                        <?php
                        if (mysqli_num_rows($rel) > 0){
                        while ($r = mysqli_fetch_assoc($rel)){
                        ?>
                        <option value="<?php echo $r["ma_khachhang"] ?>">
                            <?php echo $r["ma_khachhang"] ?>
                        </option>
                    <?php
                    }
                    }
                    ?></td>
            </tr>
            <tr>
                <td>Tên khách hàng</td>
                <td><input name="tenkhachhang" type="text" value="<?php echo $tenkhachhang; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input name="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input name="phone" value="<?php echo $phone; ?>"></td>
            </tr>
            <tr>
                <td>Địa chỉ liên hệ</td>
                <td><input name="diachi_lienhe" value="<?php echo $diachi_lienhe; ?>"></td>
            </tr>
            <tr>
                <td>Địa chỉ giao hàng</td>
                <td><input name="diachi_giaohang" value="<?php echo $diachi_giaohang; ?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center; font-size:30px; font-weight:bold"><input name="btn_update" type="submit" value="Cập nhật"></td>

                <a href="javascript:history.go(-1)" style="color: blue;">Trở lại</a>
            </tr>
        </table>

    </form>
    <div class="content_left"></div>
    <div class="content_center"></div>
    <div class="content_right"></div>
</div>

<!-- code footer -->
<footer class="footer">
</footer>

</div>
</body>
</html>

<style>
    /* Reset default margin and padding for elements */
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    ul,
    li {
        margin: 0;
        padding: 0;
    }

    /* Set a background color and font styles for the body */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0; /* Light gray background */
        color: #333; /* Dark gray text color */
        line-height: 1.6; /* Line height for better readability */
        margin: 20px; /* Add some margin around the body */
    }

    /* Heading styles */
    h2 {
        margin-bottom: 20px; /* Add spacing below the heading */
    }

    /* Table styles */
    table {
        width: 50%%;
        border-collapse: collapse;
        margin-top: 20px; /* Add spacing above the table */
    }

    table th,
    table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    /* Table header styles */
    table th {
        background-color: #f2f2f2; /* Light gray background for table header */
    }

    /* Table row styles */
    table tr:nth-child(even) {
        background-color: #f9f9f9; /* Alternate row background color */
    }

    /* Links styles */
    a {
        text-decoration: none; /* Remove underline from links */
    }

    a:link,
    a:visited {
        color: blue; /* Blue color for links */
    }

    a:hover {
        color: #0056b3; /* Darker blue on hover */
    }

</style>