<!-- from file update_form_profile.php -->
<?php
include "connection.php";

// $vnama untuk penyimpanan sedangkan $_POST menerima inputan
// name="nama" dr form_profile.php

$id_profile   = $_POST['id_profile'];
$vabout        = $_POST['about'];
$vfoto   = $_POST['foto'];

$update_profile = mysqli_query($koneksi,
"UPDATE profile SET
about='$vabout',
foto='$vfoto'
WHERE id_profile='$id_profile'"
);

header("Location:tabel_profile.php");
?>