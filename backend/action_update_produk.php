<?php
include "connection.php";

$id_product   = $_POST['id_product'];
$id_category  = $_POST['id_category'];
$name_product = $_POST['name_product'];
$description  = $_POST['description'];
$price        = $_POST['price'];
$stock        = $_POST['stock'];

$filename     = $_FILES['image']['name'];

if ($filename != "") {
    $tmp_name     = $_FILES['image']['tmp_name'];
    $new_filename = time() . '_' . $filename;
    $folder       = "foto/" . $new_filename;

    move_uploaded_file($tmp_name, $folder);

    $update = mysqli_query($koneksi, "UPDATE products SET 
                id_category = '$id_category',
                name_product = '$name_product',
                description = '$description',
                price = '$price',
                stock = '$stock',
                image = '$new_filename'
                WHERE id_product = '$id_product'");
} else {
    $update = mysqli_query($koneksi, "UPDATE products SET 
                id_category = '$id_category',
                name_product = '$name_product',
                description = '$description',
                price = '$price',
                stock = '$stock'
                WHERE id_product = '$id_product'");
}

if ($update) {
    header("Location: tabel_produk.php");
} else {
    echo "Gagal memperbarui data: " . mysqli_error($koneksi);
}
?>