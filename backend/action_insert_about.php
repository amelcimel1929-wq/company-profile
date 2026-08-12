<?php
include "connection.php";

$vbrand     = $_POST['nama_brand'];
$vfoto      = $_FILES['img']['name'];
$vdeskripsi = $_POST['deskripsi'];

// pindahin foto ke folder foto
move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);

$sql_insert = mysqli_query($koneksi, "INSERT INTO about
(nama_brand, foto, deskripsi)
VALUES('$vbrand','$vfoto','$vdeskripsi')");

header("location:tabel_about.php");
?>