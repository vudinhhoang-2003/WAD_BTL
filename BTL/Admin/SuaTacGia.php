<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin tác giả</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script>
        function showSuccessMessage() {
            alert("Thông tin tác giả đã được cập nhật thành công");
        }
    </script>

</head>

<body>
    <div class="container">
        <?php

        require 'connect.php';
        // Lấy phương thức yêu cầu (GET, POST, v.v.)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu được gửi từ form
            $authorId = $_POST['tacgiaID'];
            $authorName = $_POST['tentacgia'];
            $authorDob = $_POST['ngaysinh'];
            $authorBio = $_POST['tieusu'];
            $authorImage = $_POST['hinhanh'];

            // Truy vấn SQL để cập nhật thông tin tác giả
            $sql = "UPDATE tacgia SET tentacgia = '$authorName', ngaysinh = '$authorDob', tieusu = '$authorBio', hinhanh = '$authorImage' WHERE tacgia_id = $authorId";

            if ($conn->query($sql) === TRUE) {
                header("Location: TacGiaAdmin.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        // Kiểm tra nếu có tham số tacgia_id được gửi đến từ URL
        if (isset($_GET['tacgia_id'])) {
            $tacgia_id = $_GET['tacgia_id'];

            //Truy vấn 
            $sql = "SELECT * FROM tacgia WHERE tacgia_id = $tacgia_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Hiển thị form chỉnh sửa thông tin tác giả
            } else {
                echo "Không tìm thấy thông tin tác giả.";
            }
        } else {
            echo "ID tác giả không hợp lệ";
        }
        $conn->close();
        ?>
        <div class="container">
            <h2>Sửa thông tin tác giả</h2>
            <form action="" method="post" onsubmit="showSuccessMessage()">
                <div class="form-group">
                    <label for="tentacgia">Tên tác giả:</label>
                    <input type="text" class="form-control" name="tentacgia" value="<?php echo $row['tentacgia']; ?>">
                </div>
                <div class="form-group">
                    <label for="ngaysinh">Ngày sinh:</label>
                    <input type="date" class="form-control" name="ngaysinh" value="<?php echo $row['ngaysinh']; ?>">
                </div>
                <div class="form-group">
                    <label for="tieusu">Tiểu sử:</label>
                    <textarea class="form-control" name="tieusu"><?php echo $row['tieusu']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="hinhanh">Link hình ảnh:</label>
                    <input type="text" class="form-control" name="hinhanh" value="<?php echo $row['hinhanh']; ?>">
                </div>
                <input type="hidden" name="tacgiaID" value="<?php echo $row['tacgia_id']; ?>">
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="TacGiaAdmin.php" class="btn btn-default">Quay lại</a>
            </form>
        </div>
    </div>
</body>

</html>