<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rau Củ 24H</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- Header -->
    <?php
    include './connect_db.php';
    include './hienidnguoidung.php';
    ?>
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
                                // Chi co trang thai status la 0 thi moi hiện trang admin
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
                                <li><a class="dropdown-item" href="./taikhoankhachhang.php">Thông tin tài khoản</a></li>
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
    <!-- End header -->
    <?php
    if (isset($_POST['sbm'])) {
        if (empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm-password']) || empty($_POST['ten_khach'])  || empty($_POST['sdt'])) {
            echo "Xin điền đầy đủ thông tin";
        } else {
            if ($_POST['password'] == $_POST['confirm-password']) {
                $email = $_POST['email'];
                $passwordrg = $_POST['password'];
                $ten_khach = $_POST['ten_khach'];
                $sdt  = $_POST['sdt'];
                $query = mysqli_query($con, "UPDATE `tai_khoan` SET `email` = '". $email ."', `mat_khau` = '" . $passwordrg . "', `ten_khach` = '" . $ten_khach . "', `sdt` = '" . $sdt . "' WHERE `tai_khoan`.`id` = $iduser");
                if ($query) {
                    echo "<script type='text/javascript'>alert('Bạn đã thay đổi thông tin tài khoản thành công');</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Thay đổi thông tin tài khoản thất bại');</script>";
                }
            } else {
                echo "Password không trùng nhau";
            }
        }
    }
    // lấy thông tin khách hàng theo 
    $sql = mysqli_query($con, "SELECT * FROM `tai_khoan` WHERE `id` = '" . $iduser . "'");
    if (mysqli_num_rows($sql) == 1) {
        $result = mysqli_fetch_array($sql);
    }
    ?>
    <!-- UPDATE `tai_khoan` SET `ten_tai_khoan` = 'truong', `mat_khau` = '1234', `ten_khach` = 'Trường 09', `sdt` = '090920610', `dia_chi` = 'Quận Cam cali' WHERE `tai_khoan`.`id` = 3; -->
    <!-- Hien don hang khach hang  -->
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data" class="row mx-5 g-3" onsubmit="return confirm('Bạn chắc chắn muốn thay đổi thông tin');" >
           
                <div class="card-header">
                    <h2>Thông Tin Tài Khoản</h2>
                </div>
                <!-- <div class="form-group">
                <label for="">ID sản phẩm</label>
                <input type="text" name="id_product" class="form-control" required>
              </div> -->
                <div class="col-6">
                    <label class="form-label" for="">Tên tài khoản</label>
                    <input type="text" name="username" id="username"  class="form-control" placeholder="Tên tài khoản" value="<?= $result['ten_tai_khoan'] ?>" disabled>
                </div>
                <div class="col-6">
                    <label class="form-label" for="">Email</label>
                    <input type="email" name="email" id="email"  class="form-control" placeholder="Email của bạn" value="<?= $result['email'] ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="">Họ và tên</label>
                    <input type="text" name="ten_khach" id="ten_khach"  class="form-control" placeholder="Họ và tên" value="<?= $result['ten_khach'] ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="">Số điện thoại</label>
                    <input type="text" name="sdt" id="sdt"  class="form-control" placeholder="Số điện thoại" value="<?= $result['sdt'] ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="">Mật khẩu của bạn</label>
                    <input type="password" name="password" id="password"  class="form-control" placeholder="Password" value="<?= $result['mat_khau'] ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label" for="">Nhập lại mật khẩu</label>
                    <input type="password" name="confirm-password" id="confirm-password"  class="form-control" placeholder="Confirm Password" value="<?= $result['mat_khau'] ?>" required>
                </div>
                <div class="col-12">
                    <button name="sbm" class="btn btn-primary" type="submit">Cập nhật</button>
                </div>    
        </form>
    </div>
    <!-- End don hang khach hang-->
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>