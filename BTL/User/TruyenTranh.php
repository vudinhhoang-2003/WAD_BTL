<!DOCTYPE html>
<html lang="en">
<!-- VŨ ĐÌNH HOÀNG - 2121050409 -->
<head>
  <link rel="stylesheet" href="../CSS/Home.css">
  <title>Truyện Tranh</title>
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
            <a href="Home.php"><img src="../Images/logo.png" alt="Logo"></a>
          </div>
        </div>
        <div class="col-md-8">
          <h1 class="display-4">Đọc Sách Mỗi Ngày</h1>
        </div>
      </div>
    </div>
  </header>


  <!-- Thanh menu -->
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="Home.php" style="color: green;">DocSachOnline</a>
      </div>
      <ul class="nav navbar-nav">
        <li class=""><a href="Home.php">Trang chủ</a></li>
        <li class="dropdown active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Thể loại<span class="caret"></span></a>
          <ul class="dropdown-menu" style="background: lightyellow;">
            <li><a href="TruyenTranh.php">Truyện tranh</a></li>
            <li><a href="">Lịch sử Việt Nam</a></li>
            <li><a href="VanHoc.php">Văn học</a></li>
            <li><a href="">Các thể loại khác</a></li>
          </ul>
        </li>
        <li><a href="TacGia.php">Tác giả</a></li>
      </ul>
      <form class="navbar-form navbar-right" action="Timkiem.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Tìm kiếm" name="search">
        </div>
        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
      </form>
    </div>
  </nav>


  <!-- Nội dung chính -->
  <main>
    <section>
      <div class="container">
        <div class="row">
          <?php
          require 'connect.php';

          $sql = "SELECT sach.*, tacgia.tentacgia
                  FROM sach
                  LEFT JOIN tacgia ON sach.tacgia_id = tacgia.tacgia_id
                  WHERE sach.theloai_id = 3";

          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-3">
                <div class="thumbnail">
                  <img src="../Images/' . $row["hinhanh"] . '" alt="' . $row["tensach"] . '" class="img-responsive">
                  <div class="caption">
                    <a href="Docsach.php?sach_id=' . $row["sach_id"] . '"><h3>' . $row["tensach"] . '</h3></a>';

              if (isset($row["tentacgia"])) {
                echo '<a href="ThongTinTacGia.php?tacgia_id=' . $row["tacgia_id"] . '"><h5>' . $row["tentacgia"] . '</h5></a>';
              } else {
                echo '<h5>Tác giả không xác định</h5>';
              }

              echo '    </div>
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
</body>

</html>
