<?php
session_start();
require "../../backend/connection.php";

$idProduct = isset($_GET['id_product']) ? (int) $_GET['id_product'] : 0;
if ($idProduct <= 0) {
    header('Location: produk.php');
    exit;
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM products WHERE id_product = ?");
mysqli_stmt_bind_param($stmt, "i", $idProduct);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);
if (!$product) {
    exit('Produk tidak ditemukan.');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan - <?= htmlspecialchars($product['name_product']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5">
    <a href="produk.php" class="btn btn-link text-dark px-0 mb-3">&larr; Kembali ke produk</a>
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="row g-0">
            <div class="col-md-5">
                <img src="../../backend/foto/<?= rawurlencode($product['image']) ?>" class="w-100 h-100" style="min-height: 360px; object-fit: cover;" alt="<?= htmlspecialchars($product['name_product']) ?>">
            </div>
            <div class="col-md-7">
                <div class="card-body p-4 p-lg-5">
                    <p class="text-uppercase small text-muted mb-2">Detail pesanan</p>
                    <h1 class="h2"><?= htmlspecialchars($product['name_product']) ?></h1>
                    <p class="text-muted"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                    <p class="fs-4 fw-bold">Rp<?= number_format((float) $product['price'], 0, ',', '.') ?></p>
                    <p class="small text-muted">Stok tersedia: <?= (int) $product['stock'] ?></p>

                    <?php if ((int) $product['stock'] > 0): ?>
                        <form action="../../backend/action_insert_order.php" method="post" class="mt-4">
                            <input type="hidden" name="id_product" value="<?= (int) $product['id_product'] ?>">
                            <div class="mb-3" style="max-width: 180px;">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <input id="quantity" type="number" name="quantity" class="form-control" value="1" min="1" max="<?= (int) $product['stock'] ?>" required>
                            </div>
                            <button type="submit" class="btn btn-dark btn-lg">Lanjut ke Pembayaran</button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-secondary mb-0">Produk ini sedang habis.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
