<?php
include "connection.php";

$id_bestseller = $_POST['id_bestseller'];
$vnama_produk   = $_POST['nama_produk'];
$vharga  = $_POST['harga'];

// Ambil foto lama dulu, buat fallback kalau user gak ganti foto
$select_lama = mysqli_query($koneksi, "SELECT foto FROM bestseller WHERE id_bestseller='$id_bestseller'");
$data_lama = mysqli_fetch_object($select_lama);
$vfoto = $data_lama->foto;

// Kalau user upload foto baru
if (!empty($_FILES['img']['name'])) {
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);
}

$update_bestseller = mysqli_query($koneksi, "UPDATE bestseller SET
    foto='$vfoto',
    nama_produk='$vnama_produk',
    harga='$vharga'
    WHERE id_bestseller='$id_bestseller'"
);

header("Location:tabel_bestseller.php");
?>