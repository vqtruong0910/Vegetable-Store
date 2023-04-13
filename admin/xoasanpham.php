<?php
include '../connect_db.php';
$id = $_GET['id'];
$sql = "DELETE FROM mat_hang where id = $id";
$query = mysqli_query($con, $sql);
$sql = "select image FROM mat_hang where id = $id";
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_all($query);

if (is_file("../image/'" . $result['image'] . "'")) {
  unlink("../image/'" . $result['image'] . "'");
}
header('location: ../admin.php');
