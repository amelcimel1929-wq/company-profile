<?php include "connection.php";
$id_product = (int) $_GET['id_product'];

// Kumpulin semua nama file foto dulu sebelum baris-barisnya kehapus --
// DELETE FROM products bakal nge-CASCADE hapus baris product_images-nya,
// tapi CASCADE cuma bersihin baris DB, file fisik di folder foto/ gak
// ikut kehapus kalau gak di-unlink manual di sini.
$fotos = mysqli_query($koneksi, "SELECT image FROM product_images WHERE id_product = $id_product");
$foto_files = mysqli_fetch_all($fotos, MYSQLI_ASSOC);

$delete = mysqli_query($koneksi, "DELETE FROM products WHERE id_product = $id_product");

if ($delete) {
    foreach ($foto_files as $f) {
        @unlink("foto/" . $f['image']);
    }
}

header("location: tabel_produk.php");
