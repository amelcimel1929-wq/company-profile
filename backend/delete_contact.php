<?php include "connection.php";
$id_contact=$_GET['id_contact'];
$delete = mysqli_query($koneksi, "DELETE FROM contact WHERE
id_contact='$id_contact'");
header("location: tabel_contact.php");