<?php
include "connection.php";

$vnama_model_baju = $_POST['nama_model_baju'];
$vjenis_kategori = $_POST['jenis_kategori'];
$vfoto        = $_FILES['img']['name'];
$vharga = $_POST['harga'];  
$vstatus = $_POST['status'];

move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);  

$sql_insert = mysqli_query($koneksi, "INSERT INTO kategori
(foto, nama_model_baju, jenis_kategori, harga, status)
VALUES('$vfoto','$vnama_model_baju','$vjenis_kategori','$vharga','$vstatus')");

header("location:tabel_kategori.php");
?>