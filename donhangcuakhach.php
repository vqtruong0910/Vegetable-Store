<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rau Củ 24H</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Header -->
    <?php
    include './connect_db.php';
    include './hienidnguoidung.php';
    if (isset($_GET['detroydetail'])) {
        $iddonhang = $_GET['detroydetail'];
        $sqlquery = mysqli_query($con, "UPDATE don_hang SET trang_thai = '-2' WHERE id = '$iddonhang'");
    }
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
                    <form class="d-flex" method="GET" action="./index.php">
                        <input class="form-control me-2" name="text" type="Search" placeholder="Tìm kiếm" aria-label="Search" value="<?= isset($_GET['text']) ? $_GET['text'] : ""; ?>">
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
    <!-- Hien don hang khach hang  -->
    <div class="container">
        <h1 class="text-center" style="margin-top: 20px;">Thông tin đơn hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width: 10%;">Mã đơn hàng</th>
                    <th scope="col" style="width: 10%;">Ngày đặt hàng</th>
                    <th scope="col" style="width: 10%;">Phí ship</th>
                    <th scope="col" style="width: 20%;">Tổng tiền</th>
                    <th scope="col" style="width: 10%;">Người giao</th>
                    <th scope="col" style="width: 15%;">Chi tiết</th>
                    <th scope="col" style="width: 10%;">Trạng thái</th>
                    <th scope="col" style="width: 5%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqlquery = mysqli_query($con, "SELECT * FROM `don_hang` WHERE `id_tai_khoan` = '" . $iduser . "'");
                if (!empty($sqlquery)) {
                    while ($rows = mysqli_fetch_array($sqlquery)) { ?>
                        <tr>
                            <th scope="row"><?= $rows['id'] ?></th>
                            <td><?= $rows['ngay_mua'] ?></td>
                            <td><?= $rows['phi_ship'] ?></td>
                            <td><?= $rows['tong_tien'] + $rows['phi_ship'] ?></td>
                            <td><?= $rows['nguoi_giao'] ?></td>
                            <td><a href="./chitiethoadon.php?orderdetail=<?= $rows['id'] ?>">Xem</a></td>
                            <?php if ($rows['trang_thai'] == 0) { ?>
                                <td><strong style="color: black;">Chưa xử lý</strong></td>
                            <?php } else if ($rows['trang_thai'] == 1) { ?>
                                <td><strong style="color: green;">Đã xử lý</strong></td>
                            <?php } else { ?>
                                <td><strong style="color: red;">Đơn hàng đã bị hủy</strong></td>
                            <?php } ?>
                            <?php if ($rows['trang_thai'] == 0) { ?>
                                <td><a href="./donhangcuakhach.php?detroydetail=<?= $rows['id'] ?>">Hủy</a></td>
                            <?php } ?>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <!-- End don hang khach hang-->
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>