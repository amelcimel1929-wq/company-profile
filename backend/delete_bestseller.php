<?php include "connection.php";
$id_bestseller=$_GET['id_bestseller'];
$delete = mysqli_query($koneksi, "DELETE FROM bestseller WHERE
id_bestseller='$id_bestseller'");
header("location: tabel_bestseller.php");