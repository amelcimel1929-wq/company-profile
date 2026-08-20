<?php
require 'connection.php';
$id = isset($_GET['id_category']) ? (int) $_GET['id_category'] : 0;
$stmt = mysqli_prepare($koneksi, 'SELECT id_category, name_kategori FROM categories WHERE id_category = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$category = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$category) { header('Location: tabel_kategori.php'); exit; }
include 'components/header.php';
?>
<link href="css/custom-style.css" rel="stylesheet">
<body id="page-top"><div id="wrapper"><?php include 'components/sidebar.php'; ?><div id="content-wrapper" class="d-flex flex-column"><div id="content"><?php include 'components/topbar.php'; ?>
<div class="container-fluid"><h1 class="h3 mb-4">Ubah Kategori</h1>
<form action="action_update_kategori.php" method="post" style="max-width:500px;">
    <input type="hidden" name="id_category" value="<?= (int) $category['id_category'] ?>">
    <div class="mb-3"><label for="name_kategori" class="form-label">Nama Kategori</label><input id="name_kategori" name="name_kategori" class="form-control" value="<?= htmlspecialchars($category['name_kategori']) ?>" required></div>
    <button class="btn btn-pink-add">Simpan</button><a href="tabel_kategori.php" class="btn btn-secondary">Batal</a>
</form></div></div><?php include 'components/footer.php'; ?></div></div><?php include 'partials/bottom.php'; ?></body></html>
