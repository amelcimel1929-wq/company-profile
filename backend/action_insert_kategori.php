<?php
require 'connection.php';
$name = trim($_POST['name_kategori'] ?? '');
if ($name === '') exit('Nama kategori wajib diisi.');
$stmt = mysqli_prepare($koneksi, 'INSERT INTO categories (name_kategori) VALUES (?)');
mysqli_stmt_bind_param($stmt, 's', $name);
mysqli_stmt_execute($stmt);
header('Location: tabel_kategori.php');
exit;
?>
