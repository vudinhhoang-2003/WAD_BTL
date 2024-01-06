<!-- Hà Tấn Tường-2121050164 -->
<?php
require 'connect.php'; // Kết nối đến cơ sở dữ liệu

if (isset($_GET['tacgia_id'])) {
    $tacgia_id = $_GET['tacgia_id'];

    // Xóa sách thuộc về tác giả cần xóa
    $sql_xoa_sach = "DELETE FROM sach WHERE tacgia_id = $tacgia_id";

    if ($conn->query($sql_xoa_sach) === TRUE) {
        // Tiến hành xóa tác giả sau khi xóa sách thành công
        $sql_xoa_tacgia = "DELETE FROM tacgia WHERE tacgia_id = $tacgia_id";

        if ($conn->query($sql_xoa_tacgia) === TRUE) {
            // Chuyển hướng về trang TacgiaAdmin.php sau khi xóa thành công
            header("Location: TacgiaAdmin.php");
            exit();
        } else {
            echo "Lỗi khi xóa tác giả: " . $conn->error;
        }
    } else {
        echo "Lỗi khi xóa sách của tác giả: " . $conn->error;
    }
} else {
    echo "ID tác giả không hợp lệ";
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();
?>
