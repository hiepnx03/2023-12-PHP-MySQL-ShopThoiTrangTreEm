<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "webthoitrang";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    $user_name = $_POST['user_name'];
    $user_feedback = $_POST['user_feedback'];

    $sql = "INSERT INTO `feedback` (`noi_dung`, `nguoi_gui`, `ngay_gui`) VALUES ('$user_feedback', '$user_name', NOW())";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['feedback_success'] = "Phản hồi của bạn đã được gửi đi thành công!";
        header('Location: viewfeedback.php'); // Redirect để tránh việc gửi lại dữ liệu khi người dùng refresh trang
        exit();
    } else {
        echo "Lỗi khi gửi phản hồi: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ý kiến góp ý</title>
    <link rel="stylesheet" href="/ULSA/baitaplon/css/style.css">
</head>
<body>
<!-- Header và các phần còn lại của trang -->

<div class="main">
    <div class="feedback-section">
        <h2 style="text-align: center">Ý kiến góp ý</h2>
        <?php
        if (isset($_SESSION['feedback_success'])) {
            echo '<p>' . $_SESSION['feedback_success'] . '</p>';
            unset($_SESSION['feedback_success']);
        }
        ?>

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <table>
                <tr>
                    <td><label for="user_name">Tên người gửi:</label></td>
                    <td><input type="text" id="user_name" name="user_name" required></td>
                </tr>
                <tr>
                    <td><label for="user_feedback">Nhập ý kiến góp ý:</label></td>
                    <td><textarea id="user_feedback" name="user_feedback" rows="4" cols="50" required></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Gửi ý kiến"></td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Footer -->
    <footer class="footer">
    </footer>
</div>
</body>
</html>


<style>
    /* style.css */

    /* Các định dạng chung */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
    }

    /* Header */
    header {
        background-color: #444;
        color: white;
        padding: 20px;
        text-align: center;
    }

    /* Navbar */
    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 10px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
    }

    /* Form */
    form {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    form input[type="text"],
    form textarea {
        width: calc(100% - 12px);
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    form textarea {
        height: 100px;
    }

    form input[type="submit"] {
        padding: 10px 20px;
        background-color: #444;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #333;
    }

</style>