<?php
include "connection.php";

$id_flash_sale = (int) $_POST['id_flash_sale'];
$vid_product   = isset($_POST['id_product']) ? (int) $_POST['id_product'] : 0;
$vjenis        = $_POST['jenis'];
$vharga_akhir  = $_POST['harga_akhir'];

// Produk wajib valid: id_product inilah yang dipakai saat pemesanan flash sale.
$stmt = mysqli_prepare($koneksi, "SELECT name_product, price, image FROM products WHERE id_product = ?");
mysqli_stmt_bind_param($stmt, 'i', $vid_product);
mysqli_stmt_execute($stmt);
$produk = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$produk) {
    exit('Produk tidak ditemukan. Pilih produk yang valid.');
}

// Nama produk dan harga awal ikut produk asli supaya tidak beda dengan katalog.
$vnama_produk = $produk['name_product'];
$vharga_awal  = $produk['price'];

// Cek dulu apakah user upload foto baru atau tidak
if (!empty($_FILES['img']['name'])) {
    // Ada foto baru diupload -> proses foto & update semua kolom termasuk foto
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);

    $update = mysqli_prepare($koneksi,
        "UPDATE flash_sale SET
        id_product=?,
        nama_produk=?,
        jenis=?,
        harga_awal=?,
        harga_akhir=?,
        foto=?
        WHERE id_flash_sale=?"
    );
    mysqli_stmt_bind_param($update, 'issddsi', $vid_product, $vnama_produk, $vjenis, $vharga_awal, $vharga_akhir, $vfoto, $id_flash_sale);
} else {
    // Tidak ada foto baru -> update semua kolom KECUALI foto (foto lama tetap dipakai)
    $update = mysqli_prepare($koneksi,
        "UPDATE flash_sale SET
        id_product=?,
        nama_produk=?,
        jenis=?,
        harga_awal=?,
        harga_akhir=?
        WHERE id_flash_sale=?"
    );
    mysqli_stmt_bind_param($update, 'issddi', $vid_product, $vnama_produk, $vjenis, $vharga_awal, $vharga_akhir, $id_flash_sale);
}

mysqli_stmt_execute($update);
mysqli_stmt_close($update);

header("Location:tabel_flash_sale.php");
?>
