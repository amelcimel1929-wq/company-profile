<?php
include "connection.php";

$id_flash_sale = $_POST['id_flash_sale'];
$vproduk       = $_POST['nama_produk'];
$vjenis        = $_POST['jenis'];
$vharga_awal   = $_POST['harga_awal'];
$vharga_akhir  = $_POST['harga_akhir'];

// Cek dulu apakah user upload foto baru atau tidak
if (!empty($_FILES['img']['name'])) {
    // Ada foto baru diupload -> proses foto & update semua kolom termasuk foto
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);

    $update_produk = mysqli_query($koneksi,
        "UPDATE flash_sale SET
        nama_produk='$vproduk',
        jenis='$vjenis',
        harga_awal='$vharga_awal',
        harga_akhir='$vharga_akhir',
        foto='$vfoto'
        WHERE id_flash_sale='$id_flash_sale'"
    );
} else {
    // Tidak ada foto baru -> update semua kolom KECUALI foto (foto lama tetap dipakai)
    $update_produk = mysqli_query($koneksi,
        "UPDATE flash_sale SET
        nama_produk='$vproduk',
        jenis='$vjenis',
        harga_awal='$vharga_awal',
        harga_akhir='$vharga_akhir'
        WHERE id_flash_sale='$id_flash_sale'"
    );
}

header("Location:tabel_flash_sale.php");
?>