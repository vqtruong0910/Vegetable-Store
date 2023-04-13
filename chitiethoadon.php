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
    <!-- Orderdetail -->
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá tiền (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $mahd = isset($_GET['orderdetail']) ? $_GET['orderdetail'] : "";
                $sqlquery = mysqli_query($con, "SELECT chi_tiet_don_hang.id_mat_hang , chi_tiet_don_hang.thanh_tien , so_luong , tong_tien from don_hang inner join chi_tiet_don_hang on don_hang.id = chi_tiet_don_hang.id_don_hang where don_hang.id =" .$mahd. "");
                if (!empty($sqlquery)) {
                    $i = 1;
                    while ($rows = mysqli_fetch_array($sqlquery)) { ?>
                        <tr>
                            <th scope="row"><?= $i++ ?></th>
                            <?php
                            $idproduct = $rows['id_mat_hang'];
                            $tensp = mysqli_query($con, "SELECT * FROM `mat_hang` WHERE `id` = " . $idproduct . "");
                            if (!empty($tensp)) {
                                while ($name = mysqli_fetch_array($tensp)) {
                            ?>
                                    <td><img src="./image/<?= $name['image'] ?>" alt="Sản phẩm" class="img-responsive" width="100"></td>
                                    <td><?= $name['ten_mat_hang'] ?></td>
                            <?php }
                            } ?>
                            <td><?= $rows['so_luong'] ?></td>
                            <td><?= $rows['thanh_tien'] * $rows['so_luong'] ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <!-- Close orderdetail -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>