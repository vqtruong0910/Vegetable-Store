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
    <title>Rau Củ 24H</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../font-awesome/css/all.css">
    <link rel="stylesheet" href="../css/admin.css">

</head>
<?php
include '../connect_db.php';
$id = $_GET['id'];
$sql_up = "SELECT * FROM don_hang where id = $id";
$query_up = mysqli_query($con, $sql_up);
$row_up = mysqli_fetch_assoc($query_up);
$iduser = $row_up['id_tai_khoan'];
if (isset($_POST['sbm'])) {
    $nguoi_giao = $_POST['nguoi_giao'];
    $price = $_POST['price'];
    $sql = "UPDATE don_hang SET phi_ship = '" . $price . "', nguoi_giao = '" . $nguoi_giao . "' WHERE id = $id  ";
    $query = mysqli_query($con, $sql);
    header('location: ./donhang.php');
}

$sql_query = mysqli_query($con, "SELECT * FROM tai_khoan WHERE id = '" . $iduser . "'");
$result = mysqli_fetch_assoc($sql_query);
$sql2 = mysqli_query($con, "SELECT * FROM `dia_chi` WHERE `id_khach_hang` = '" . $iduser . "'");
$diachi = mysqli_fetch_array($sql2);
$stringdiaichi = $diachi['chi_tiet']. "," . $diachi['phuong']. ",".$diachi['quan'].",".$diachi['tinh'];
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
                            <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="../dangxuat.php">Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Phân Công giao hàng</h2>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Tên Người Nhận</label>
                        <br>
                        <input type="text" disabled name="nguoi_giao" class="form-control" required value="<?php echo $result['ten_khach']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <br>
                        <input type="text" disabled name="nguoi_giao" class="form-control" required value="<?php echo $stringdiaichi; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">SĐT</label>
                        <br>
                        <input type="text" disabled name="nguoi_giao" class="form-control" required value="<?php echo $result['sdt']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Người giao</label>
                        <br>
                        <input type="text" name="nguoi_giao" class="form-control" required value="<?php echo $row_up['nguoi_giao']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Phí Ship</label>
                        <br>
                        <input type="number" name="price" class="form-control" required value="<?php echo $row_up['phi_ship']; ?>">
                    </div>
                    <br>
                    <button name="sbm" class="btn btn-primary" type="submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>