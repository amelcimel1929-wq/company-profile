<?php include "connection.php";
$id_about=$_GET['id_about'];
$delete = mysqli_query($koneksi, "DELETE FROM about WHERE
id_about='$id_about'");
header("location: tabel_about.php");