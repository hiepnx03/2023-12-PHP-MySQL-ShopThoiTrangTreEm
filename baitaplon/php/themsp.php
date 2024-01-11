<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
if (isset($_POST["btn_save"])) {
    // Validate and retrieve form data
    $ma_loaisp = isset($_POST["ma_loaisp"]) ? $_POST["ma_loaisp"] : "";
    $ma_sp = isset($_POST["ma_sp"]) ? $_POST["ma_sp"] : "";
    $ten_sp = isset($_POST["ten_sp"]) ? $_POST["ten_sp"] : "";
    $gianhap = isset($_POST["gianhap"]) ? $_POST["gianhap"] : "";
    $giaxuat = isset($_POST["giaxuat"]) ? $_POST["giaxuat"] : "";
    $khuyenmai = isset($_POST["khuyenmai"]) ? $_POST["khuyenmai"] : "";
    $soluong = isset($_POST["soluong"]) ? $_POST["soluong"] : "";
    $mota_sp = isset($_POST["mota_sp"]) ? $_POST["mota_sp"] : "";
    $create_date = isset($_POST["create_date"]) ? $_POST["create_date"] : "";

    // File upload handling
    $hinhanh = "";
    if (isset($_FILES["hinhanh"]) && $_FILES["hinhanh"]["error"] === 0) {
        $file_name = $_FILES["hinhanh"]["name"];
        $file_tmp = $_FILES["hinhanh"]["tmp_name"];
        $upload_path = "images/" . $file_name;

        // Move the uploaded file to the destination folder
        if (move_uploaded_file($file_tmp, $upload_path)) {
            $hinhanh = $file_name; // Set the image name for database insertion
        } else {
            echo "File upload failed!";
        }
    }

    // Check if the product already exists
    $sql = "SELECT * FROM adproduct WHERE ma_sp='$ma_sp'";
    $rel = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rel) > 0) {
        echo "Đã tồn tại mã sản phẩm này";
        header('location: sell.php?action=adproducttype');
    } else {
        // Insert new product
        $sql2 = "INSERT INTO adproduct VALUES ('$ma_loaisp', '$ma_sp', '$ten_sp', '$hinhanh', '$gianhap', '$giaxuat', '$khuyenmai', '$soluong', '$mota_sp', '$create_date')";
        $rel2 = mysqli_query($conn, $sql2);
        echo "Đã nhập thành công";
    }
}
?>
<form action="themsp.php" method="post" enctype="multipart/form-data" >
    <table width="600" border="1">
        <tr><td colspan="2"style="text-align: center">Thêm mới sản phẩm</td></tr>
        <tr>
            <td>Mã loại sản phẩm</td>
            <td>
                <?php
                $sql="SELECT * FROM adproducttype ";
                $rel=mysqli_query($conn,$sql);
                ?>
                <select name="ma_loaisp">
                    <?php
                    if(mysqli_num_rows($rel)>0){
                        while ($r=mysqli_fetch_assoc($rel)){
                            ?>
                            <option value="<?php echo $r["ma_loaisp"]?>">
                                <?php echo $r["ma_loaisp"]?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Mã sản phẩm</td>
            <td><input name="ma_sp" type="text"></td>
        </tr>
        <tr>
            <td>Tên sản phẩm</td>
            <td><input name="ten_sp" type="text"></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <?php
            if (isset($_FILES["hinhanh"])) {
                $file_name = $_FILES["hinhanh"]["name"]; //tên file
                $file_tmp = $_FILES["hinhanh"]["tmp_name"];
                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "images/" . $file_name);
                }
            }
            ?>
            <td><input type="file" name="hinhanh"></td>

        </tr>
        <tr>
            <td>Giá nhập</td>
            <td><input name="gianhap" type="text"></td>
        </tr>
        <tr>
            <td>Giá xuất</td>
            <td><input name="giaxuat" type="text"></td>
        </tr>
        <tr>
            <td>Khuyến mại</td>
            <td><input name="khuyenmai" type="text"></td>
        </tr>
        <tr>
            <td>Số lượng</td>
            <td><input name="soluong" type="text"></td>
        </tr>
        <tr>
            <td>Mô tả sản phẩm</td>
            <td><textarea name="mota_sp" cols="40" rows="5" style="width: 800px">
     </textarea></td>
        </tr>
        <tr>
            <td>Ngày tạo</td>
            <td><input name="create_date" type="date"></td>
        </tr>
        <tr>
            <td colspan="2"><input name="btn_save" type="submit" value="Cập nhật" ></td>
        </tr>
    </table>
</form>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Style cho form */
    form {
        margin-top: 20px;
        border: 1px solid #ccc;
        padding: 20px;
        width: 100%;
    }

    input[type="text"], button {
        padding: 8px;
        margin-bottom: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
</style>