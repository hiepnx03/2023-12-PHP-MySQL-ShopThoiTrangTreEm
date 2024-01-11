<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $maloai = $_POST['txt_maloaisp'];
    $tenloai = $_POST['txt_tenloaisp'];
    $mota = $_POST['txt_motaloaisp'];

    // Thêm dữ liệu vào cơ sở dữ liệu sử dụng Prepared Statements
    $sql_insert = "INSERT INTO adproducttype (ma_loaisp, ten_loaisp, mota_loaisp) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql_insert);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $maloai, $tenloai, $mota);
        mysqli_stmt_execute($stmt);

        // Kiểm tra xem có dữ liệu được thêm thành công không
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Thêm dữ liệu thành công.";
            header('Location: sell.php?action=adproducttype');
        } else {
            echo "Không thể thêm dữ liệu.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

// Đóng kết nối
mysqli_close($conn);
?>
<form method="post" action="adproducttype.php">
    <table>
        <tr>
            <td><input name="txt_maloaisp" type="text" placeholder="mã sản phẩm"></td>
            <td><input name="txt_tenloaisp" type="text" placeholder="tên sản phẩm"></td>
            <td><input name="txt_motaloaisp" type="text" placeholder="mô tả sản phẩm"></td>
            <td><button type="submit">Thêm mới</button></td>
        </tr>
    </table>
    <table>
        <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "webthoitrang";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Truy vấn dữ liệu từ bảng adproducttype
        $sql_select = "SELECT * FROM adproducttype";
        $result = mysqli_query($conn, $sql_select);

        if (mysqli_num_rows($result) > 0) {
            // Hiển thị dữ liệu trong bảng
            echo "<table border='1'>
            <h2 style='text-align: center'>Quản lý danh mục sản phẩm</h2>
            <tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả sản phẩm</th>
                <th>Xóa</th>
                <th>Sửa</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ma_loaisp'] . "</td>";
                echo "<td>" . $row['ten_loaisp'] . "</td>";
                echo "<td>" . $row['mota_loaisp'] . "</td>";
                echo "<td><a href='xoasp.php?id=" . $row['ma_loaisp'] . "' style='color:blue'>Xóa</a></td>";
                echo "<td><a href='updateloaisp.php?id=" . $row['ma_loaisp'] . "' style='color:blue'>sửa</a></td>";
                echo "</tr>";
            }


            echo "</table>";
        } else {
            echo "Không có dữ liệu.";
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </table>
</form>

<style>
    /* Style cho bảng */
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
