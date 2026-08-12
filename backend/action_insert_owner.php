<?php
include "connection.php";


$vfoto        = $_FILES['img']['name'];  
$vdeskripsi = $_POST['deskripsi'];

move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);  

$sql_insert = mysqli_query($koneksi, "INSERT INTO owner
(foto, deskripsi)
VALUES('$vfoto','$vdeskripsi')");

header("location:tabel_owner.php");
?>