<?php session_start();
include '../connect_db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rau Củ 24H Admin</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../font-awesome/css/all.css">
</head>

<body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
  <?php
  include '../connect_db.php';
  include '../hienidnguoidung.php';
  ?>
  <div class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="../image/logo.png" alt="..." width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="../index.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin.php" onclick="listsanpham();">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/donhang.php" onclick="listdonhang()" ;>Đơn Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin/quanlyuser.php" onclick="listkhachhang();">Khách Hàng</a>
            </li>
          </ul>

          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Xin Chào Quản Trị Viên</a>
            </li>
            <li class="nav-item text-nowrap">
              <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="./dangxuat.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>
  <!-- Navbar -->
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-lg-3" id="myScrollspy" style="background-color: #F0F0F0;">
        <nav class="navbar navbar-light bg-light flex-column mt-4">
          <nav class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="../admin.php">Danh sách sản phẩm</a>
              <a class="nav-link" href="./themsanpham.php">Thêm sản phẩm</a>
            </li>
          </nav>
        </nav>
      </div>
      <div class="container-fluid">
        <div class="col">
          <!-- Xử lý thêm sản phẩm -->

          <?php
          if (is_file("../image/nam.png")) {
            unlink("../image/nam.png");
          }
          if (isset($_POST['sbm'])) {
            $name_product = $_POST['name_product'];
            $price = $_POST['price'];

            if (isset($_FILES['image'])) {
              $file = $_FILES['image'];
              $file_name = $file['name'];
              move_uploaded_file($file['tmp_name'], '../image/' . $file_name);
            }

            $don_vi = $_POST['don_vi'];
            $id_category = $_POST['id_category'];
            $khoi_luong = $_POST['khoi_luong'];
            $tong_khoi_luong = $_POST['tong_khoi_luong'];
            $sql = "INSERT INTO mat_hang (id, ten_mat_hang, don_vi_tinh, khoi_luong, so_luong_ton, gia_ban, image, id_danh_muc_mat_hang) VALUES (NULL,'" . $name_product . "','" . $don_vi . "','" . $khoi_luong . "','" . $tong_khoi_luong . "','" . $price . "', '" . $file_name . "','" . $id_category . "')";
            $query = mysqli_query($con, $sql);

            if ($query) {
              header('location: ../admin.php');
            } else {
              echo "Lỗi";
            }
          }
          ?>
          <!-- Xử lý thêm sản phẩm -->

          <form action="" method="POST" enctype="multipart/form-data">
            <div class="container-fluid" id="addproduct">
              <div class="card-header">
                <h2>Thêm sản phẩm</h2>
              </div>
              <!-- <div class="form-group">
                <label for="">ID sản phẩm</label>
                <input type="text" name="id_product" class="form-control" required>
              </div> -->
              <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <br>
                <input type="text" name="name_product" class="form-control" required>
              </div>

              <div class="form-group">
                <label for="">Giá sản phẩm</label>
                <br>
                <input type="number" min="1" name="price" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">Hình ảnh sản phẩm</label> <br>
                <input type="file" name="image" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">Đơn vị sản phẩm</label> <br>
                <input type="text" name="don_vi" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Khối lượng(số lượng)</label> <br>
                <input type="number" name="khoi_luong" min="1" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">Tổng số lượng</label> <br>
                <input type="number" name="tong_khoi_luong" min="1" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">Thể loại:</label>
                <br>
                <?php
                $sql = "SELECT * FROM danh_muc_mat_hang";
                $query_sql = mysqli_query($con, $sql);
                ?>
                <select class="form-control" name="id_category">
                  <?php
                  $sql_category = "SELECT * FROM danh_muc_mat_hang ORDER BY id DESC";
                  $query_category = mysqli_query($con, $sql_category);
                  while ($rows = mysqli_fetch_array($query_category)) {
                  ?>
                    <option value="<?= $rows['id'] ?>"><?= $rows['ten_danh_muc'] ?></option>
                  <?php } ?>
                </select>
              </div>
              <br>
              <button name="sbm" class="btn btn-primary" type="submit">Thêm sản phẩm</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    function xoasanpham() {
      confirm("Bạn chắc chắn muốn xóa sản phẩm này ?");
    }
  </script>
</body>

</html>