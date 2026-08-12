<?php
include "connection.php";

$id_produk = $_POST['id_produk'];
$vproduk   = $_POST['nama_produk'];
$vfoto     = $_FILES['img']['name'];

// pindahin foto baru ke folder foto
move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);

$update_produk = mysqli_query($koneksi,
"UPDATE produk SET
nama_produk='$vproduk',
foto='$vfoto'
WHERE id_produk='$id_produk'"
);

header("Location:tabel_produk.php");
?>