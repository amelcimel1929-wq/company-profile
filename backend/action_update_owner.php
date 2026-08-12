<?php
include "connection.php";

$id_owner = $_POST['id_owner'];
$vdeskripsi = $_POST['deskripsi'];

// cek dulu, apakah user pilih foto baru atau enggak
if (!empty($_FILES['img']['name'])) {
    // kalau ada foto baru, upload dan pakai nama foto baru
    $vfoto = $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);
} else {
    // kalau foto dikosongin, pakai foto lama biar gak hilang
    $vfoto = $_POST['foto_lama'];
}

$update_owner = mysqli_query($koneksi,
"UPDATE owner SET
deskripsi='$vdeskripsi',
foto='$vfoto'
WHERE id_owner='$id_owner'"
);

header("Location:tabel_owner.php");
?>