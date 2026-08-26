<?php

include "connection.php";

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$sql_login = mysqli_query(
    $koneksi,
    "SELECT * FROM login 
    WHERE email='$email' 
    AND password='$password'"
);

$cek = mysqli_num_rows($sql_login);

if ($cek > 0) {

    // mengambil seluruh data user yang berhasil login
    $data = mysqli_fetch_assoc($sql_login);

    // simpan ke session
    $_SESSION['id_login'] = $data['id_login'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['role'] = $data['role'];
    $_SESSION['status'] = "login";

    header("Location:index.php");
    exit;

} else {

    header("Location:login.php?pesan=gagal");
    exit;
}

?>