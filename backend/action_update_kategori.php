<?php
include "connection.php";

$id_kategori     = $_POST['id_kategori'];
$vmodel_baju     = $_POST['nama_model_baju'];
$vjenis_kategori = $_POST['jenis_kategori'];
$vharga          = $_POST['harga'];
$vstatus         = $_POST['status'];

// cek dulu, ada foto baru yang diupload atau enggak
if (empty($_FILES['img']['name'])) {
    // kalau kosong (gak ganti foto), pakai foto lama
    $vfoto = $_POST['foto_lama'];
} else {
    // kalau ada foto baru, upload dan pakai nama foto baru
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);
}

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