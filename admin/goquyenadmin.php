<?php
include '../connect_db.php';
$id = $_GET['id'];
$sql = "UPDATE tai_khoan SET vai_tro = '0' WHERE id = '$id'";
$query = mysqli_query($con, $sql);
header('location: ./quanlyuser.php');
