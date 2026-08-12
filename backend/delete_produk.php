<?php include "connection.php";
$id_produk=$_GET['id_produk'];
$delete = mysqli_query($koneksi, "DELETE FROM produk WHERE
id_produk='$id_produk'");
header("location: tabel_produk.php");