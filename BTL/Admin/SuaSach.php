<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sửa sách_Hà Tấn Tường-2121050164</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script>
        function showSuccessMessage() {
            alert("Thông tin sách đã được cập nhật thành công");
        }
    </script>
</head>

<body>

    <div class="container">
        <h2>Sửa thông tin sách</h2>

        <?php
        require 'connect.php';
        // Lấy phương thức yêu cầu (GET, POST, v.v.)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy thông tin từ form
            $sach_id = $_POST['sach_id'];
            $tensach = $_POST['tensach'];
            $tacgia_id = $_POST['tacgia_id'];
            $ngayxuatban = $_POST['ngayxuatban'];
            $theloai_id = $_POST['theloai_id'];
            $hinhanh = $_POST['hinhanh'];
            $mota = $_POST['mota'];
            $noidung = $_POST['noidung'];

            // Cập nhật thông tin sách trong cơ sở dữ liệu
            $sql = "UPDATE sach SET tensach='$tensach', tacgia_id='$tacgia_id', ngayxuatban='$ngayxuatban', theloai_id='$theloai_id', hinhanh='$hinhanh', mota='$mota', noidung='$noidung' WHERE sach_id='$sach_id'";

            if ($conn->query($sql) === TRUE) {
                header("Location: HomeAdmin.php");
                exit;
            } else {
                echo "Lỗi: " . $conn->error;
            }
        }

        // Kiểm tra nếu có tham số sach_id được gửi đến từ URL
        if (isset($_GET['sach_id'])) {
            $sach_id = $_GET['sach_id'];

            // Lấy thông tin sách, tác giả từ cơ sở dữ liệu
            $sql = "SELECT sach.*, tacgia.tentacgia
                FROM sach
                LEFT JOIN tacgia ON sach.tacgia_id = tacgia.tacgia_id
                WHERE sach.sach_id = $sach_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "Không tìm thấy thông tin sách.";
            }
        } else {
            echo "ID sách không hợp lệ";
        }
        ?>

        <!-- Form chỉnh sửa thông tin sách -->
        <form action="" method="post" onsubmit="showSuccessMessage()">
            <div class="form-group">
                <label for="tensach">Tên sách:</label>
                <input type="text" class="form-control" name="tensach" value="<?php echo $row['tensach']; ?>">
            </div>
            <div class="form-group">
                <label for="tentacgia">Tên tác giả:</label>
                <select class="form-control" name="tacgia_id">
                    <?php
                    $sql_tacgia = "SELECT * FROM tacgia";
                    $result_tacgia = $conn->query($sql_tacgia);
                    if ($result_tacgia->num_rows > 0) {
                        while ($row_tacgia = $result_tacgia->fetch_assoc()) {
                            echo '<option value="' . $row_tacgia['tacgia_id'] . '"';
                            if ($row_tacgia['tacgia_id'] == $row['tacgia_id']) {
                                echo ' selected';
                            }
                            echo '>' . $row_tacgia['tentacgia'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ngayxuatban">Ngày xuất bản:</label>
                <input type="date" class="form-control" name="ngayxuatban" value="<?php echo $row['ngayxuatban']; ?>">
            </div>
            <div class="form-group">
                <label for="theloai_id">Thể Loại:</label>
                <select class="form-control" name="theloai_id" required>
                    <?php
                    $sql_theloai = "SELECT theloai_id, tentheloai FROM theloai";
                    $result_theloai = $conn->query($sql_theloai);
                    while ($row_theloai = $result_theloai->fetch_assoc()) {
                        echo '<option value="' . $row_theloai["theloai_id"] . '">' . $row_theloai["tentheloai"] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="hinhanh">Link hình ảnh:</label>
                <input type="text" class="form-control" name="hinhanh" value="<?php echo $row['hinhanh']; ?>">
            </div>
            <div class="form-group">
                <label for="mota">Mô tả:</label>
                <textarea class="form-control" name="mota"><?php echo $row['mota']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="noidung">Nội dung:</label>
                <textarea class="form-control" name="noidung"><?php echo $row['noidung']; ?></textarea>
            </div>
            <input type="hidden" name="sach_id" value="<?php echo $row['sach_id']; ?>">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            <a href="HomeAdmin.php" class="btn btn-default">Quay lại</a>
        </form>
        
        <?php
        $conn->close();
        ?>
    </div>


</body>

</html>