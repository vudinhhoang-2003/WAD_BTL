<!DOCTYPE html>
<html lang="en">
<!-- VŨ ĐÌNH HOÀNG - 2121050409 -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Tác Giả</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function showSuccessMessage() {
            alert("Thông tin sách đã được cập nhật thành công");
        }
    </script>
</head>

<body>

    <div class="container">
        <h2>Thêm Tác Giả</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="showSuccessMessage()">
            <div class="form-group">
                <label for="tentacgia">Tên Tác Giả:</label>
                <input type="text" class="form-control" id="tentacgia" name="tentacgia" required>
            </div>
            <div class="form-group">
                <label for="ngaysinh">Ngày Sinh:</label>
                <input type="date" class="form-control" id="ngaysinh" name="ngaysinh">
            </div>
            <div class="form-group">
                <label for="tieusu">Tiểu Sử:</label>
                <textarea class="form-control" id="tieusu" name="tieusu" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="hinhanh">Hình Ảnh:</label>
                <input type="text" class="form-control" id="hinhanh" name="hinhanh" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm Tác Giả</button>
        </form>

        <?php
        require 'connect.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Xử lý dữ liệu gửi từ form thêm tác giả
            $tentacgia = $_POST['tentacgia'];
            $ngaysinh = $_POST['ngaysinh'];
            $tieusu = $_POST['tieusu'];
            $hinhanh = $_POST['hinhanh'];

            // Validate và thêm dữ liệu vào cơ sở dữ liệu
            $sql = "INSERT INTO tacgia (tentacgia, ngaysinh, tieusu, hinhanh) VALUES ('$tentacgia', '$ngaysinh', '$tieusu', '$hinhanh')";

            if ($conn->query($sql) === TRUE) {
                echo "Thêm tác giả thành công.";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }

            // Sau khi thêm thành công, chuyển hướng về trang danh sách tác giả hoặc trang khác
            header("Location: ThemSach.php");
            // exit;
        }

        $conn->close();
        ?>
    </div>

</body>

</html>
