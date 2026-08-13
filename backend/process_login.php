<?php
include "connection.php";

// mengaktifkan session di php. Mksdnya adlh ketika kita login, php MyAdmin akan
// menyimpan data login. Ketika kita logout, maka SESSION akan menghapus data login
// yg tertinggal di halaman WEB.
session_start();

// menampung data dari login.php
$email = $_POST['email'];
$password = $_POST['password'];

// query atau kode MySQL untuk memfilter email dan password yang ada di phpmyadmin
$sql_login = mysqli_query($koneksi, "SELECT * FROM login WHERE email='$email' AND password='$password'");
$cek = mysqli_num_rows($sql_login);

if ($cek > 0) {

    // menyimpan data session email dan membuat session status = "login"
    $_SESSION['email'] = $email;
    $_SESSION['status'] = "login";

    // kalau login berhasil, maka akan diarahkan ke index.php
    header("Location:index.php");

} else {

    // jika login gagal maka akan diarahkan kembali ke halaman LOGIN
    header("Location:login.php?pesan=gagal");
}