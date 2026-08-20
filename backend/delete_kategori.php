<?php
require 'connection.php';
$id = isset($_GET['id_category']) ? (int) $_GET['id_category'] : 0;
if ($id <= 0) { header('Location: tabel_kategori.php'); exit; }

$used = mysqli_prepare($koneksi, 'SELECT 1 FROM products WHERE id_category = ? LIMIT 1');
mysqli_stmt_bind_param($used, 'i', $id);
mysqli_stmt_execute($used);
if (mysqli_fetch_assoc(mysqli_stmt_get_result($used))) {
    exit('Kategori masih dipakai produk dan tidak dapat dihapus. Pindahkan atau hapus produknya terlebih dahulu.');
}
$stmt = mysqli_prepare($koneksi, 'DELETE FROM categories WHERE id_category = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
header('Location: tabel_kategori.php');
exit;
?>
