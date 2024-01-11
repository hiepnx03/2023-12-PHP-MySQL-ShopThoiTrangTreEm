<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    $email_or_username = $_POST["email"];

    // Check if the email or username exists in the database
    $sql = "SELECT * FROM users WHERE email = ? OR username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email_or_username, $email_or_username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Generate a unique reset token (you can use a function to create a token)
        $reset_token = generateResetToken();

        // Store the reset token in the database for the user
        $sql = "UPDATE users SET reset_token = ? WHERE email = ? OR username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $reset_token, $email_or_username, $email_or_username);
        $stmt->execute();

        // Send an email with the reset link containing the token
        $to = $_POST["email"];
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: \n";
        $message .= "http://example.com/reset_password.php?token=" . $reset_token;
        $headers = "From: webmaster@example.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "Yêu cầu đặt lại mật khẩu đã được gửi qua email.";
        } else {
            echo "Có lỗi xảy ra khi gửi yêu cầu đặt lại mật khẩu qua email.";
        }
    } else {
        echo "Không tìm thấy email hoặc tên đăng nhập trong cơ sở dữ liệu.";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}

// Function to generate a unique reset token (you can implement this)
function generateResetToken() {
    // Generate and return a unique token
    return bin2hex(random_bytes(32)); // Example, you can use a more secure method
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Thêm tệp CSS cho trang giỏ hàng -->
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>

<header>
    <h1>Thời trang trẻ em</h1>
    <nav>
        <ul>
            <li><a href="/ULSA/baitaplon/php/welcome.php">Trang chủ</a></li>
            <li><a href="/ULSA/baitaplon/php/login.php">Đăng nhập</a></li>
            <li><a href="/ULSA/baitaplon/php/register.php">Đăng ký</a></li>
        </ul>
    </nav>
</header>
<h2>Quên mật khẩu?</h2>
<form action="/ULSA/baitaplon/php/reset_password.php" method="POST">
    <label for="email">Email hoặc Tên đăng nhập:</label>
    <input type="text" id="email" name="email" required>

    <!--    <label for="password">Nhập mật khẩu đã quên:</label>-->
    <!--    <input type="text" id="email" name="email" required>-->

    <br>
    <button type="submit" name="reset_password">Gửi yêu cầu đặt lại mật khẩu</button>
</form>


<style>
    /* CSS cho form "Quên mật khẩu?" */

    /* Định dạng form và đặt nó vào giữa khung hình */
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

    }

    h2 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;

    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button[type="submit"] {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 0 auto; /* Đặt nút ở giữa khung hình */
    }
    button[type="submit"]:hover {
        background-color: #555;
    }
</style>