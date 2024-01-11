<?php
session_start(); // Bắt đầu session để sử dụng trong mã

// Kết nối đến cơ sở dữ liệu
$servername = "127.0.0.1";
$usernameDB = "root";
$passwordDB = ""; // Thay thế bằng mật khẩu của bạn
$dbname = "webthoitrang";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $usernameDB, $passwordDB);
    // Thiết lập chế độ báo lỗi cho PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Kết nối đến cơ sở dữ liệu thất bại: " . $e->getMessage();
    exit(); // Thoát nếu có lỗi kết nối
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        echo "Mật khẩu mới và xác nhận mật khẩu không khớp. Vui lòng thử lại.";
    } else {
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            // Kiểm tra mật khẩu hiện tại của người dùng
            $stmt = $conn->prepare("SELECT password FROM user WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($currentPassword, $user['password'])) {
                // Hash mật khẩu mới trước khi lưu vào cơ sở dữ liệu
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Truy vấn SQL để cập nhật mật khẩu mới cho người dùng
                $updateStmt = $conn->prepare("UPDATE user SET password = :password WHERE username = :username");
                $updateStmt->bindParam(':password', $hashedPassword);
                $updateStmt->bindParam(':username', $username);

                try {
                    $updateStmt->execute();
                    echo "Cập nhật mật khẩu thành công!";
                } catch (PDOException $e) {
                    echo "Lỗi cập nhật mật khẩu: " . $e->getMessage();
                }
            } else {
                echo "Mật khẩu hiện tại không chính xác. Vui lòng thử lại.";
            }
        } else {
            echo "Người dùng không tồn tại.";
        }
    }
}
?>







<form action="/ULSA/baitaplon/php/formdoimk.php" method="POST">
    <label for="current_password">Mật khẩu hiện tại:</label>
    <input type="password" id="current_password" name="current_password" required placeholder="Nhập mật khẩu hiện tại">

    <label for="new_password">Mật khẩu mới:</label>
    <input type="password" id="new_password" name="new_password" required placeholder="Nhập mật khẩu mới">

    <label for="confirm_password">Xác nhận mật khẩu mới:</label>
    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Nhập lại mật khẩu mới">

    <button type="submit" name="change_password">Thay đổi mật khẩu</button>
    <button onclick="goBack()">Quay lại</button>
    <!--    <a href="/ULSA/baitaplon/php/account.php">Quay lại</a>-->
</form>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    .container {
        display: flex;
        justify-content: space-between;
        margin: 20px auto;
        max-width: 1200px;
    }

    .column {
        width: 100%;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .column h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select,
    textarea {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    input[type="radio"] {
        margin-right: 10px;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: #45a049;
    }

</style>