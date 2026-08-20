<?php
require 'connection.php';
$categories = mysqli_query($koneksi, 'SELECT id_category, name_kategori FROM categories ORDER BY id_category DESC');
include 'components/header.php';
?>
<link href="css/custom-style.css" rel="stylesheet">
<body id="page-top"><div id="wrapper">
<?php include 'components/sidebar.php'; ?>
<div id="content-wrapper" class="d-flex flex-column"><div id="content">
<?php include 'components/topbar.php'; ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-3"><h1 class="h3 mb-0" style="color:#7d5260;font-weight:500;">Kategori Produk</h1></div>
    <a href="form_kategori.php" class="btn btn-pink-add mb-3"><i class="fas fa-plus fa-sm"></i> Tambah Kategori</a>
    <div class="table-responsive"><table class="table table-bordered table-pink-custom">
        <thead><tr><th>ID</th><th>Nama Kategori</th><th>Aksi</th></tr></thead>
        <tbody><?php while ($category = mysqli_fetch_assoc($categories)): ?><tr>
            <td><?= (int) $category['id_category'] ?></td>
            <td><?= htmlspecialchars($category['name_kategori']) ?></td>
            <td>
                <a href="update_form_kategori.php?id_category=<?= (int) $category['id_category'] ?>" class="btn btn-pink-update">UPDATE <i class="fas fa-pen"></i></a>
                <a href="delete_kategori.php?id_category=<?= (int) $category['id_category'] ?>" class="btn btn-pink-delete" onclick="return confirm('Hapus kategori ini?')">DELETE <i class="fas fa-trash-alt"></i></a>
            </td>
        </tr><?php endwhile; ?></tbody>
    </table></div>
</div></div><?php include 'components/footer.php'; ?></div></div>
<?php include 'partials/bottom.php'; ?>
</body></html>
