<?php
//  VŨ ĐÌNH HOÀNG - 2121050409
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header("Location: login.html");
    exit;
}
// echo $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../CSS/HomeAdmin.css">
  <title>Trang chủ</title>
  <meta charset="utf-8">
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
            <a href="HomeAdmin.php"><img src="../Images/logo.png" alt="Logo"></a>
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
              <a class="navbar-brand" href="HomeAdmin.php" style="color: green;">DocSachOnline</a>
          </div>
          <ul class="nav navbar-nav">
              <li class="active"><a href="HomeAdmin.php">Trang chủ</a></li>
              <?php echo $theloai_dropdown; ?>
              <li><a href="TheLoai.php">Sửa thể loại</a></li>
              <li><a href="TacGiaAdmin.php">Tác giả</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="Timkiem.php">
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="Tìm kiếm" name="search">
              </div>
              <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
          </form>
          <a href="login.html" class="btn btn-danger navbar-btn navbar-right">Logout</a>
      </div>
  </nav>


  <!-- Nút Thêm -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="ThemSach.php" class="btn btn-primary text-r">Thêm Sách</a>
      </div>
    </div>
  </div>

  <!-- Nội dung chính -->
  <main>
    <section>
      <?php
          if (isset($_SESSION['username'])) {
            echo '<div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <p>Xin chào, ' . $_SESSION['username'] . '!</p>
                      </div>
                    </div>
                  </div>';
            }
      ?>
      <div class="container">
        <div class="row">
          <?php
          require 'connect.php';

          $sql = "SELECT sach.*, tacgia.tentacgia
                  FROM sach
                  LEFT JOIN tacgia ON sach.tacgia_id = tacgia.tacgia_id";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-3">
                <div class="thumbnail">
                    <img src="../Images/' . $row["hinhanh"] . '" alt="' . $row["tensach"] . '" class="img-responsive">
                    <div class="caption">
                        <a href="Docsach.php?sach_id=' . $row["sach_id"] . '"><h3>' . $row["tensach"] . '</h3></a>';

              if (isset($row["tentacgia"])) {
                echo '<a href="ThongTinTacGiaAd.php?tacgia_id=' . $row["tacgia_id"] . '"><h5>' . $row["tentacgia"] . '</h5></a>';
              } else {
                echo '<h5>Tác giả không xác định</h5>';
              }

              echo '</div>
                    <div class="btn-group">
                        <a href="SuaSach.php?sach_id=' . $row["sach_id"] . '" class="btn btn-warning">Sửa</a>
                        <a href="XoaSach.php?sach_id=' . $row["sach_id"] . '" class="btn btn-danger" onclick="return confirm(\'Bạn có chắc muốn xóa không?\')" ><i class="fas fa-trash-alt"></i>Xóa</a>
                    </div>
                </div>
            </div>';
            }
          } else {
            echo "Không có sách nào trong cơ sở dữ liệu.";
          }

          $conn->close();

          ?>
        </div>
      </div>
    </section>
  </main>

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

  <!--javascript-->
  <script>
    function confirmDelete() {
      return confirm('Bạn có chắc muốn xóa không?');
    }
  </script>
</body>

</html>
