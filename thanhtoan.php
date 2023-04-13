<?php session_start();
ob_start();
 include './connect_db.php';
 include './hienidnguoidung.php' 
?>
<?php
        if (!empty($_SESSION["cart"])) {
        $product = mysqli_query($con, "SELECT * FROM mat_hang WHERE id IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
        // var_dump("SELECT * FROM mat_hang WHERE id IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
        } else {
        $product = false;
        }
?>
<?php
// $error = false;
// // xu ly du lieu lên database
// if ($error == false && !empty($_SESSION['cart'])) {
//   $product = mysqli_query($con, "SELECT * FROM `mat_hang` WHERE `id` IN (" . implode(",", array_keys($_SESSION['cart'])) . ")");
//   $total = 0;
//   $orderProducts = array();
//   while ($rows = mysqli_fetch_array($product)) {
//     $orderProducts[] = $rows;
//     $total += $rows['gia_ban'] * $_SESSION['cart'][$rows['id']];
//   }
//   // tao du lieu cho bang order
//   $date = date("Y/m/d");
//   $insertOrder = mysqli_query($con, "INSERT INTO `don_hang` (`id`, `ngay_mua`, `phi_ship`, `tong_tien`, `nguoi_giao`, `trang_thai`, `id_tai_khoan`) VALUES (NULL,'" . $date . "', NULL, '" . $total . "', NULL, NULL, '" . $iduser . "')");
//   // hàm insert_id là hàm lấy lại id của câu query phía trên
//   $idorder = $con->insert_id;
//   $insertString = "";
//   foreach ($orderProducts as $keys => $product) {
//     $insertString .= "(NULL, '" . $_SESSION['cart'][$product['id']] . "', '" . $product['gia_ban'] . "', '" . $product['id'] . "', '" . $idorder . "')";
//     // $keys này tự động tăng theo lệnh foreach 0,1,2... 
//     if ($keys != count($orderProducts) - 1) {
//       $insertString .= ",";
//     }
//   }
//   // tao du lieu cho bang order_detail
//   $insertOrder = mysqli_query($con, "INSERT INTO `chi_tiet_don_hang` (`id`, `so_luong`, `thanh_tien`, `id_mat_hang`, `id_don_hang`) VALUES " . $insertString . "");
//   if ($insertOrder) {
//     unset($_SESSION['cart']);
//     echo "<script type='text/javascript'>alert('Bạn đã đặt hàng thành công');</script>";
//   } else {
//     echo "<script type='text/javascript'>alert('Thanh toán thất bại');</script>";
//   }
// }else{
    
// }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rau Củ 24H</title>
    <link rel="stylesheet" href="css/giohang.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome/css/all.css">
  </head>

  <body style="background-color: #F0F0F0;">
  
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
              <?php
              if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                $query = mysqli_query($con, "SELECT * FROM tai_khoan WHERE ten_tai_khoan = '$user'");
                if (mysqli_num_rows($query) > 0) {
                  $result = mysqli_fetch_assoc($query);
                  // Chi co trang thai status la 1 thi moi vao duoc trang admin
                  if (isset($result['vai_tro']) && $result['vai_tro'] == 1) {
              ?>
                    <li class="nav-item">
                      <a class="nav-link" href="admin.php">Quản trị</a>
                    </li>
              <?php }
                }
              } ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Thể Loại</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  $sql = mysqli_query($con, "SELECT * FROM danh_muc_mat_hang");
                  if (mysqli_num_rows($sql) > 0) {
                    while ($category = mysqli_fetch_array($sql)) {
                  ?>
                      <li><a class="dropdown-item" href="./index.php?theloai=<?= $category['id'] ?>"><?= $category['ten_danh_muc'] ?></a></li>
                  <?php }
                  } ?>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                </ul>
              </li>
            </ul>
            <form class="d-flex" method="GET" action="./index.php">
              <input class="form-control me-2" name="text" type="Search" placeholder="Search" aria-label="Search" value="<?= isset($_GET['text']) ? $_GET['text'] : ""; ?>">
              <button class="btn btn-outline-light" type="submit">Tìm</button>
            </form>
          </div>
          <ul class="navbar-nav px-3">
            <?php
            if (isset($_SESSION['user'])) {
            ?>
              <li class="nav-item text-nowrap">
                <a class="nav-link" href="checkusergiohang.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> <?= $_SESSION['user']; ?></a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="./donhangcuakhach.php">Thông tin đơn hàng</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="dangxuat.php"><i class="fas fa-sign-out-alt"> </i>Đăng Xuất</a></li>
                </ul>
              </li>
            <?php } else { ?>
              <li class="nav-item text-nowrap">
                <a class="nav-link" id="login2" href="#"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
              </li>
              <li class="nav-item text-nowrap">
                <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
                <a class="nav-link" href="dangkyvadangnhap.php">Đăng nhập</a>
              </li>
            <?php } ?>
          </ul>
        </div>
      </nav>
    </div>
    <!-- End menu -->
    <?php
      $sql = mysqli_query($con, "SELECT * FROM `tai_khoan` WHERE `id` = '" . $iduser . "'");
      if (mysqli_num_rows($sql) == 1) {
      $result = mysqli_fetch_array($sql);
      }
      //lấy địa chỉ theo id khách hàng
      $sql2 = mysqli_query($con, "SELECT * FROM `dia_chi` WHERE `id_khach_hang` = '" . $iduser . "'");
      if (mysqli_num_rows($sql2) == 1) {
          $result2 = mysqli_fetch_array($sql2);
      }
      else{
        $result2['tinh'] = "";
        $result2['quan'] = "";
        $result2['phuong'] = "";
        $result2['chi_tiet'] = "";
      }
    ?>
    <div class="container rounded pt-5 mt-5" style= "height: 100vh; background:#bcb8b724;">
      <form class="row g-3"  enctype="multipart/form-data" action="" method="POST" onsubmit="return confirm('Bạn muốn xác nhận đặt hàng ?');">
              
      <!-- thông tin khach đặt hàng -->
        <div class="col-7 row me-1">
          <h2>Thông tin đặt hàng của bạn</h2>
          <div class="col-12">
            <label for="TenTK" class="form-label">Họ Và Tên</label>
            <input type="text" class="form-control"name="username" id="TenTK" value="<?= ($result['ten_khach'] != "") ? $result['ten_khach'] : "dkldsdl" ?>" disabled>
          </div>
          <div class="col-md-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="inputEmail4" value="<?= $result['email'] ?>" disabled>
          </div>
          <div class="col-md-6">
            <label for="soDT" class="form-label">Số Điện Thoại</label>
            <input type="text" class="form-control" name="sdt" id="soDT" value="<?= $result['sdt'] ?>" disabled>
          </div>
          <div class="col-md-6">
            <label for="tinh" class="form-label">Tỉnh/Thành Phố</label>
            <input type="text" class="form-control" name="tinhOrThanhPho" id="tinh"  value="<?= $result2['tinh'] ?>" required>
          </div>
          <div class="col-md-6">
            <label for="quan" class="form-label">Quận/Huyện</label>
            <input type="text" class="form-control" name="quanOrHuyen" id="quan"  value="<?= $result2['quan'] ?>" required>
          </div>
          <div class="col-md-6">
            <label for="phuong" class="form-label">Phường/Xã</label>
            <input type="text" class="form-control" name="phuongOrXa" id="phuong" value="<?= $result2['phuong'] ?>" required>
          </div>
          <div class="col-md-6">
            <label for="diachi" class="form-label">Chi tiết</label>
            <input type="text" class="form-control" name="chitiet" id="diachi" value="<?= $result2['chi_tiet'] ?>" required>
          </div>
        </div>

      <!-- thông tin sản phẩm -->
        <div class="col-5 row ms-1" style="border: #000 solid 2px">
          <h2>Thông tin đơn hàng</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Sản Phẩm</th>
                <th scope="col">Tạm Tính</th>
              </tr>
            </thead>
            <tbody>
            <?php
              if (!empty($product)) {
              $total = 0;
              $tamtinh = 0;
              while ($rows = mysqli_fetch_array($product)) {
            ?>
              <tr>
                <td><?= $rows['ten_mat_hang']?> x <?= $_SESSION['cart'][$rows['id']] ?></td>
                <td><?= $rows['gia_ban'] * $_SESSION['cart'][$rows['id']] ?> VNĐ</td>
              </tr>
            <?php
            $tamtinh += $rows['gia_ban'] * $_SESSION['cart'][$rows['id']];
            }
            $total = $tamtinh + 25000;
            }
            ?>
              <tr>
                <td>Tạm Tính</td>
                <td><?=$tamtinh ?> VNĐ</td>
              </tr>
              <tr>
                <td>Phí ship</td>
                <td> 25000 VNĐ</td>
              </tr>
              <tr>
                <td><strong>Tổng Tiền</strong></td>
                <td><strong><?=$total?> VNĐ</strong></td>
              </tr>
            </tbody>
          </table>

          <div class="col-12">
            <button name="dathang" type="submit" class="btn btn-primary ">Đặt hàng</button>
          </div>
        </div>
      </form>
    </div>
    
    <!-- Footer -->
    <footer class="bg-dark text-center text-white" style="margin-top: 100px;">
      <!-- Grid container -->
      <div class="container p-4 pb-0">
        <!-- Section: Social media -->
        <section class="mb-4">
          <!-- Facebook -->
          <a class="btn btn-outline-light btn-floating m-1" href="https://www.facebook.com/" role="button"><i class="fab fa-facebook-f"></i></a>

          <!-- Twitter -->
          <a class="btn btn-outline-light btn-floating m-1" href="https://twitter.com/twister" role="button"><i class="fab fa-twitter"></i></a>

          <!-- Google -->
          <a class="btn btn-outline-light btn-floating m-1" href="https://www.google.com/" role="button"><i class="fab fa-google"></i></a>

          <!-- Instagram -->
          <a class="btn btn-outline-light btn-floating m-1" href="https://www.instagram.com/" role="button"><i class="fab fa-instagram"></i></a>

          <!-- Linkedin -->
          <a class="btn btn-outline-light btn-floating m-1" href="https://au.linkedin.com/" role="button"><i class="fab fa-linkedin-in"></i></a>

          <!-- Github -->
          <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/" role="button"><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->
      </div>
      <!-- Grid container -->

      <!-- Copyright -->
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright:
        <a class="text-white" href="https://www.facebook.com/profile.php?id=100008172966669">BOOKSTORE</a>
      </div>
      <!-- Copyright -->
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
  </body>
</html>
<?php
      if (isset($_POST['dathang']) && !empty($_SESSION['cart'])) { 
          // header('location: ./index.php');
          if (empty($_POST['tinhOrThanhPho']) || empty($_POST['quanOrHuyen'])  || empty($_POST['phuongOrXa']) || empty($_POST['chitiet'])) {
              echo "Xin điền đầy đủ thông tin";
          } else {
              if($result2['tinh']=="" && $result2['quan']=="" && $result2['phuong']=="" && $result2['chi_tiet']==""){
                  $tinh = $_POST['tinhOrThanhPho'];
                  $quan = $_POST['quanOrHuyen'];
                  $phuong = $_POST['phuongOrXa'];
                  $chitiet = $_POST['chitiet'];
                  $sql = "INSERT INTO dia_chi (id_khach_hang,tinh,quan,phuong,chi_tiet) VALUES ('".$iduser."','".$tinh."','".$quan."','".$phuong."','".$chitiet."')";
                  $query = mysqli_query($con,$sql);
                  if($query){
                    echo "<script type='text/javascript'>alert('Địa chỉ của bạn đã được cập nhật');</script>";
                  }else{
                    echo "that bai";
                  }
                  
              }
              elseif ($_POST['tinhOrThanhPho'] != $result2['tinh'] || $_POST['quanOrHuyen'] != $result2['quan'] || $_POST['phuongOrXa'] != $result2['phuong'] || $_POST['chitiet'] != $result2['chi_tiet']) {
                  $tinh = $_POST['tinhOrThanhPho'];
                  $quan = $_POST['quanOrHuyen'];
                  $phuong = $_POST['phuongOrXa'];
                  $chitiet = $_POST['chitiet'];
                  $sql = "UPDATE dia_chi SET tinh = '".$tinh."', quan = '".$quan."', phuong = '".$phuong."', chi_tiet = '".$chitiet."' WHERE id_khach_hang = '".$iduser."'";
                  $query = mysqli_query($con,$sql);
                  if($query){
                    echo "<script type='text/javascript'>alert('Địa chỉ của bạn đã được thay đổi');</script>";
                  }
              } else {
                  echo "That bai";
              }
          }
          $error = false;
          // xu ly du lieu lên database
          if ($error == false && !empty($_SESSION['cart'])) {
            $product = mysqli_query($con, "SELECT * FROM `mat_hang` WHERE `id` IN (" . implode(",", array_keys($_SESSION['cart'])) . ")");
            $total = 0;
            $orderProducts = array();
            while ($rows = mysqli_fetch_array($product)) {
              $orderProducts[] = $rows;
              $total += $rows['gia_ban'] * $_SESSION['cart'][$rows['id']];
            }
            // tao du lieu cho bang order
            $date = date("Y/m/d");
            $insertOrder = mysqli_query($con, "INSERT INTO `don_hang` (`id`, `ngay_mua`, `phi_ship`, `tong_tien`, `nguoi_giao`, `trang_thai`, `id_tai_khoan`) VALUES (NULL,'" . $date . "', 25000, '" . $total . "', NULL, NULL, '" . $iduser . "')");
            // hàm insert_id là hàm lấy lại id của câu query phía trên
            $idorder = $con->insert_id;
            $insertString = "";
            foreach ($orderProducts as $keys => $product) {
              $insertString .= "(NULL, '" . $_SESSION['cart'][$product['id']] . "', '" . $product['gia_ban'] . "', '" . $product['id'] . "', '" . $idorder . "')";
              // $keys này tự động tăng theo lệnh foreach 0,1,2... 
              if ($keys != count($orderProducts) - 1) {
                $insertString .= ",";
              }
            }
            // tao du lieu cho bang order_detail
            $insertOrder = mysqli_query($con, "INSERT INTO `chi_tiet_don_hang` (`id`, `so_luong`, `thanh_tien`, `id_mat_hang`, `id_don_hang`) VALUES " . $insertString . "");
            if ($insertOrder) {
              unset($_SESSION['cart']);
              echo "<script type='text/javascript'>alert('Bạn đã đặt hàng thành công');</script>";
              header('location: ./index.php');
            } else {
              echo "<script type='text/javascript'>alert('Thanh toán thất bại');</script>";
            }
          }
      }
  ob_flush();
?>