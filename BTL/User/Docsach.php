<!DOCTYPE html>
<html lang="en">
<!-- VŨ ĐÌNH HOÀNG - 2121050409 -->
<head>
  <link rel="stylesheet" href="../CSS/Home.css">
  <title>Đọc sách</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div class="logo text-left">
            <a href="Home.php"><img src="../Images/logo.png" alt="Logo"></a>
          </div>
        </div>
        <div class="col-md-8">
          <h1 class="display-4">Đọc Sách Mỗi Ngày</h1>
        </div>
      </div>
    </div>
  </header>


  <?php
  require 'connect.php';

  // Truy vấn để lấy thông tin các thể loại
  $sql_select = "SELECT * FROM theloai";
  $result = $conn->query($sql_select);

  // Kiểm tra kết quả truy vấn
  if ($result->num_rows > 0) {
      $theloai_dropdown = "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Thể loại<span class='caret'></span></a><ul class='dropdown-menu' style='background: lightyellow;'>";

      while ($row = $result->fetch_assoc()) {
          $theloai_dropdown .= "<li><a href='" . $row['duongdan'] . "'>" . $row['tentheloai'] . "</a></li>";
      }

      $theloai_dropdown .= "</ul></li>";
  } else {
      $theloai_dropdown = "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'>Thể loại<span class='caret'></span></a><ul class='dropdown-menu' style='background: lightyellow;'><li>Không có thể loại nào.</li></ul></li>";
  }

  $conn->close();
  ?>

  <!-- Thanh menu -->
  <nav class="navbar navbar-inverse">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="Home.php" style="color: green;">DocSachOnline</a>
          </div>
          <ul class="nav navbar-nav">
              <li class="active"><a href="Home.php">Trang chủ</a></li>
              <?php echo $theloai_dropdown; ?>
              <li><a href="Tacgia.php">Tác giả</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="Timkiem.php">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Tìm kiếm" name="search">
              </div>
              <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
          </form>
      </div>
  </nav>

  <!-- Main -->
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2"> <!-- chiếm 8/12, căn ra giữa-->
        <?php
        require 'connect.php';

        // Kiểm tra xem có tham số sach_id được truyền không
        if (isset($_GET['sach_id'])) {
          $sach_id = $_GET['sach_id'];

          // Thực hiện truy vấn để lấy thông tin chi tiết của sách
          $sql = "SELECT sach.*, tacgia.tentacgia
                         FROM sach
                         LEFT JOIN tacgia ON sach.tacgia_id = tacgia.tacgia_id
                         WHERE sach.sach_id = $sach_id"; // Thêm điều kiện để chỉ lấy thông tin của sách cụ thể
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Hiển thị thông tin chi tiết của sách
            echo '<h1 style = "color: brown">' . $row["tensach"] . '</h1>';

            if (isset($row["tentacgia"])) {
              echo '<a style = "text-decoration: none" href="ThongTinTacGia.php?tacgia_id=' . $row["tacgia_id"] . '"><h3>' . $row["tentacgia"] . '</h3></a>';
            } else {
              echo '<h5>Tác giả không xác định</h5>';
            }
            echo '<h4>' . $row["ngayxuatban"] . '</h4>';
            echo '<p>Nội dung: ' . $row["noidung"] . '</p>';
          } else {
            echo "Không tìm thấy thông tin sách.";
          }
        } else {
          echo "Thiếu tham số sach_id.";
        }

        // Đóng kết nối
        $conn->close();
        ?>
      </div>
    </div>
  </div>


  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h4>Liên hệ</h4>
          <p>Địa chỉ: HNAB205 - HUMG</p>
          <p>Email: hoangvudinh061@gmail.com</p>
          <p>Điện thoại: 0123456789</p>
        </div>
        <div class="col-md-4">
          <h4>Bản quyền</h4>
          <p>&copy; 2023 Vũ Đình Hoàng </p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>
