<?php
include "connection.php";

$vnama_produk = $_POST['nama_produk'];
$vjenis = $_POST['jenis'];
$vharga_awal = $_POST['harga_awal'];
$vharga_akhir = $_POST['harga_akhir'];
$vfoto        = $_FILES['img']['name'];  

move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);  

$sql_insert = mysqli_query($koneksi, "INSERT INTO flash_sale
(foto, nama_produk, jenis, harga_awal, harga_akhir)
VALUES('$vfoto','$vnama_produk', '$vjenis', '$vharga_awal', '$vharga_akhir')");

header("location:tabel_produk.php");
?>