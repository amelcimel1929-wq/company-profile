<!-- from file update_form_profile.php -->

<?php

include "connection.php";

// $vnama untuk penyimpanan sedangkan $_POST menerima inputan name="nama"
// form_profile.php
$id_login = $_POST['id_login'];
$vemail = $_POST['email'];
$vpassword = $_POST['password'];

$update_login = mysqli_query($koneksi, "UPDATE login SET
    email='$vemail',
    password='$vpassword'
    WHERE id_login='$id_login'"
);

header("Location:tabel_login.php");

?>