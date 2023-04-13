<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../font-awesome/css/all.css">


</head>

<body>
    <?php
    session_start();
    include '../connect_db.php';
    include '../hienidnguoidung.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql1 = mysqli_query($con, "SELECT nguoi_giao, ten_khach , sdt , tai_khoan.id FROM tai_khoan INNER JOIN don_hang ON tai_khoan.id = don_hang.id_tai_khoan WHERE don_hang.id = $id");
        $user = mysqli_fetch_array($sql1);
        $ordersql = mysqli_query($con, "SELECT * FROM chi_tiet_don_hang WHERE id_don_hang =  $id");
        $sql2 = mysqli_query($con, "SELECT * FROM `dia_chi` WHERE `id_khach_hang` = '" . $user['id'] . "'");
        $diachi = mysqli_fetch_array($sql2);
        $stringdiaichi = $diachi['chi_tiet']. "," . $diachi['phuong']. ",".$diachi['quan'].",".$diachi['tinh'];
    }
    ?>
    <div class="container-fluid">
        <div class="border border-success rounded" style="width: fit-content; margin-left: 35%;padding: 30px;margin-top: 5%; ">
            <h1>Chi tiết đơn hàng</h1>
            <label>Người nhận : </label><span><?= $user['ten_khach'] ?></span><br />
            <label>Điện thoại : </label><span><?= $user['sdt'] ?></span><br />
            <label>Địa chỉ : </label><span><?= $stringdiaichi ?></span><br />
            <hr />
            <h3>Danh sách sản phẩm</h3>
            <ul>
                <?php
                $totalQuantity = 0;
                $totalMoney = 0;
                while ($orders = mysqli_fetch_assoc($ordersql)) { ?>
                    <li>
                        <?php
                        $idmh = $orders['id_mat_hang'];
                        $mathangsql = mysqli_query($con, "SELECT * FROM mat_hang WHERE id =  $idmh");
                        $result = mysqli_fetch_assoc($mathangsql);
                        ?>
                        <span class="item-name"><?= $result['ten_mat_hang'] ?></span>
                    </li>
                <?php
                    $totalMoney += ($orders['thanh_tien'] * $orders['so_luong']);
                    $totalQuantity += $orders['so_luong'];
                }
                ?>
            </ul>
            <hr />
            <label>Tổng SL : </label><?= $totalQuantity ?> - <label>Đơn Giá : </label><?= number_format($totalMoney, 0, ",", ".") ?>đ
            <p><label>Người giao hàng : </label><?= $user['nguoi_giao'] ?></p>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>