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


  <!-- Content -->
  <div class="container">
    <?php
    require 'connect.php';

    if (isset($_GET['tacgia_id'])) {
      $tacgia_id = $_GET['tacgia_id'];

      $sql_tacgia = "SELECT * FROM tacgia WHERE tacgia_id = $tacgia_id";
      $result_tacgia = $conn->query($sql_tacgia);

      if ($result_tacgia->num_rows > 0) {
        $row_tacgia = $result_tacgia->fetch_assoc();
        echo '<h1>' . $row_tacgia["tentacgia"] . '</h1>';
        echo '<p>Năm sinh: ' . $row_tacgia["ngaysinh"] . '</p>';
        echo '<p>Tiểu sử: ' . $row_tacgia["tieusu"] . '</p>';

        $sql_sach_tacgia = "SELECT tensach FROM sach WHERE tacgia_id = $tacgia_id";
        $result_sach_tacgia = $conn->query($sql_sach_tacgia);

        if ($result_sach_tacgia->num_rows > 0) {
          echo '<h2>Các sách của tác giả:</h2>';
          echo '<ul>';
          while ($row_sach_tacgia = $result_sach_tacgia->fetch_assoc()) {
            echo '<li>' . $row_sach_tacgia["tensach"] . '</li>';
          }
          echo '</ul>';
        } else {
          echo '<p>Tác giả này không có sách nào trong cơ sở dữ liệu.</p>';
        }
      } else {
        echo "Không tìm thấy thông tin tác giả.";
      }
    } else {
      echo "Thiếu tham số tacgia_id.";
    }

    $conn->close();
    ?>
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