<?php include "connection.php";
$id_kategori=$_GET['id_kategori'];
$delete = mysqli_query($koneksi, "DELETE FROM kategori WHERE
id_kategori='$id_kategori'");
header("location: tabel_kategori.php");