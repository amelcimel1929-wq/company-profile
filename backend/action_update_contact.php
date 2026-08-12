<?php
include "connection.php";

$id_contact = $_POST['id_contact'];
$vno_telepon = $_POST['no_telepon'];
$vemail = $_POST['email'];
$vinstagram = $_POST['instagram'];

$update_contact = mysqli_query($koneksi,
"UPDATE contact SET
no_telepon='$vno_telepon',
email='$vemail',
instagram='$vinstagram'
WHERE id_contact='$id_contact'"
);

header("Location:tabel_contact.php");
?>