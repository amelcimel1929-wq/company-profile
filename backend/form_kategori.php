<?php include 'components/header.php'; ?>
<link href="css/custom-style.css" rel="stylesheet">
<body id="page-top"><div id="wrapper"><?php include 'components/sidebar.php'; ?><div id="content-wrapper" class="d-flex flex-column"><div id="content"><?php include 'components/topbar.php'; ?>
<div class="container-fluid"><h1 class="h3 mb-4">Tambah Kategori</h1>
<form action="action_insert_kategori.php" method="post" style="max-width:500px;">
    <div class="mb-3"><label for="name_kategori" class="form-label">Nama Kategori</label><input id="name_kategori" name="name_kategori" class="form-control" placeholder="Contoh: Dress atau Kemeja" required></div>
    <button class="btn btn-pink-add">Simpan</button><a href="tabel_kategori.php" class="btn btn-secondary">Batal</a>
</form></div></div><?php include 'components/footer.php'; ?></div></div><?php include 'partials/bottom.php'; ?></body></html>
