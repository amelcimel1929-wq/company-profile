<?php
include "connection.php";

$vnama_produk = $_POST['nama_produk'];
$vfoto        = $_FILES['img']['name'];  

move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);  

$sql_insert = mysqli_query($koneksi, "INSERT INTO produk
(foto, nama_produk)
VALUES('$vfoto','$vnama_produk')");

header("location:tabel_produk.php");
?>