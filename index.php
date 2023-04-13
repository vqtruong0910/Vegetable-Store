<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rau Củ 24h</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="font-awesome/css/all.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body style="background-color: #F0F0F0;">

  <!-- Open menu -->
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
              <a class="nav-link" aria-current="page" href="index.php">Trang chủ</a>
            </li>
            <?php
            include 'connect_db.php';
            session_start();
            if (isset($_SESSION['user'])) {
              $user = $_SESSION['user'];
              $query = mysqli_query($con, "SELECT * FROM tai_khoan WHERE ten_tai_khoan = '$user'");
              if (mysqli_num_rows($query) > 0) {
                $result = mysqli_fetch_assoc($query);
                // Chi co trang thai status la 1 thi moi vao duoc trang admin
                if (isset($result['vai_tro']) && $result['vai_tro'] == 1) {
            ?>
                  <li class="nav-item">
                    <a class="nav-link" href="./admin.php">Quản trị</a>
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
                    <li><a class="dropdown-item" href="?theloai=<?= $category['id'] ?>"><?= $category['ten_danh_muc'] ?></a></li>
                <?php }
                } ?>
                <li>
                  <hr class="dropdown-divider">
                </li>
              </ul>
            </li>
          </ul>
          <form class="d-flex" method="GET">
            <input class="form-control me-2" name="text" type="Search" placeholder="Tìm kiếm" aria-label="Search" value="<?= isset($_GET['text']) ? $_GET['text'] : ""; ?>">
            <button class="btn btn-outline-light" type="submit">Tìm</button>
          </form>
        </div>
        <ul class="navbar-nav px-3">
          <?php
          if (isset($_SESSION['user'])) {
          ?>
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="./checkusergiohang.php"><i class="fas fa-shopping-cart"></i> Giỏ hàng</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user"></i> <?= $_SESSION['user']; ?></a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="./taikhoankhachhang.php">Thông tin tài khoản</a></li>
                <li><a class="dropdown-item" href="./donhangcuakhach.php">Thông tin đơn hàng</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="./dangxuat.php"><i class="fas fa-sign-out-alt"> </i>Đăng Xuất</a></li>
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

  <!-- Open content -->
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img style="width: 500px;" src="./image/hai-san-1.jpg" class="d-block w-100" alt="...">
      </div>
      <!-- <div class="carousel-item">
        <img style="width: 500px;" src="./image/banner.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="./image/banner-sach.jpg" class="d-block w-100" alt="...">
      </div> -->
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <!-- End contend -->
  <!-- Product -->
  <div class="container">
    <div class="row mt-5">
      <h2 class="list-product-title">Chợ rau củ</h2>
      <div class="list-product-subtile">
        <p>Rau củ tươi sạch hợp vệ sinh an toàn thực phẩm</p>
      </div>
      <div class="product-group">
        <div class="row">
          <?php
          $theloai = isset($_GET['theloai']) ? $_GET['theloai'] : "";
          $search = isset($_GET['text']) ? $_GET['text'] : "";


          $sosanphamtrongtrang = 12;
          $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($tranghientai - 1) * $sosanphamtrongtrang;
          if ($theloai) {
            $sanpham = mysqli_query($con, "SELECT * FROM mat_hang WHERE id_danh_muc_mat_hang = '$theloai' LIMIT " . $sosanphamtrongtrang . " OFFSET " . $offset);
            $tongsotrang = mysqli_query($con, "SELECT * FROM mat_hang WHERE id_danh_muc_mat_hang = '$theloai'");
          } else if ($search) {
            $sanpham = mysqli_query($con, "SELECT * FROM mat_hang WHERE ten_mat_hang LIKE '%$search%' LIMIT " . $sosanphamtrongtrang . " OFFSET " . $offset);
            $tongsotrang = mysqli_query($con, "SELECT * FROM mat_hang WHERE ten_mat_hang LIKE '%$search%'");
          } else {
            $sanpham = mysqli_query($con, "SELECT * FROM mat_hang LIMIT " . $sosanphamtrongtrang . " OFFSET " . $offset);
            $tongsotrang = mysqli_query($con, "SELECT * FROM mat_hang");
          }

          $tongsosp = mysqli_num_rows($tongsotrang);
          $sotrang = ceil($tongsosp / $sosanphamtrongtrang);
          if ($tongsosp > 0) {
            while ($row = mysqli_fetch_array($sanpham)) {
          ?>
              <div class="col-md-3 col-sm-6 col-12" style="cursor: pointer; ">
                <div class="card mb-3" style="width: 100%;">
                  <img id="anh" src="image/<?= $row['image'] ?>" class="card-img" style="aspect-ratio: 4/3;" alt="...">
                  <div class="card-body" style="text-align: center;">
                    <h5 class="card-title product-title"><?= $row['ten_mat_hang'] ?></h5>
                    <div class="card-text product-price">
                      <!-- <span class="del-price"><?= $row['gia_ban'] + 15000 ?> VNĐ</span> -->

                      <span class="new-price"><?= $row['gia_ban'] ?></span><strong> VNĐ</strong>
                    </div>
                    <br>
                    <a class="btn btn-outline-info btn-hover" href="chitietsp.php?sanpham=<?= $row['id'] ?>">Xem chi tiết</a>
                  </div>
                </div>
              </div>
            <?php }
          } else { ?>
            <h2 style="margin: 300px 30px 30px;"> Không tìm thấy sản phẩm</h2>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End product -->
  <!-- Phan trang -->
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <?php
      $para = "";
      $para1 = "";
      if ($theloai) {
        $para1 = "&theloai=" . $theloai;
      }
      if ($search) {
        $para = "&text=" . $search;
      }
      if ($tranghientai > 1) { ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $tranghientai - 1 ?><?= $para ?><?= $para1 ?>" tabindex="-1" aria-disabled="true">Trước</a>
        </li>
      <?php } ?>
      <?php for ($num = 1; $num <= $sotrang; $num++) { ?>
        <?php if ($num != $tranghientai) { ?>
          <?php if ($num > $tranghientai - 3 && $num < $tranghientai + 3) { ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $num ?><?= $para ?><?= $para1 ?>"><?= $num ?></a></li>
          <?php } ?>
        <?php } else { ?>
          <li class="page-item"><strong class="page-link" href=""><?= $num ?></strong></li>
        <?php } ?>
      <?php } ?>
      <?php if ($tranghientai < $sotrang) { ?>
        <li class="page-item">
          <a class="page-link" href="?page=<?= $tranghientai + 1 ?><?= $para ?><?= $para1 ?>">Sau</a>
        </li>
      <?php } ?>
    </ul>
  </nav>
  <!-- End phan trang -->
  <!-- Footer -->
  <footer class="bg-dark text-center text-white">
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
      <a class="text-white" href="https://www.facebook.com/profile.php?id=100008172966669">RauCu24h</a>
    </div>
    <!-- Copyright -->
  </footer>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/Main.js"></script>
  <script>
$(document).ready(function() {
    $( ".navbar-nav .nav-item" ).bind( "click", function(event) {
        event.preventDefault();
        var clickedItem = $( this );
        $( ".mr-auto .nav-item nav-link" ).each( function() {
            $( this ).removeClass( "active" );
        });
        clickedItem.addClass( "active" );
    });
});
</script>
</body>

</html>