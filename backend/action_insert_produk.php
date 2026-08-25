<?php
include "connection.php";
include "product_image_helper.php";

$id_category  = $_POST['id_category'];
$name_product = $_POST['name_product'];
$description  = $_POST['description'];
$price        = $_POST['price'];
$stock        = $_POST['stock'];

$fileList = normalize_uploaded_files($_FILES['images'] ?? []);

if (count($fileList) < PRODUCT_IMAGE_MIN) {
    die('Minimal upload 1 foto produk.');
}
if (count($fileList) > PRODUCT_IMAGE_MAX) {
    die('Maksimal 5 foto produk, kamu upload ' . count($fileList) . '.');
}

$uploaded = upload_product_images($fileList);
if ($uploaded === false) {
    die('Gagal mengunggah salah satu foto ke folder foto/.');
}

// Foto pertama yg diupload jadi foto utama (products.image), biar semua
// tempat yg cuma nampilin 1 foto (tabel produk, kartu produk, dst) tetap jalan.
$new_filename = $uploaded[0];

$insert = mysqli_query($koneksi, "INSERT INTO products (id_category, name_product, description, price, stock, Image)
          VALUES ('$id_category', '$name_product', '$description', '$price', '$stock', '$new_filename')");

if (!$insert) {
    foreach ($uploaded as $f) {
        @unlink("foto/" . $f);
    }
    die('Gagal query database: ' . mysqli_error($koneksi));
}

$id_product = mysqli_insert_id($koneksi);
foreach ($uploaded as $sort_order => $filename) {
    $filename_aman = mysqli_real_escape_string($koneksi, $filename);
    mysqli_query($koneksi, "INSERT INTO product_images (id_product, image, sort_order) VALUES ($id_product, '$filename_aman', $sort_order)");
}

header("Location: tabel_produk.php");
