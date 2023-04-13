<?php session_start(); ?>
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
  <!-- Menu -->
  <?php
  include './connect_db.php';
  include './hienidnguoidung.php';
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
  }
  if (isset($_GET["action"])) {
    function update_cart($add = false)
    {
      foreach ($_POST['quanlity'] as $id => $quanlity) {
        if ($quanlity == 0) {
          unset($_SESSION['cart'][$id]);
        } else {
          if ($add) {
            if (!empty($_SESSION['cart'][$id])) {
              $_SESSION['cart'][$id] += $quanlity;
            } else {
              $_SESSION['cart'][$id] = $quanlity;
            }
          } else {
            $_SESSION['cart'][$id] = $quanlity;
          }
        }
      }
    }
    switch ($_GET["action"]) {
      case "add":
        // quanlity[chi so id sp] as $id co nghia la so $id la chi so mang
        update_cart(true);
        // var_dump($_SESSION['cart']);
        // exit;
        break;
      case "delete":
        if (isset($_GET['id'])) {
          unset($_SESSION['cart'][$_GET['id']]);
        }
        header('location: ./giohang.php');
        break;
      case "submit":
        if (isset($_POST['capnhat'])) {
          update_cart();
          header('location: ./giohang.php');
        } elseif (isset($_POST['oder_click']) && !empty($_SESSION['cart'])) {
          header('location: ./thanhtoan.php');
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
          // }
        }
        break;
    }
  }
  if (!empty($_SESSION["cart"])) {
    $product = mysqli_query($con, "SELECT * FROM mat_hang WHERE id IN (" . implode(",", array_keys($_SESSION["cart"])) . ")");
  } else {
    $product = false;
  } ?>


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
  <!-- Product shopping -->
  <div class="container">

    <form id="cart-form" action="?action=submit" method="POST">
      <table id="cart" class="table table-hover table-condensed">
        <thead>
          <tr>
            <th style="width:50%">Tên sản phẩm</th>
            <th style="width:10%">Giá</th>
            <th style="width:8%">Số lượng</th>
            <th style="width:22%" class="text-center">Thành tiền</th>
            <th style="width:10%"> </th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($product)) {
            $total = 0;
            while ($rows = mysqli_fetch_array($product)) {
          ?>
              <tr>
                <td data-th="Product">
                  <div class="row">
                    <div class="col-sm-2 hidden-xs"><img src="./image/<?= $rows['image'] ?>" alt="Sản phẩm 1" class="img-responsive" width="100">
                    </div>
                    <div class="col-sm-10">
                      <h4 class="nomargin"><?= $rows['ten_mat_hang'] ?></h4>
                    </div>
                  </div>
                </td>
                <td data-th="Price"><?= $rows['gia_ban'] ?> VNĐ</td>
                <!-- Chính giữa quanlity là id sản phẩm -->
                <td data-th="Quantity"><input class="form-control text-center" value="<?= $_SESSION['cart'][$rows['id']] ?>" name="quanlity[<?= $rows['id'] ?>]" type="number" min="1"></td>
                <td data-th="Subtotal" class="text-center"><?= $rows['gia_ban'] * $_SESSION['cart'][$rows['id']] ?> VNĐ</td>
                <td class="actions" data-th="">
                  <!-- <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                </button> -->
                  <a class="btn btn-danger btn-sm" href="giohang.php?action=delete&id=<?= $rows['id'] ?>"><i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>
            <?php
              $total += $rows['gia_ban'] * $_SESSION['cart'][$rows['id']];
            } ?>
        </tbody>
        <tfoot>
          <!-- <tr class="visible-xs">
            <td class="text-center"><strong>Tổng 200.000 đ</strong>
            </td>
          </tr> -->
          <tr>
            <td><a href="index.php" class="btn btn-success"><i class="fa fa-angle-left"></i> Tiếp tục mua hàng</a>
            </td>
            <td colspan="2" class="hidden-xs"> </td>
            <td class="hidden-xs text-center"><strong>Tổng tiền <?= $total ?> VNĐ</strong></td>
            <td><input type="submit" name="capnhat" value="Cập nhật"></td>
          </tr>
        </tfoot>
      <?php } ?>

      </table>
      <div id="thongtin" style="text-align: end;">
        <hr>
        <input class="btn btn-dark btn-block" type="submit" name="oder_click" value="Đặt hàng" style="margin: 10px;">
        <!-- <a href="" class="btn btn-dark btn-block">Thanh toán <i class="fa fa-angle-right"></i></a> -->
      </div>
    </form>
  </div>
  <!-- End product shopping -->
  <!-- Footer -->
  <footer class="bg-dark text-center text-white" style="margin-top: 300px;">
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