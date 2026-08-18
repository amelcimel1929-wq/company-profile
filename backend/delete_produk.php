<?php include "connection.php";
$id_product=$_GET['id_product'];
$delete = mysqli_query($koneksi, "DELETE FROM products WHERE
id_product='$id_product'");
header("location: tabel_produk.php");