
<!-- VŨ ĐÌNH HOÀNG - 2121050409 -->
<?php
    require 'connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Xử lý dữ liệu gửi từ form thêm sách
        $tensach = $_POST['tensach'];
        $tacgia_id = $_POST['tacgia_id'];
        $ngayxuatban = $_POST['ngayxuatban'];
        $theloai_id = $_POST['theloai_id'];
        $hinhanh = $_POST['hinhanh'];
        $noidung = $_POST['noidung'];

        // Validate và thêm dữ liệu vào cơ sở dữ liệu
        $sql_them_sach = "INSERT INTO sach (tensach, tacgia_id, ngayxuatban, theloai_id, hinhanh, mota, noidung)
                        VALUES ('$tensach', '$tacgia_id', '$ngayxuatban', '$theloai_id', '$hinhanh', '$noidung')";

        if ($conn->query($sql_them_sach) === TRUE) {
            // Sau khi thêm thành công, chuyển hướng về trang chủ
            header("Location: HomeAdmin.php");
            exit;
        } else {
            echo "Error: " . $sql_them_sach . "<br>" . $conn->error;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Thêm Sách</title>

    <script>
        function showSuccessMessage() {
            alert("Thông tin sách đã được thêm thành công");
        }
    </script>
</head>

<body>

    <div class="container">
        <h2>Thêm Sách</h2>
        <form action="ThemSach.php" method="post" onsubmit="showSuccessMessage()">

            <div class="form-group">
                <label for="tensach">Tên Sách:</label>
                <input type="text" class="form-control" name="tensach" required>
            </div>

            <div class="form-group">
                <label for="tacgia_id">Tác Giả:</label>
                <div class="input-group">
                    <select class="form-control" name="tacgia_id" required>
                        <?php
                        $sql_tacgia = "SELECT tacgia_id, tentacgia FROM tacgia";
                        $result_tacgia = $conn->query($sql_tacgia);
                        while ($row_tacgia = $result_tacgia->fetch_assoc()) {
                            echo '<option value="' . $row_tacgia["tacgia_id"] . '">' . $row_tacgia["tentacgia"] . '</option>';
                        }
                        ?>
                    </select>
                    <div class="input-group-btn">
                        <a href="ThemTacGia.php" class="btn btn-primary text-r">Thêm mới</a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="ngayxuatban">Ngày Xuất Bản:</label>
                <input type="date" class="form-control"  name="ngayxuatban" required>
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
                <label for="hinhanh">Hình Ảnh:</label>
                <input type="text" class="form-control"  name="hinhanh" required>
            </div>


            <div class="form-group">
                <label for="noidung">Nội Dung:</label>
                <textarea class="form-control" name="noidung" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Sách</button>
        </form>
    </div>

</body>

</html>
