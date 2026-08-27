<?php

include "connection.php";

session_start();

// CEK SUDAH LOGIN ATAU BELUM
if (!isset($_SESSION['status'])) {
    header("Location:login.php");
    exit;
}

// HANYA SUPERADMIN
if ($_SESSION['role'] != "superadmin") {
    echo "Anda tidak memiliki akses.";
    exit;
}

$email    = $_POST['email'];
$password = $_POST['password'];

// Kunci role otomatis jadi admin
$role     = 'admin';

// SIMPAN DATA
// Sesuaikan $koneksi dengan variabel koneksi di file connection.php kamu (misal $conn)
$insert = mysqli_query(
    $koneksi,
    "INSERT INTO login (email, password, role) VALUES ('$email', '$password', '$role')"
);

if ($insert) {
    header("Location:tabel_login.php");
    exit;
} else {
    echo "Data gagal ditambahkan: " . mysqli_error($koneksi);
}

?>