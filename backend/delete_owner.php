<?php include "connection.php";
$id_owner=$_GET['id_owner'];
$delete = mysqli_query($koneksi, "DELETE FROM owner WHERE
id_owner='$id_owner'");
header("location: tabel_owner.php");