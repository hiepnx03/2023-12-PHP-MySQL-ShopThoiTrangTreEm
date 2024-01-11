<?php
// Kết nối đến cơ sở dữ liệu (điều này cần phải được thực hiện ở trước đó)
include('db_connect.php'); // Thay 'db_connect.php' bằng tệp kết nối cơ sở dữ liệu của bạn

// Kiểm tra đăng nhập của người dùng (nếu cần)
session_start();
if (!isset($_SESSION['user_id'])) {
    // Chuyển hướng người dùng đến trang đăng nhập nếu họ chưa đăng nhập
    header('Location: login.php');
    exit();
}

// Xử lý xóa khách hàng (ví dụ: sử dụng id khách hàng)
if (isset($_GET['delete_customer_id'])) {
    $customer_id = $_GET['delete_customer_id'];

    // Thực hiện truy vấn xóa khách hàng từ cơ sở dữ liệu
    $query = "DELETE FROM customers WHERE id = $customer_id";
    // Thực hiện truy vấn (sử dụng mysqli_query hoặc PDO)
    // ...

    // Sau khi xóa, bạn có thể chuyển hướng người dùng hoặc hiển thị thông báo thành công
    // ...

    // Đảm bảo người dùng không nhấp lại nút xóa bằng cách chuyển hướng hoặc sử dụng POST/redirect/GET
    // ...

}

// Lấy danh sách khách hàng từ cơ sở dữ liệu (sử dụng mysqli_query hoặc PDO)
$query = "SELECT * FROM customers";
$result = mysqli_query($db, $query); // Thay $db bằng biến kết nối cơ sở dữ liệu của bạn

?>
<!DOCTYPE html>
<html>
<head>
    <title>Trang Quản trị</title>
</head>
<body>
<h1>Trang Quản trị</h1>
<a href="logout.php">Đăng xuất</a>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
                <a href="admin.php?delete_customer_id=<?php echo $row['id']; ?>">Xóa</a>
                <!--Thêm các nút khác để thực hiện các tác vụ khác -->
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</body>
</html>
