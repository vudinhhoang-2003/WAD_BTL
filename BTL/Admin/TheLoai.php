<?php
require 'connect.php';

// Truy vấn để lấy thông tin các thể loại
$sql_select = "SELECT * FROM theloai";
$result = $conn->query($sql_select);

// Xử lý chức năng thêm mới
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_theloai"])) {
    $theloai_id = $_POST["theloai_id"];
    $tentheloai = $_POST["tentheloai"];

    $sql_insert = "INSERT INTO theloai (theloai_id, tentheloai) VALUES ('$theloai_id', '$tentheloai')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Thêm mới thể loại thành công.";
    } else {
        echo "Lỗi: " . $sql_insert . "<br>" . $conn->error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin thể loại</title>
</head>
<body>
    <h2>Thông tin các thể loại:</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Tên thể loại</th><th>Thao tác</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["theloai_id"] . "</td>";
            echo "<td>" . $row["tentheloai"] . "</td>";
            echo "<td>
                    <form method='post' action='TheLoai.php' style='display:inline;'>
                        <input type='hidden' name='theloai_id' value='" . $row["theloai_id"] . "'>
                        <input type='text' name='tentheloai' placeholder='Sửa tên thể loại' required>
                        <input type='submit' name='edit_theloai' value='Sửa'>
                    </form>
                    <form method='post' action='TheLoai.php' style='display:inline;'>
                        <input type='hidden' name='theloai_id' value='" . $row["theloai_id"] . "'>
                        <input type='submit' name='delete_theloai' value='Xóa'>
                    </form>
                </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Không có thể loại nào.";
    }
    ?>

    <h2>Chức năng:</h2>
    <!-- Form thêm thể loại -->
    <form method="post" action="TheLoai.php">
        <input type="text" name="theloai_id" placeholder="ID" required>
        <input type="text" name="tentheloai" placeholder="Tên thể loại" required>
        <input type="submit" name="add_theloai" value="Thêm mới">
    </form>

    <?php
    $conn->close();
    ?>
</body>
</html>
