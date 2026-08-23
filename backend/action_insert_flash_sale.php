<?php
include "connection.php";

$vid_product  = isset($_POST['id_product']) ? (int) $_POST['id_product'] : 0;
$vharga_akhir = $_POST['harga_akhir'];

// Produk wajib valid: id_product inilah yang nanti dipakai saat pemesanan flash sale.
// "jenis" gak diinput manual lagi -- diambil dari kategori produknya sendiri
// (products.id_category), soalnya udah ada di sana, gak perlu diketik ulang.
$stmt = mysqli_prepare($koneksi, "SELECT p.name_product, p.price, p.image, c.name_kategori
                                   FROM products p LEFT JOIN categories c ON c.id_category = p.id_category
                                   WHERE p.id_product = ?");
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
$vjenis       = $produk['name_kategori'] ?? '';

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
