<?php
session_start();
include '../connect_db.php';
include '../hienidnguoidung.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rau Củ 24H Admin</title>
  <!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"> -->
  <link rel="stylesheet" href="../font-awesome/css/all.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<?php
include '../connect_db.php';
?>

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
            <li class="nav-item" style="min-width:102px">
              <a class="nav-link active" aria-current="page" href="../index.php">Trang chủ</a>
            </li>
            <li class="nav-item" style="min-width:102px">
              <a class="nav-link" href="../admin.php" onclick="listsanpham();">Sản Phẩm</a>
            </li>
            <li class="nav-item" style="min-width:102px">
              <a class="nav-link" href="./danhmuc.php">Danh Mục</a>
            </li>
            <li class="nav-item" style="min-width:102px">
              <a class="nav-link" href="./donhang.php" onclick="listdonhang()" ;>Đơn Hàng</a>
            </li>
            <li class="nav-item" style="min-width:102px">
              <a class="nav-link" href="./quanlyuser.php" onclick="listkhachhang();">Khách Hàng</a>
            </li>
            <li class="nav-item" style="min-width:102px">
              <a class="nav-link" href="./thongke.php">Thống Kê</a>
            </li>
          </ul>
          <form class="d-flex" method="GET">
            <input class="form-control me-2" name="text" type="Search" placeholder="Tìm kiếm" aria-label="Search" value="<?= isset($_GET['text']) ? $_GET['text'] : ""; ?>">
            <button class="btn btn-outline-light" type="submit">Tìm</button>
          </form>
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Quản Trị Viên</a>
            </li>
            <li class="nav-item text-nowrap">
              <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="../dangxuat.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>
  <div class="container">
    <h1 class="text-center" style="margin-top: 20px;">Quản lý đơn hàng</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Mã đơn hàng</th>
          <th scope="col">Ngày đặt hàng</th>
          <th scope="col">Phí ship</th>
          <th scope="col">Tổng Tiền</th>
          <th scope="col">Người Giao</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">In đơn hàng</th>
          <th scope="col">Xử lý</th>
          <th scope="col">Cập Nhật</th>

        </tr>
      </thead>
      <tbody>
        <?php
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if (isset($_GET['text']) && $_GET['text'] != "") {
          $text = $_GET['text'];
          $sql_up = "SELECT * FROM `don_hang` WHERE `ngay_mua` LIKE '%" . $text . "%' ORDER BY `don_hang`.`trang_thai` ASC";
          $sql_query = mysqli_query($con, $sql_up);
        } else {
          $sql = "SELECT * FROM `don_hang` ORDER BY `don_hang`.`trang_thai` ASC";
          $sql_query = mysqli_query($con, $sql);
        }
        while ($row = mysqli_fetch_assoc($sql_query)) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['ngay_mua']; ?></td>
            <td><?php echo $row['phi_ship']; ?></td>
            <td><?php echo $row['tong_tien'] + $row['phi_ship']; ?>đ</td>
            <td><?php echo $row['nguoi_giao']; ?></td>
            <?php $status = $row['trang_thai'];
            if ($status == 0) {
              $trangthai = '<p style="color: black;">Chưa xử lý</p>';
            } else if ($status == 1) {
              $trangthai = '<p style="color: green;">Giao hàng thành công</p>';
            } else if ($status == -2) {
              $trangthai = '<p style="color: red;">Khách hàng đã hủy đơn</p>';
            } else {
              $trangthai = '<p style="color: red;">Đã hủy</p>';
            }

            echo "<td>" . $trangthai . " </td>"; ?>

            <td><a href="./indonhang.php?id=<?= $row['id'] ?>">Hiện</a></td>

            <?php
            if ($status == 0) {
              $active = "<a href=./xulychuagiao.php?id=" . $row['id'] . ">Giao hàng</a> <hr>
              <a href=./xulyhuygiao.php?id=" . $row['id'] . ">Hủy Đơn</a>";
            } else if ($status == 1) {
              $active = "<a href=./xulygiaohang.php?id=" . $row['id'] . ">Hoàn lại hàng</a>";
            } else if ($status == -2) {
              $active = "";
            } else {
              $active = "<a href=./xulyhoantac.php?id=" . $row['id'] . ">Hoàn tác</a>";
            }
            echo "<td>" . $active . "</td>";
            if ($status == 0) {
            ?>
              <td><a href="./phanconggiaohang.php?id=<?= $row['id'] ?>">Phân Công</a></td>
            <?php } ?>
          </tr>
        <?php } ?>

      </tbody>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>