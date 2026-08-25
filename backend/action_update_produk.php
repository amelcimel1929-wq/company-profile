<?php
include "connection.php";
include "product_image_helper.php";

$id_product   = (int) $_POST['id_product'];
$id_category  = $_POST['id_category'];
$name_product = $_POST['name_product'];
$description  = $_POST['description'];
$price        = $_POST['price'];
$stock        = $_POST['stock'];

$update = mysqli_query($koneksi, "UPDATE products SET
            id_category = '$id_category',
            name_product = '$name_product',
            description = '$description',
            price = '$price',
            stock = '$stock'
            WHERE id_product = '$id_product'");

if (!$update) {
    die('Gagal memperbarui data: ' . mysqli_error($koneksi));
}

// Foto tambahan (opsional) -- di-append ke galeri, gak nimpa foto yg sudah ada.
$fileList = normalize_uploaded_files($_FILES['images'] ?? []);
if (count($fileList) > 0) {
    $existing_count = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM product_images WHERE id_product = $id_product"))['total'];
    if ($existing_count + count($fileList) > PRODUCT_IMAGE_MAX) {
        die('Total foto gak boleh lebih dari ' . PRODUCT_IMAGE_MAX . '. Sekarang sudah ada ' . $existing_count . ', kamu coba tambah ' . count($fileList) . '.');
    }

    $uploaded = upload_product_images($fileList);
    if ($uploaded === false) {
        die('Gagal mengunggah salah satu foto tambahan ke folder foto/.');
    }

    $next_sort = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COALESCE(MAX(sort_order), -1) + 1 AS next_sort FROM product_images WHERE id_product = $id_product"))['next_sort'];
    foreach ($uploaded as $offset => $filename) {
        $filename_aman = mysqli_real_escape_string($koneksi, $filename);
        $sort_order = $next_sort + $offset;
        mysqli_query($koneksi, "INSERT INTO product_images (id_product, image, sort_order) VALUES ($id_product, '$filename_aman', $sort_order)");
    }

    // Kalau produk ini belum pernah punya baris galeri sama sekali (edge case:
    // langsung POST ke sini tanpa lewat update_form_produk.php dulu), foto
    // baru ini jadi foto utama juga.
    sync_primary_product_image($koneksi, $id_product);
}

header("Location: tabel_produk.php");
