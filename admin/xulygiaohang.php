<?php
include '../connect_db.php';
$id = $_GET['id'];
$sql = "UPDATE don_hang SET trang_thai = '0' WHERE id = '$id'";
$query = mysqli_query($con, $sql);
header('location: ./donhang.php');
