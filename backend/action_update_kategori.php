<?php
require 'connection.php';
$id = isset($_POST['id_category']) ? (int) $_POST['id_category'] : 0;
$name = trim($_POST['name_kategori'] ?? '');
if ($id <= 0 || $name === '') exit('Data kategori tidak valid.');
$stmt = mysqli_prepare($koneksi, 'UPDATE categories SET name_kategori = ? WHERE id_category = ?');
mysqli_stmt_bind_param($stmt, 'si', $name, $id);
mysqli_stmt_execute($stmt);
header('Location: tabel_kategori.php');
exit;
?>
