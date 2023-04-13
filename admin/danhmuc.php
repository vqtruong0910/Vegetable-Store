<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../font-awesome/css/all.css">

    <title>Quản lý danh mục</title>
</head>

<body>
    <?php
    include '../connect_db.php';
    include '../hienidnguoidung.php';
    $error = false;
    if (isset($_POST['AddCategory'])) {
        if (!empty($_POST['NameCate'])) {
            $name = $_POST['NameCate'];
            $queryrg = mysqli_query($con, "INSERT INTO danh_muc_mat_hang VALUES (NULL,'$name')");
            if (!$queryrg) {
                $error = 'Thêm không thành công';
            } else {
                $error = true;
                header("location:./danhmuc.php");
            }
            $error = false;
        } else {
            $error = 'Bạn cần điền đầy đủ thông tin!!!';
        }
    }
    ?>
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
                            <a class="nav-link" href="./danhmuc.php">Danh Mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./donhang.php">Đơn Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./quanlyuser.php">Khách Hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./thongke.php">Thống Kê</a>
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
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <form action="" method="POST">
                    <h4>Add Category</h4>
                    <div class="form-outline">
                        <label class="form-label" for="typeText">Name:</label>
                        <input type="text" name="NameCate" id="typeText" class="form-control" />
                    </div>
                    <br>
                    <input type="submit" name="AddCategory" value="Add" class="btn btn-primary">
                    <?php if ($error != false) { ?>
                        <label class="form-label" for="typeText"><?= $error ?></label>
                    <?php } ?>
                </form>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <h3>Category</h3>
                </div>
                <div class="row">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:20%">#</th>
                                <th style="width:40%">Name</th>
                                <th style="width:20%"></th>
                                <th style="width:20%"></th>
                            </tr>
                        </thead>
                        <?php
                        $liscategory = mysqli_query($con, "SELECT * FROM `danh_muc_mat_hang`");
                        if ($liscategory != null) {
                            $stt = 1;
                            while ($category = mysqli_fetch_assoc($liscategory)) {
                        ?>
                                <tbody>
                                    <tr>
                                        <td data-th="STT" class="text-center"><?= $stt++ ?></td>
                                        <td data-th="ten_danh_muc"><?= $category['ten_danh_muc'] ?></td>
                                        <td><a href="./suadanhmuc.php?id=<?= $category['id'] ?>">Sửa</a></td>
                                        <td><a href="./xoadanhmuc.php?id=<?= $category['id'] ?>">Xóa</a></td>
                                    </tr>
                                </tbody>
                        <?php }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>