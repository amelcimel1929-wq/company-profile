<?php
session_start();
// Detail produk boleh dibuka tanpa login, sama kayak produk.php -- yang wajib
// login itu pas checkout (dicek sendiri di checkout.php).
$isLoggedIn = isset($_SESSION['id_user']);
require "../../backend/connection.php";

$activePage = 'products';
$idProduct = isset($_GET['id_product']) ? (int) $_GET['id_product'] : 0;
if ($idProduct <= 0) {
    header('Location: produk.php');
    exit;
}

$ratingCols = "(SELECT AVG(rating) FROM product_reviews WHERE id_product = p.id_product) AS avg_rating,
               (SELECT COUNT(*) FROM product_reviews WHERE id_product = p.id_product) AS review_count";
$stmt = mysqli_prepare($koneksi, "SELECT p.*, c.name_kategori, $ratingCols FROM products p JOIN categories c ON c.id_category = p.id_category WHERE p.id_product = ?");
mysqli_stmt_bind_param($stmt, "i", $idProduct);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$product) {
    header('Location: produk.php');
    exit;
}

// Galeri foto dari product_images; produk lama yg belum punya baris galeri
// fallback ke products.image tunggal (sama kayak checkout.php).
$galStmt = mysqli_prepare($koneksi, "SELECT image FROM product_images WHERE id_product = ? ORDER BY sort_order ASC, id_image ASC");
mysqli_stmt_bind_param($galStmt, "i", $idProduct);
mysqli_stmt_execute($galStmt);
$galRes = mysqli_stmt_get_result($galStmt);
$galeriFoto = array_column(mysqli_fetch_all($galRes, MYSQLI_ASSOC), 'image');
mysqli_stmt_close($galStmt);
if (empty($galeriFoto) && !empty($product['image'])) {
    $galeriFoto = [$product['image']];
}

$checkoutUrl = 'checkout.php?id_product=' . (int) $product['id_product'];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($product['name_product']) ?> - Produk</title>
    <link href="assets/css/theme.css" rel="stylesheet">
    <style>
        .detail-product-img {
            border-radius: 18px;
            object-fit: contain;
            width: 100%;
            height: 420px;
            background-color: #f8f8f8;
        }
        .thumb-nav {
            width: 60px;
            height: 60px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.55;
            border: 2px solid transparent;
            transition: all 0.2s ease;
        }
        .thumb-nav:hover { opacity: 0.85; }
        .thumb-nav.active { opacity: 1; border-color: #d63384; }
        .carousel-control-prev, .carousel-control-next { width: 12%; }
    </style>
</head>
<body class="bg-light">
<?php include '_navbar.php'; ?>
<main class="container py-5" style="margin-top: 92px;">
    <a class="btn btn-outline-dark btn-sm mb-4" href="produk.php">&larr; Kembali ke Koleksi Produk</a>

    <div class="card border-0 shadow-sm p-3 p-md-4">
        <div class="row g-4 align-items-center">
            <!-- Galeri Foto -->
            <div class="col-md-6 text-center">
                <?php if (count($galeriFoto) <= 1): ?>
                    <img src="../../backend/foto/<?= rawurlencode($galeriFoto[0] ?? '') ?>"
                         class="detail-product-img shadow-sm"
                         alt="<?= htmlspecialchars($product['name_product']) ?>">
                <?php else: ?>
                    <div id="productCarousel" class="carousel slide">
                        <div class="carousel-inner rounded-4 shadow-sm">
                            <?php foreach ($galeriFoto as $i => $foto): ?>
                                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                    <img src="../../backend/foto/<?= rawurlencode($foto) ?>"
                                         class="detail-product-img"
                                         alt="<?= htmlspecialchars($product['name_product']) ?> - foto <?= $i + 1 ?>">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(1) grayscale(1);"></span>
                            <span class="visually-hidden">Sebelumnya</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(1) grayscale(1);"></span>
                            <span class="visually-hidden">Berikutnya</span>
                        </button>
                    </div>
                    <!-- Thumbnail strip -- klik buat lompat langsung ke foto itu -->
                    <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
                        <?php foreach ($galeriFoto as $i => $foto): ?>
                            <img src="../../backend/foto/<?= rawurlencode($foto) ?>"
                                 class="thumb-nav rounded <?= $i === 0 ? 'active' : '' ?>"
                                 data-bs-target="#productCarousel" data-bs-slide-to="<?= $i ?>"
                                 alt="Thumbnail <?= $i + 1 ?>">
                        <?php endforeach; ?>
                    </div>
                    <script>
                        // Thumbnail ikut nyala/redup sesuai slide carousel yg lagi aktif.
                        (function () {
                            var carouselEl = document.getElementById('productCarousel');
                            var thumbs = carouselEl.parentElement.querySelectorAll('.thumb-nav');
                            thumbs.forEach(function (thumb) {
                                thumb.addEventListener('click', function () {
                                    thumbs.forEach(function (t) { t.classList.remove('active'); });
                                    thumb.classList.add('active');
                                });
                            });
                            carouselEl.addEventListener('slid.bs.carousel', function (e) {
                                thumbs.forEach(function (t) { t.classList.remove('active'); });
                                thumbs[e.to].classList.add('active');
                            });
                        })();
                    </script>
                <?php endif; ?>
            </div>

            <!-- Info Produk -->
            <div class="col-md-6">
                <span class="badge bg-secondary text-white mb-2"><?= htmlspecialchars($product['name_kategori']) ?></span>
                <h1 class="h3 fw-bold"><?= htmlspecialchars($product['name_product']) ?></h1>
                <div class="small mb-2">
                    <?php if ((int) $product['review_count'] > 0): ?>
                        <span style="color:#f8b400;">★</span> <?= round((float) $product['avg_rating'], 1) ?> <span class="text-muted">(<?= (int) $product['review_count'] ?> ulasan)</span>
                    <?php else: ?>
                        <span class="text-muted">Belum ada ulasan</span>
                    <?php endif; ?>
                </div>
                <p class="text-muted"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                <p class="fs-3 fw-bold mb-1">Rp<?= number_format((float) $product['price'], 0, ',', '.') ?></p>
                <p class="small text-muted mb-4">Stok: <?= (int) $product['stock'] ?></p>

                <?php if ((int) $product['stock'] > 0): ?>
                    <?php if ($isLoggedIn): ?>
                        <a class="btn btn-dark w-100" href="<?= htmlspecialchars($checkoutUrl) ?>">Pesan Sekarang</a>
                    <?php else: ?>
                        <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#authPromptModal" data-redirect="<?= htmlspecialchars($checkoutUrl) ?>">Pesan Sekarang</button>
                    <?php endif; ?>
                <?php else: ?>
                    <button class="btn btn-secondary w-100" disabled>Stok Habis</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

</main>

<!-- Modal: muncul pas guest klik "Pesan Sekarang" -- sama kayak di produk.php -->
<div class="modal fade" id="authPromptModal" tabindex="-1" aria-labelledby="authPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="authPromptModalLabel">Masuk dulu yuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">Untuk memesan produk ini, silakan login kalau sudah punya akun, atau daftar dulu kalau belum.</p>
            </div>
            <div class="modal-footer">
                <a id="authPromptLoginLink" href="login.php" class="btn btn-outline-dark">Login</a>
                <a id="authPromptRegisterLink" href="register.php" class="btn btn-dark">Register</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('authPromptModal').addEventListener('show.bs.modal', function (event) {
        var redirect = event.relatedTarget.getAttribute('data-redirect') || '';
        var qs = redirect ? '?redirect=' + encodeURIComponent(redirect) : '';
        document.getElementById('authPromptLoginLink').href = 'login.php' + qs;
        document.getElementById('authPromptRegisterLink').href = 'register.php' + qs;
    });
</script>
</body>
</html>
