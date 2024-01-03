<?php
require 'connect.php';
// VŨ ĐÌNH HOÀNG - 2121050409
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['Username'];
    $password = $_POST['Password'];

    // Bảo vệ khỏi SQL injection
    $id = mysqli_real_escape_string($conn, $id);
    $password = mysqli_real_escape_string($conn, $password);

    // Kiểm tra tên đăng nhập có tồn tại không
    $sql = "SELECT username, password FROM admins WHERE username ='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        echo "Tên đăng nhập không tồn tại hoặc sai mật khẩu. Vui lòng kiểm tra lại. <a href='login.html'>Trở lại</a>";
        exit;
    }

    // Lấy mật khẩu trong database ra
    $row = $result->fetch_assoc();

    // So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['password']) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a  href='login.html'>Trở lại</a>";
        exit;
    }

    // Lưu đăng nhập
    session_start();
    $_SESSION['username'] = $id;

    // Chuyển hướng đến trang chủ tương ứng
    header("Location: HomeAdmin.php");
    exit;
} else {
    // Redirect về trang đăng nhập nếu không phải là phương thức POST
    header("Location: login.html");
    exit;
}
?>
