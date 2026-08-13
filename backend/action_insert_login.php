<!-- Ini adalah langkah kedua setelah dari FORM_PROFILE.PHP -->
<!-- selanjutnya ke tabel_profile -->

<?php

include "connection.php";

// $vnama untuk penyimpanan sedangkan $_POST menerima inputan name="nama" dr form_profile.php
$vemail = $_POST['email'];
$vpassword = $_POST['password'];

// mysqli_query adalah perintah utk menyatukan koneksi database dengan query tabel.
// (nama, about, website, phone, email, city, linkedin) adalah nama2 kolom database
// ('$vnama','$vdeskripsi','$vwebsite','$vphone','$vemail','$vcity','$linkedin')
// adalah variabel di atas yang sudah kita bikin sebelumnya.
$sql_insert = mysqli_query(
    $koneksi,
    "INSERT INTO login(email,password)
    VALUES ('$vemail','$vpassword')"
);

// header location untuk mengarahkan halaman ke tabel_profile
header("Location:tabel_login.php");