<?php
include '../connect_db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rau Củ 24H</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../font-awesome/css/all.css">

</head>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">
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
              <a class="nav-link" href="./donhang.php" onclick="listdonhang()" ;>Đơn Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./quanlyuser.php" onclick="listkhachhang();">Khách Hàng</a>
            </li>
          </ul>

          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Xin Chào Quản Trị Viên</a>
            </li>
            <li class="nav-item text-nowrap">
              <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="dangkyvadangnhap.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>

  <?php
  include '../connect_db.php';
  $id = $_GET['id'];
  $sql_up = "SELECT * FROM mat_hang where id = $id";
  $query_up = mysqli_query($con, $sql_up);
  $row_up = mysqli_fetch_assoc($query_up);
  if (isset($_POST['sbm'])) {
    $name_product = $_POST['name_product'];
    $price = $_POST['price'];

    if ($_FILES['image']['name'] == '') {
      $image = $row_up['image'];
    } else {
      $image = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp, '../image/' . $image);
      $sql = "UPDATE mat_hang SET image = '$image' where id = $id ";
      mysqli_query($con, $sql);
    }
    $don_vi = $_POST['don_vi'];
    $id_category = $_POST['id_category'];
    $khoi_luong = $_POST['khoi_luong'];
    $tong_khoi_luong = $_POST['tong_khoi_luong'];

    $sql = "UPDATE mat_hang SET id = '" . $id . "', ten_mat_hang = '" . $name_product . "', don_vi_tinh = '" . $don_vi . "', khoi_luong = '" . $khoi_luong . "', so_luong_ton = '" . $tong_khoi_luong . "', gia_ban = '" . $price . "', image = '" . $image . "' WHERE id = $id  ";
    $query = mysqli_query($con, $sql);
    header('location: ../admin.php');
  }
  ?>

  <div class="container" id="addproduct">
    <div class="card">
      <div class="card-header">
        <h2 onclick="addproduct();">Sửa sản phẩm</h2>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <br>
            <input type="text" name="name_product" class="form-control" required value="<?php echo $row_up['ten_mat_hang']; ?>">
          </div>
          <div class="form-group">
            <label for="">Giá sản phẩm</label>
            <br>
            <input type="number" name="price" class="form-control" required value="<?php echo $row_up['gia_ban']; ?>">
          </div>
          <div class="form-group">
            <label for="">Hình ảnh sản phẩm</label> <br>
            <input type="file" name="image" required class="form-control" value="<?php echo $row_up['image']; ?>">
          </div>
          <div class="form-group">
            <label for="">Đơn vị sản phẩm</label> <br>
            <input type="text" name="don_vi" class="form-control" value="<?php echo $row_up['don_vi_tinh']; ?>">
          </div>
          <div class="form-group">
            <label for="">Khối lượng(số lượng)</label> <br>
            <input type="number" name="khoi_luong" min="1" class="form-control" value="<?php echo $row_up['khoi_luong']; ?>" required>
          </div>
          <div class="form-group">
            <label for="">Tổng số lượng</label> <br>
            <input type="number" name="tong_khoi_luong" min="1" class="form-control" value="<?php echo $row_up['so_luong_ton']; ?>" required>
          </div>
          <div class="form-group">
            <label for="">Thể loại:</label>
            <br>
            <?php
            $sql = "SELECT * FROM danh_muc_mat_hang";
            $query_sql = mysqli_query($con, $sql);
            ?>
            <select class="form-control" name="id_category" class="form-control">
              <?php
              $sql_category = "SELECT * FROM danh_muc_mat_hang ORDER BY id DESC";
              $query_category = mysqli_query($con, $sql_category);
              while ($rows = mysqli_fetch_array($query_category)) {
              ?>
                <option value="<?= $rows['id'] ?>"><?= $rows['ten_danh_muc'] ?></option>
              <?php } ?>
            </select>
          </div>
          <button name="sbm" class="btn btn-primary" type="submit">Sửa sản phẩm</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>