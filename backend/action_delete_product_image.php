<?php
include "connection.php";
include "product_image_helper.php";

$id_image   = isset($_GET['id_image']) ? (int) $_GET['id_image'] : 0;
$id_product = isset($_GET['id_product']) ? (int) $_GET['id_product'] : 0;

if ($id_image <= 0 || $id_product <= 0) {
    header("Location: tabel_produk.php");
    exit();
}

// Pastikan foto ini bener2 punya produk yg dimaksud (jaga2 dari id_image
// nyasar produk lain lewat URL), sekalian ambil nama filenya buat dihapus.
$res = mysqli_query($koneksi, "SELECT image FROM product_images WHERE id_image = $id_image AND id_product = $id_product");
$img = mysqli_fetch_assoc($res);

if (!$img) {
    header("Location: update_form_produk.php?id_product=$id_product");
    exit();
}

// Jangan sampai galeri kosong -- minimal 1 foto harus tetap ada.
$total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM product_images WHERE id_product = $id_product"))['total'];
if ($total <= PRODUCT_IMAGE_MIN) {
    header("Location: update_form_produk.php?id_product=$id_product");
    exit();
}

mysqli_query($koneksi, "DELETE FROM product_images WHERE id_image = $id_image");
@unlink("foto/" . $img['image']);

// Foto yg dihapus tadi mungkin foto utama (products.image) -- geser ke
// foto berikutnya yg masih tersisa.
sync_primary_product_image($koneksi, $id_product);

header("Location: update_form_produk.php?id_product=$id_product");
