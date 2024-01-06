<!-- <h1>Hà Tấn Tường-2121050164</h1> -->
<?php
// Kết nối đến cơ sở dữ liệu
include 'connect.php';

// Kiểm tra nếu biến GET chứa sach_id và không rỗng
if (isset($_GET['sach_id']) && !empty($_GET['sach_id'])) {
    $sach_id = $_GET['sach_id'];

    // Tạo câu truy vấn DELETE để xóa sách dựa trên sach_id
    $sql_xoa_sach = "DELETE FROM sach WHERE sach_id = $sach_id";

    // Thực hiện truy vấn xóa sách
    if ($conn->query($sql_xoa_sach) === TRUE) {
        // Chuyển hướng về trang gốc sau khi xóa thành công
        header("Location: HomeAdmin.php");
        exit();
    } else {
        // Hiển thị thông báo lỗi nếu có
        echo "Lỗi khi xóa sách: " . $conn->error;
    }
} else {
    // Hiển thị thông báo nếu sach_id không hợp lệ
    echo "Sách không tồn tại hoặc không xác định";
}

// Đóng kết nối cơ sở dữ liệu
$conn->close();
?>
