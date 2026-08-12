<?php
include "connection.php";

$vno_telepon = $_POST['no_telepon'];
$vemail = $_POST['email'];
$vinstagram = $_POST['instagram'];


move_uploaded_file($_FILES['img']['tmp_name'], "foto/" . $vfoto);  

$sql_insert = mysqli_query($koneksi, "INSERT INTO contact
(no_telepon, email, instagram)
VALUES('$vno_telepon', '$vemail', '$vinstagram')");

header("location:tabel_contact.php");
?>