<?php
include '../connect_db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../font-awesome/css/all.css">

</head>

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
                            <a class="nav-link" href="../admin.php">Sản Phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./danhmuc.php">Danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./donhang.php">Đơn Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./quanlyuser.php">Khách Hàng</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav px-3">
                        <li class="nav-item text-nowrap">
                            <a class="nav-link" href="">Xin Chào Quản Trị Viên</a>
                        </li>
                        <li class="nav-item text-nowrap">
                            <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
                            <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="dangkyvadangnhap.php">Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
        </nav>
    </div>

    <?php
    include '../connect_db.php';
    $id = $_GET['id'];
    $sql_up = "SELECT * FROM danh_muc_mat_hang where id = $id";
    $query_up = mysqli_query($con, $sql_up);
    $row_up = mysqli_fetch_assoc($query_up);
    if (isset($_POST['sbm'])) {
        $ten_danh_muc = $_POST['ten_danh_muc'];

        $sql = "UPDATE danh_muc_mat_hang SET ten_danh_muc = '" . $ten_danh_muc . "' WHERE id = $id  ";
        $query = mysqli_query($con, $sql);
        header('location: ./danhmuc.php');
    }
    ?>

    <div class="container" id="addproduct">
        <div class="card">
            <div class="card-header">
                <h2>Cập nhật danh mục</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <br>
                        <input type="text" name="ten_danh_muc" class="form-control" required value="<?php echo $row_up['ten_danh_muc']; ?>">
                    </div>
                    <br>
                    <button name="sbm" class="btn btn-primary" type="submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>