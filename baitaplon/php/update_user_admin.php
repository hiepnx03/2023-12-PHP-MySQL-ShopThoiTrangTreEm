<!-- update_user.php -->

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "webthoitrang";

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $user_id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender']; // Lấy giới tính từ form
    $nationality = $_POST['nationality']; // Lấy quốc tịch từ form
    $address = $_POST['address']; // Lấy địa chỉ từ form
    // Thêm xử lý avatar nếu cần

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
        // Câu truy vấn để cập nhật thông tin người dùng với các trường mới
        $sql = "UPDATE `user` SET `fullname`='$fullname', `email`='$email', `phone`='$phone', `gender`='$gender', `nationality`='$nationality', `address`='$address' WHERE `id`='$user_id'";

        if ($conn->query($sql) === TRUE) {
            // Nếu cập nhật thành công, chuyển hướng về trang viewuser.php
            header("Location: viewuser.php");
            exit(); // Đảm bảo không có mã HTML hoặc các lệnh khác được thực thi sau khi chuyển hướng
        } else {
            echo "Lỗi khi cập nhật thông tin người dùng: " . $conn->error;
        }
    }
}

$conn->close();
?>
