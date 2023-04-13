<?php
include '../connect_db.php';
$id = $_GET['id'];
$sql = "DELETE FROM danh_muc_mat_hang where id = $id";
$query = mysqli_query($con, $sql);
header('location: ./danhmuc.php');
