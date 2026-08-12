<?php
include "connection.php";

$id_about   = $_POST['id_about'];
$vbrand     = $_POST['nama_brand'];
$vdeskripsi = $_POST['deskripsi'];

if (empty($_FILES['img']['name'])) {
    // kalau foto gak diganti, pakai foto lama
    $vfoto = $_POST['foto_lama'];
} else {
    // kalau ada foto baru, upload foto baru
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);
}

$update_about = mysqli_query($koneksi,
"UPDATE about SET
nama_brand='$vbrand',
foto='$vfoto',
deskripsi='$vdeskripsi'
WHERE id_about='$id_about'"
);

header("Location:tabel_about.php");
?>