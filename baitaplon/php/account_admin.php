<!-- account_admin.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Cập nhật thông tin người dùng</title>
    <!-- Các liên kết tới CSS và các tài nguyên khác -->
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
    <!-- Bổ sung CSS nếu cần -->
    <!-- ... -->
</head>
<body>

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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Truy vấn để lấy thông tin người dùng dựa trên ID
    $sql = "SELECT * FROM `user` WHERE `id` = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Hiển thị form để cập nhật thông tin người dùng
        ?>
        <h2>Cập nhật thông tin người dùng</h2>
        <form method="post" action="update_user_admin.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <label for="fullname">Họ và tên:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>"><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>

            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>"><br><br>


            <label for="gender">Giới tính:</label>
            <input type="radio" name="gender"
                   value="Nam" <?php echo ($user['gender'] === 'Nam') ? 'checked' : ''; ?>/>Nam
            <input type="radio" name="gender"
                   value="Nữ" <?php echo ($user['gender'] === 'Nữ') ? 'checked' : ''; ?>/>Nữ

            <label for="nationality">Quốc tịch:</label>
            <select name="nationality">
                <option value="Mỹ" <?php echo ($user['nationality'] === 'Mỹ') ? 'selected' : ''; ?>>Mỹ</option>
                <option value="Việt Nam" <?php echo ($user['nationality'] === 'Việt Nam') ? 'selected' : ''; ?>>
                    Việt Nam
                </option>
                <option value="Hàn Quốc" <?php echo ($user['nationality'] === 'Hàn Quốc') ? 'selected' : ''; ?>>
                    Hàn Quốc
                </option>
            </select>

            <label for="address">Địa chỉ:</label>
            <textarea name="address" placeholder="Nhập địa chỉ" cols="50"
                      rows="5"><?php echo $user['address']; ?></textarea>

            <label for="avatar">Avatar:</label>
            <img src="/ULSA/baitaplon/php/images/<?php echo $user['avatar']; ?>" alt="Avatar của người dùng"
                 width="200" height="200">


            <input type="submit" value="Cập nhật">
            <a href="viewuser.php" class="back-button">Trở về</a>
        </form>
        <?php
    } else {
        echo "Không tìm thấy người dùng.";
    }
}

$conn->close();
?>

</body>
</html>


    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 80%;
        margin: 0 auto;
        padding: 20px;
    }
    h2 {
        color: #333;
    }
    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
    }
    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    input[type="submit"] {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .back-button {
        margin-top: 20px;
    }
</style>