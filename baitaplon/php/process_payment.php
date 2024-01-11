<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "webthoitrang";

    $db = mysqli_connect($servername, $username, $password, $dbname);

    if (!$db) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . mysqli_connect_error());
    }

    // Lấy thông tin thanh toán từ form
    $fullname = mysqli_real_escape_string($db, $_POST["fullname"]);
    $email = mysqli_real_escape_string($db, $_POST["email"]);
    $phone = mysqli_real_escape_string($db, $_POST["phone"]);
    $address = mysqli_real_escape_string($db, $_POST["address"]);
    $note = mysqli_real_escape_string($db, $_POST["note"]);

    // Lấy thông tin giỏ hàng từ session
    $cart = $_SESSION["cart"];

    // Tính tổng số tiền đơn hàng
    $total_money = 0;
    foreach ($cart as $product_id => $quantity) {
        // Truy vấn giá sản phẩm từ cơ sở dữ liệu
        $query = "SELECT price FROM Product WHERE id = $product_id";
        $result = mysqli_query($db, $query);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $price = $row["price"];
            $total_money += $price * $quantity;
        }
    }

    // Thêm thông tin đơn hàng vào cơ sở dữ liệu
    $query = "INSERT INTO Orders (user_id, fullname, email, phone_number, address, note, order_date, status, total_money) 
              VALUES (1, '$fullname', '$email', '$phone', '$address', '$note', NOW(), 1, $total_money)";

    if (mysqli_query($db, $query)) {
        $order_id = mysqli_insert_id($db);

        // Thêm chi tiết đơn hàng vào cơ sở dữ liệu
        foreach ($cart as $product_id => $quantity) {
            $query = "INSERT INTO Order_Details (order_id, product_id, price, num, total_money) 
                      VALUES ($order_id, $product_id, $price, $quantity, " . ($price * $quantity) . ")";
            mysqli_query($db, $query);
        }

        // Đã xử lý xong đơn hàng, có thể xóa giỏ hàng
        unset($_SESSION["cart"]);

        // Đóng kết nối cơ sở dữ liệu
        mysqli_close($db);

        // Chuyển hướng người dùng đến trang cảm ơn hoặc trang xác nhận đơn hàng
        header("Location: /ULSA/baitaplon/php/thank_you.php");
        exit();
    } else {
        // Xử lý lỗi nếu có
        echo "Lỗi: " . mysqli_error($db);
    }
} else {
    // Xử lý lỗi nếu có
    echo "Lỗi: Không thể xử lý thanh toán.";
}
?>
