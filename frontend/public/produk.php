<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
require "../../backend/connection.php";

$selectedCategory = isset($_GET['id_category']) ? (int) $_GET['id_category'] : 0;
$activePage = 'products';
$categories = mysqli_query($koneksi, "SELECT id_category, name_kategori FROM categories ORDER BY FIELD(LOWER(name_kategori), 'kemeja', 'dress'), name_kategori");

if ($selectedCategory > 0) {
    $stmt = mysqli_prepare($koneksi, "SELECT p.*, c.name_kategori FROM products p JOIN categories c ON c.id_category = p.id_category WHERE p.id_category = ? ORDER BY p.id_product DESC");
    mysqli_stmt_bind_param($stmt, "i", $selectedCategory);
} else {
    $stmt = mysqli_prepare($koneksi, "SELECT p.*, c.name_kategori FROM products p JOIN categories c ON c.id_category = p.id_category ORDER BY p.id_product DESC");
}
mysqli_stmt_execute($stmt);
$products = mysqli_stmt_get_result($stmt);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk</title>
    <!-- assets/css/theme.css SUDAH termasuk Bootstrap sendiri (dikompile ulang,
         variable warnanya beda dari Bootstrap CDN generik) -- ini yang dipakai
         index.php, makanya navbar & tombol harus ikut sini, bukan CDN bootstrap. -->
    <link href="assets/css/theme.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php include '_navbar.php'; ?>
<main class="container py-5">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Koleksi Produk</h1>
            <p class="text-muted mb-0">Pilih kategori Dress atau Kemeja, lalu pesan produk pilihanmu.</p>
        </div>
        <a class="btn btn-outline-dark" href="index.php">Kembali ke Beranda</a>
    </div>

    <nav class="nav nav-pills flex-wrap gap-2 mb-4" aria-label="Kategori produk">
        <a class="nav-link <?= $selectedCategory === 0 ? 'active' : 'text-dark bg-white border' ?>" href="produk.php">Semua</a>
        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
            <a class="nav-link <?= $selectedCategory === (int) $category['id_category'] ? 'active' : 'text-dark bg-white border' ?>"
               href="produk.php?id_category=<?= (int) $category['id_category'] ?>">
                <?= htmlspecialchars($category['name_kategori']) ?>
            </a>
        <?php endwhile; ?>
    </nav>

    <div class="row g-4">
        <?php if (mysqli_num_rows($products) === 0): ?>
            <div class="col-12"><div class="alert alert-info">Belum ada produk pada kategori ini.</div></div>
        <?php endif; ?>
        <?php while ($product = mysqli_fetch_assoc($products)): ?>
            <div class="col-sm-6 col-lg-4">
                <article class="card h-100 shadow-sm border-0">
                    <img src="../../backend/foto/<?= rawurlencode($product['image']) ?>" class="card-img-top" style="height: 340px; object-fit: cover;" alt="<?= htmlspecialchars($product['name_product']) ?>">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary text-white align-self-start mb-2"><?= htmlspecialchars($product['name_kategori']) ?></span>
                        <h2 class="h5"><?= htmlspecialchars($product['name_product']) ?></h2>
                        <p class="text-muted small flex-grow-1"><?= htmlspecialchars($product['description']) ?></p>
                        <p class="fw-bold mb-1">Rp<?= number_format((float) $product['price'], 0, ',', '.') ?></p>
                        <p class="small text-muted">Stok: <?= (int) $product['stock'] ?></p>
                        <?php if ((int) $product['stock'] > 0): ?>
                            <a class="btn btn-dark w-100" href="checkout.php?id_product=<?= (int) $product['id_product'] ?>">Pesan Sekarang</a>
                        <?php else: ?>
                            <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                        <?php endif; ?>
                    </div>
                </article>
            </div>
        <?php endwhile; ?>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
