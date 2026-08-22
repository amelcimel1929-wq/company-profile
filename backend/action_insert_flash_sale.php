<?php
include "connection.php";

$vid_product  = isset($_POST['id_product']) ? (int) $_POST['id_product'] : 0;
$vjenis       = $_POST['jenis'];
$vharga_akhir = $_POST['harga_akhir'];

// Produk wajib valid: id_product inilah yang nanti dipakai saat pemesanan flash sale.
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

// Foto opsional: kalau admin tidak upload, pakai foto produk.
if (!empty($_FILES['img']['name'])) {
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);
} else {
    $vfoto = $produk['image'];
}

$insert = mysqli_prepare($koneksi, "INSERT INTO flash_sale
    (id_product, foto, nama_produk, jenis, harga_awal, harga_akhir)
    VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($insert, 'isssdd', $vid_product, $vfoto, $vnama_produk, $vjenis, $vharga_awal, $vharga_akhir);
mysqli_stmt_execute($insert);
mysqli_stmt_close($insert);

header("location:tabel_flash_sale.php");
?>
