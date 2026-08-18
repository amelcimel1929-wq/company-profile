<?php
include "connection.php";

$id_category  = $_POST['id_category'];
$name_product = $_POST['name_product'];
$description  = $_POST['description'];
$price        = $_POST['price'];
$stock        = $_POST['stock'];

// Ambil nama file dari form input name="image"
$filename     = $_FILES['image']['name'];
$tmp_name     = $_FILES['image']['tmp_name'];

// Beri nama acak berbasis waktu agar nama file tidak bentrok
$new_filename = time() . '_' . $filename;
$folder       = "foto/" . $new_filename;

// Upload gambar ke folder "foto"
if (move_uploaded_file($tmp_name, $folder)) {
    // Simpan $new_filename ke kolom Image
    $insert = mysqli_query($koneksi, "INSERT INTO products (id_category, name_product, description, price, stock, Image) 
              VALUES ('$id_category', '$name_product', '$description', '$price', '$stock', '$new_filename')");

    if ($insert) {
        header("Location: tabel_produk.php");
    } else {
        echo "Gagal query database: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal mengunggah gambar ke folder foto/";
}
?>