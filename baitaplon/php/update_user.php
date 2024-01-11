<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if (isset($_POST['update'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Bạn cần xử lý mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $address = $_POST['address'];

    // Xử lý tập tin ảnh đại diện mới nếu được tải lên
    if (isset($_FILES['new_avatar']) && $_FILES['new_avatar']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "/ULSA/baitaplon/php/images/";
        $target_file = $target_dir . basename($_FILES["new_avatar"]["name"]);

        // Di chuyển tệp tải lên vào thư mục lưu trữ ảnh
        if (move_uploaded_file($_FILES["new_avatar"]["tmp_name"], $target_file)) {
            // Lưu tên file ảnh vào cơ sở dữ liệu
            $avatar = basename($_FILES["new_avatar"]["name"]);

            // Cập nhật thông tin người dùng với ảnh đại diện mới
            $sql = "UPDATE `User` SET `fullname`='$fullname', `email`='$email', `password`='$password', `phone`='$phone', `gender`='$gender', `nationality`='$nationality', `address`='$address', `avatar`='$avatar' WHERE `username`='{$_SESSION['username']}'";

            if ($conn->query($sql) === TRUE) {
                $_SESSION['success_message'] = "Cập nhật thông tin thành công";
            } else {
                $_SESSION['error_message'] = "Lỗi khi cập nhật thông tin: " . $conn->error;
            }
        } else {
            $_SESSION['error_message'] = "Có lỗi khi tải lên ảnh đại diện mới.";
        }
    } else {
        // Nếu không có ảnh đại diện mới, chỉ cập nhật thông tin khác của người dùng
        $sql = "UPDATE `User` SET `fullname`='$fullname', `email`='$email', `password`='$password', `phone`='$phone', `gender`='$gender', `nationality`='$nationality', `address`='$address' WHERE `username`='{$_SESSION['username']}'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Cập nhật thông tin thành công";
            header('location: sell.php?action=adproduct');
        } else {
            $_SESSION['error_message'] = "Lỗi khi cập nhật thông tin: " . $conn->error;
        }
    }
}

$conn->close();

header("Location: /ULSA/baitaplon/php/account.php");
exit();
?>
