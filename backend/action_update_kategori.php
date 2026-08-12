<?php
include "connection.php";

$id_kategori = $_POST['id_kategori'];
$vmodel_baju   = $_POST['nama_model_baju'];
$vjenis_kategori = $_POST['jenis_kategori'];
$vfoto         = $_FILES['img']['name'];
$vharga = $_POST['harga'];
$vstatus = $_POST['status'];

// pindahin foto baru ke folder foto
move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);

$update_kategori = mysqli_query($koneksi,
"UPDATE kategori SET
nama_model_baju='$vmodel_baju',
jenis_kategori='$vjenis_kategori',
foto='$vfoto',
harga='$vharga',
status='$vstatus'
WHERE id_kategori='$id_kategori'"
);

header("Location:tabel_kategori.php");
?>