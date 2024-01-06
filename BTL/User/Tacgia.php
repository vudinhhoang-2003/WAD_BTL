<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giới thiệu tác giả văn học nổi tiếng nhất</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../CSS/Tacgia.css">
</head>
<!-- Hà Tấn Tường-2121050164 -->
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

  <!-- menu -->
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
          <input type="text" class="form-control" placeholder="Search" name="search">
        </div>
        <button type="submit" class="btn btn-default">
          <i class="fas fa-search"></i> <!-- Icon tìm kiếm từ Font Awesome -->
        </button>
      </form>

    </div>
  </nav>


  <!-- chinh -->
  <section>
    <div class="container">
      <div class="row">
        <?php
        // Kết nối đến cơ sở dữ liệu
        require 'connect.php';

        // Truy vấn dữ liệu từ bảng tacgia
        $sql_tacgia = "SELECT * FROM tacgia ORDER BY RAND()
        LIMIT 8";
        $result_tacgia = $conn->query($sql_tacgia);

        // Kiểm tra và hiển thị thông tin tác giả
        if ($result_tacgia->num_rows > 0) {
          while ($row_tacgia = $result_tacgia->fetch_assoc()) {
            // Hiển thị thông tin tác giả
            echo '<div class="col-md-3">
                <div class="thumbnail">
                    <a href="ThongTinTacGia.php?tacgia_id=' . $row_tacgia["tacgia_id"] . '" target="_blank">
                        <img class="img-responsive" src="../Images/' . $row_tacgia["hinhanh"] . '" alt="' . $row_tacgia["tentacgia"] . '" title="' . $row_tacgia["tentacgia"] . '">
                    </a>
                    <h3><a href="ThongTinTacGia.php?tacgia_id=' . $row_tacgia["tacgia_id"] . '">' . $row_tacgia["tentacgia"] . '</a></h3>
                    <p>(Ngày sinh: ' . $row_tacgia["ngaysinh"] . ')</p>
                </div>
              </div>';
          }
        } else {
          echo "Không có dữ liệu tác giả.";
        }
        ?>
      </div>
    </div>
  </section>



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
          <p>&copy; Hà Tấn Tường-2121050164</p>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>