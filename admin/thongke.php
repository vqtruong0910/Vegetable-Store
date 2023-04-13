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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../font-awesome/css/all.css">
    <link rel="stylesheet" href="../css/admin.css">

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
        <h1 class="text-center" style="margin-top: 20px;">Thống kê theo mặt hàng</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tên mặt hàng</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                date_default_timezone_set("Asia/Ho_Chi_Minh");

                $sql = "SELECT id_mat_hang, SUM(so_luong) AS SL, SUM(thanh_tien) AS TT FROM `chi_tiet_don_hang` GROUP BY id_mat_hang";
                $sql_query = mysqli_query($con, $sql);
                $tongtien = 0;
                while ($row = mysqli_fetch_assoc($sql_query)) { ?>
                    <tr>
                        <?php
                        $idmathang = $row['id_mat_hang'];
                        $sqlmh = "SELECT ten_mat_hang FROM `mat_hang` WHERE id = '" . $idmathang . "'";
                        $sql_querymh = mysqli_query($con, $sqlmh);
                        $rowmh = mysqli_fetch_assoc($sql_querymh);
                        $tongtien += $row['TT'];
                        ?>
                        <td><?= $rowmh['ten_mat_hang']; ?></td>
                        <td><?= $row['SL']; ?></td>
                        <td><?= $row['TT']; ?>đ</td>
                    </tr>
                <?php } ?>

            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h5><?= $tongtien; ?>đ</h5>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>