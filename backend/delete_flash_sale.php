<?php include "connection.php";
$id_flash_sale=$_GET['id_flash_sale'];
$delete = mysqli_query($koneksi, "DELETE FROM flash_sale WHERE
id_flash_sale='$id_flash_sale'");
header("location: tabel_flash_sale.php");