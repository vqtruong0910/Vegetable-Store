<?php session_start();
include './connect_db.php';
include './hienidnguoidung.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rau Củ 24H Admin</title>
  <!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="./font-awesome/css/all.css">

  <script>
    function xoasanpham() {
      confirm("Bạn chắc chắn muốn xóa sản phẩm này ?");
    }
  </script>

</head>

<body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
  <div class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="image/logo.png" alt="..." width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin.php">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin/danhmuc.php">Danh Mục</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin/donhang.php">Đơn Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin/quanlyuser.php">Khách Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin/thongke.php">Thống Kê</a>
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
              <a class="nav-link" href="./admin.php">Danh sách sản phẩm</a>
              <a class="nav-link" href="./admin/themsanpham.php">Thêm sản phẩm</a>
            </li>
          </nav>
        </nav>
      </div>
      <div class="container-fluid" style="width: 100%;">
        <div class="col">
          <form>
            <?php

            $sosanphamtrongtrang = 10;
            $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($tranghientai - 1) * $sosanphamtrongtrang;

            $sanpham = mysqli_query($con, "SELECT mat_hang.id, mat_hang.ten_mat_hang, mat_hang.gia_ban, mat_hang.image, danh_muc_mat_hang.ten_danh_muc FROM mat_hang inner join danh_muc_mat_hang on mat_hang.id_danh_muc_mat_hang = danh_muc_mat_hang.id LIMIT " . $sosanphamtrongtrang . " OFFSET " . $offset);
            $tongsotrang = mysqli_query($con, "SELECT * FROM mat_hang");

            $tongsosp = mysqli_num_rows($tongsotrang);
            $sotrang = ceil($tongsosp / $sosanphamtrongtrang);

            ?>



            <div class="container-fluid" id="cacsanpham">
              <div class="card">
                <div class="card-header">
                  <h2>Danh sách sản phẩm</h2>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Thể loại</th>
                        <th>Giá</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      while ($row = mysqli_fetch_assoc($sanpham)) { ?>
                        <tr>
                          <td><?php echo $row['id'] ?></td>
                          <td><?php echo $row['ten_mat_hang']; ?></td>
                          <td>
                            <img src="./image/<?php echo $row['image']; ?>" style="width: 222px;">
                          </td>
                          <td><?php echo $row['ten_danh_muc']; ?></td>

                          <td><?php echo $row['gia_ban']; ?></td>
                          <td><a href="admin/suasanpham.php?id=<?php echo $row['id']; ?>">Sửa</a></td>
                          <td><a href="admin/xoasanpham.php?id=<?php echo $row['id']; ?>" onclick="xoasanpham()">Xóa</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>

        </div>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center" id="Pagination">
            <?php

            if ($tranghientai > 1) { ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?= $tranghientai - 1 ?>" tabindex="-1" aria-disabled="true">Trước</a>
              </li>
            <?php } ?>
            <?php for ($num = 1; $num <= $sotrang; $num++) { ?>
              <?php if ($num != $tranghientai) { ?>
                <?php if ($num > $tranghientai - 3 && $num < $tranghientai + 3) { ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $num ?>"><?= $num ?></a></li>
                <?php } ?>
              <?php } else { ?>
                <li class="page-item"><strong class="page-link" href=""><?= $num ?></strong></li>
              <?php } ?>
            <?php } ?>
            <?php if ($tranghientai < $sotrang) { ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?= $tranghientai + 1 ?>">Sau</a>
              </li>
            <?php } ?>
          </ul>
          </form>
        </nav>
      </div>
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>