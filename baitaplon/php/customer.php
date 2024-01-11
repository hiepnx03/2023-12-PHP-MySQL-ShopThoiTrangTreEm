<?php
require_once("connect.php");
//quản lý danh mục khách hàng
$ma_khachhang = isset($_POST["ma_khachhang"]) ? $_POST["ma_khachhang"] : "";
$tenkhachhang = isset($_POST["tenkhachhang"]) ? $_POST["tenkhachhang"] : "";
$dienthoai = isset($_POST["dienthoai"]) ? $_POST["dienthoai"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$diachi_lienhe = isset($_POST["diachi_lienhe"]) ? $_POST["diachi_lienhe"] : "";
$diachi_giaohang = isset($_POST["diachi_giaohang"]) ? $_POST["diachi_giaohang"] : "";
if (isset($_POST["btn_submit"])) {
    $sql = "SELECT * FROM customer WHERE ma_khachhang ='$ma_khachhang'";
    $rel = mysqli_query($conn, $sql);
    if (mysqli_num_rows($rel) > 0) {
        echo "Đã tồn tại mã khách hàng này";
    } else {
        $sql1 = "INSERT INTO customer VALUE(`ma_khachhang`, `tenkhachhang`, `email`, `phone`, `diachi_lienhe`, `diachi_giaohang`)";
        $rel1 = mysqli_query($conn, $sql1);
        echo "Bạn đã lưu thành công";
    }
}
?>
<table width="800" border="1">
    <h2>Quản lý thông tin khách hàng</h2>
    <tr>
        <td>Mã khách hàng</td>
        <td>Tên khách hàng</td>
        <td>Số điện thoại</td>
        <td>Email</td>
        <td>Địa chỉ liên hệ</td>
        <td>Địa chỉ giao hàng</td>
        <td>Xóa</td>
        <td>Sửa</td>
    </tr>
    <?php
    $sql2 = "SELECT * FROM customer";
    $rel2 = mysqli_query($conn, $sql2);
    while ($r = mysqli_fetch_assoc($rel2)) {
        //var_dump($r);
        ?>
        <tr>
            <td>
                <?php echo $r["ma_khachhang"]; ?>
            </td>
            <td>
                <?php echo $r["tenkhachhang"]; ?>
            </td>
            <td>
                <?php echo $r["phone"]; ?>
            </td>
            <td>
                <?php echo $r["email"]; ?>
            </td>
            <td>
                <?php echo $r["diachi_lienhe"]; ?>
            </td>
            <td>
                <?php echo $r["diachi_giaohang"]; ?>
            </td>
            <td>
                <a href="delete_customer.php?id=<?php echo $r["ma_khachhang"] ?>" style="color:blue">
                    Xóa
                </a>
            </td>
            <td>
                <a href="update_customer.php?id=<?php echo $r["ma_khachhang"] ?>" style="color:blue">
                    Sửa
                </a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</form>

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


    /* Heading styles */
    h2 {
        margin-bottom: 20px; /* Add spacing below the heading */
    }

    /* Table styles */
    table {
        width: 100%;
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

</style>