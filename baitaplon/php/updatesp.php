<!DOCTYPE html>
<html>
<body>
<div class="admin">
    <div class="admin_col1">
        <div class="admin_col1_left">
            <a href="sell.php?action=adproducttype">quản lý danh mục loại sản phẩm</a>
        </div>
        <div class="admin_col1_left">
            <a href="sell.php?action=adproduct">quản lý danh mục sản phẩm</a>
        </div>
    </div>
    <div class="admin_col2">
        <!--Nội dung-->
        <?php
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "webthoitrang";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }


        $id = $_GET["id"];
        $sql = "SELECT * FROM adproduct WHERE ma_sp = '$id'";
        $rel = mysqli_query($conn, $sql);
        $sanpham = mysqli_fetch_assoc($rel);

        if (!$sanpham) {
            echo "Không tìm thấy sản phẩm";
            exit();
        }

        $txt_maloaisp = isset($_POST["dropdown"]) ? $_POST["dropdown"] : $sanpham['ma_loaisp'];
        $txt_ma_sp = isset($_POST["txt_ma_sp"]) ? $_POST["txt_ma_sp"] : $sanpham['ma_sp'];
        $txt_tensp = isset($_POST["txt_tensp"]) ? $_POST["txt_tensp"] : $sanpham['tensp'];
        $txt_hinhanh = isset($_FILES["hinhanh"]) ? $_FILES["hinhanh"]["name"] : $sanpham['hinhanh'];
        $txt_gianhap = isset($_POST["txt_gianhap"]) ? $_POST["txt_gianhap"] : $sanpham['gianhap'];
        $txt_giaxuat = isset($_POST["txt_giaxuat"]) ? $_POST["txt_giaxuat"] : $sanpham['giaxuat'];
        $txt_soluong = isset($_POST["txt_soluong"]) ? $_POST["txt_soluong"] : $sanpham['soluong'];
        $txt_khuyenmai = isset($_POST["txt_khuyenmai"]) ? $_POST["txt_khuyenmai"] : $sanpham['khuyenmai'];
        $txt_mota_sp = isset($_POST["txt_mota_sp"]) ? $_POST["txt_mota_sp"] : $sanpham['mota_sp'];
        $txt_create_date = isset($_POST["txt_create_date"]) ? $_POST["txt_create_date"] : $sanpham['create_date'];

        $txt_hinhanh = $sanpham['hinhanh']; // Giữ nguyên tên ảnh ban đầu nếu không có file mới được tải lên
        if (!empty($_FILES["hinhanh"]["name"])) {
            $file_name = $_FILES["hinhanh"]["name"];
            $file_tmp = $_FILES["hinhanh"]["tmp_name"];
            $upload_dir = "images/" . $file_name;
            move_uploaded_file($file_tmp, $upload_dir);
            $txt_hinhanh = $file_name; // Cập nhật tên file ảnh mới
        }


        if (isset($_POST["btn_update"])) {
            $sql1 = "UPDATE adproduct SET ma_loaisp = '$txt_maloaisp',  tensp = '$txt_tensp', hinhanh = '$txt_hinhanh', gianhap = '$txt_gianhap', giaxuat = '$txt_giaxuat', soluong = '$txt_soluong', khuyenmai = '$txt_khuyenmai', mota_sp = '$txt_mota_sp', create_date = '$txt_create_date' WHERE ma_sp = '$id'";
            $rel1 = mysqli_query($conn, $sql1);
            echo "Bạn đã cập nhật thành công";
//            header('location: sell.php?action=adproducttype');
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table border="1">
                <?php
                ?>
                <tr>
                    <td>Mã loại sản phẩm</td>
                    <td>
                        <?php
                        echo '<select name="dropdown">';
                        echo '<option ';
                        echo 'value="' . $txt_maloaisp . '">' . $txt_maloaisp . '</option>';
                        echo '</select>';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Mã sản phẩm</td>
                    <td>
                        <?php echo $txt_ma_sp; ?><input type="text" name="txt_masp" value="<?php echo $txt_ma_sp; ?>"
                    </td>
                </tr>
                <tr>
                    <td>Tên sản phẩm</td>
                    <td>
                        <input type="text" name="txt_tensp" value="<?php echo $txt_tensp; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Hình ảnh
                    </td>
                    <?php
                    if (isset($_FILES["hinhanh"])) {
                        $file_name = $_FILES["hinhanh"]["name"]; //tên file
                        $file_tmp = $_FILES["hinhanh"]["tmp_name"];
                        if (empty($errors) == true) {
                            move_uploaded_file($file_tmp, "images/" . $file_name);
                        }
                    }
                    ?>
                    <td>
                        <input type="file" name="hinhanh" value="<?php echo $txt_hinhanh; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Giá nhập</td>
                    <td>
                        <input type="text" name="txt_gianhap" value="<?php echo $txt_gianhap; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Giá xuất</td>
                    <td>
                        <input type="text" name="txt_giaxuat" value="<?php echo $txt_giaxuat; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Số lượng
                    </td>
                    <td>
                        <input type="text" name="txt_soluong" value="<?php echo $txt_soluong; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Khuyến mãi
                    </td>
                    <td>
                        <input type="text" name="txt_khuyenmai" value="<?php echo $txt_khuyenmai; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Mô tả sản phẩm
                    </td>
                    <td>
                        <input type="text" name="txt_mota_sp" value="<?php echo $txt_mota_sp; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        Ngày tạo
                    </td>
                    <td>
                        <input type="date" name="txt_ngaytao" value="<?php echo $txt_create_date; ?>">
                    </td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" value="Sửa" name="btn_update">
                        <a href="sell.php?action=adproducttype">Trở lại</a>
                    </th>
                </tr>
            </table>
        </form>
    </div>
</div>

</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .admin {
        display: flex;
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
    }

    .admin_col1 {
        width: 20%;
        background-color: #333;
        color: #fff;
    }

    .admin_col1_left {
        padding: 10px;
    }

    .admin_col1_left a {
        display: block;
        color: #fff;
        text-decoration: none;
        margin-bottom: 10px;
    }

    .admin_col1_left a:hover {
        color: #ff0;
    }

    .admin_col2 {
        width: 80%;
        padding: 20px;
    }

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
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    input[type="text"],
    input[type="file"],
    input[type="date"],
    button {
        padding: 8px;
        margin-bottom: 10px;
        width: calc(100% - 16px);
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    a {
        text-decoration: none;
        color: #4CAF50;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

