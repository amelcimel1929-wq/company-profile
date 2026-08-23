<?php
session_start();
require "../../backend/connection.php";

// Kasih ulasan buat produk di 1 pesanan -- cuma bisa kalau pesanannya udah
// beneran "Sudah Diambil" (biar gak ada yang review produk yang belum diterima).
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
$idUser = (int) $_SESSION['id_user'];
$idOrder = isset($_GET['id_order']) ? (int) $_GET['id_order'] : 0;

$orderStmt = mysqli_prepare($koneksi, "SELECT id_order, order_code, status FROM orders WHERE id_order = ? AND id_user = ?");
mysqli_stmt_bind_param($orderStmt, 'ii', $idOrder, $idUser);
mysqli_stmt_execute($orderStmt);
$order = mysqli_fetch_assoc(mysqli_stmt_get_result($orderStmt));
mysqli_stmt_close($orderStmt);

if (!$order) {
    exit('Pesanan tidak ditemukan atau bukan milik Anda.');
}
if ($order['status'] !== 'Sudah Diambil') {
    exit('Ulasan cuma bisa diisi untuk pesanan yang statusnya "Sudah Diambil".');
}

// Produk di pesanan ini, plus review yang udah pernah ditulis (kalau ada) --
// satu user cuma punya 1 review per produk, submit ulang = update.
// (Gak perlu GROUP BY -- 1 order gak pernah punya 2 baris order_details buat
// produk yang sama, cart_items sendiri udah unique per produk sebelum checkout.)
$itemsStmt = mysqli_prepare($koneksi, "SELECT d.id_product, p.name_product, p.image,
                                        r.id_review, r.rating, r.review, r.photo
                                        FROM order_details d
                                        JOIN products p ON p.id_product = d.id_product
                                        LEFT JOIN product_reviews r ON r.id_product = d.id_product AND r.id_user = ?
                                        WHERE d.id_order = ?");
mysqli_stmt_bind_param($itemsStmt, 'ii', $idUser, $idOrder);
mysqli_stmt_execute($itemsStmt);
$items = mysqli_stmt_get_result($itemsStmt);
$rows = [];
while ($row = mysqli_fetch_assoc($items)) {
    $rows[] = $row;
}
mysqli_stmt_close($itemsStmt);

$success = isset($_GET['success']);
$error = isset($_GET['error']) ? 'Rating dan ulasan wajib diisi.' : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beri Ulasan - <?= htmlspecialchars($order['order_code']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { background: #fdf3f7; font-family: 'Poppins', sans-serif; color: #4a4a4a; }
        .brand-header { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 600; color: #4a2e35; }
        .brand-pink { color: #d63384; }
        .card-review { background: #fff; border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 6px 20px rgba(0,0,0,0.06); }
        .star-rating { display: inline-flex; flex-direction: row-reverse; gap: 4px; }
        .star-rating input { display: none; }
        .star-rating label { font-size: 1.6rem; color: #e0e0e0; cursor: pointer; }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label { color: #f8b400; }
    </style>
</head>
<body>
<main class="container py-4">
    <div class="text-center mb-3">
        <h1 class="brand-header">preloved by<span class="brand-pink">meii</span> ♡</h1>
    </div>
    <div class="mx-auto" style="max-width: 720px;">
        <a href="status_pesanan.php" class="text-decoration-none small">&larr; Kembali ke Status Pesanan</a>

        <h2 class="h5 fw-bold mt-3 mb-1">Beri Ulasan</h2>
        <p class="text-muted small mb-3">Pesanan <?= htmlspecialchars($order['order_code']) ?></p>

        <?php if ($success): ?>
            <div class="alert alert-success py-2 small rounded-3">Ulasan berhasil disimpan. Makasih ya! ♡</div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger py-2 small rounded-3"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php foreach ($rows as $item): ?>
            <div class="card card-review border-0 p-3 p-md-4 mb-3">
                <div class="d-flex gap-3 align-items-center mb-3">
                    <img src="../../backend/foto/<?= rawurlencode($item['image']) ?>" alt="<?= htmlspecialchars($item['name_product']) ?>" width="60" height="60" class="rounded" style="object-fit:cover">
                    <h3 class="h6 mb-0 fw-bold"><?= htmlspecialchars($item['name_product']) ?></h3>
                </div>

                <?php if ($item['id_review']): ?>
                    <div class="alert alert-light border small mb-0">
                        <div class="mb-1">Ulasanmu: <span style="color:#f8b400;"><?= str_repeat('★', (int) $item['rating']) . str_repeat('☆', 5 - (int) $item['rating']) ?></span></div>
                        <div><?= nl2br(htmlspecialchars($item['review'])) ?></div>
                        <?php if (!empty($item['photo'])): ?>
                            <img src="../../backend/foto/<?= rawurlencode($item['photo']) ?>" alt="Foto ulasan" class="rounded mt-2" width="80" height="80" style="object-fit:cover">
                        <?php endif; ?>
                    </div>
                    <p class="text-muted small mt-2 mb-0">Kirim form di bawah lagi kalau mau ganti ulasan ini.</p>
                <?php endif; ?>

                <form action="../../backend/action_insert_review.php" method="post" enctype="multipart/form-data" class="mt-3">
                    <input type="hidden" name="id_order" value="<?= (int) $idOrder ?>">
                    <input type="hidden" name="id_product" value="<?= (int) $item['id_product'] ?>">

                    <div class="mb-2">
                        <label class="form-label small fw-semibold text-muted d-block">Rating</label>
                        <div class="star-rating">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <input type="radio" name="rating" id="star<?= $i ?>_<?= (int) $item['id_product'] ?>" value="<?= $i ?>" <?= (int) ($item['rating'] ?? 5) === $i ? 'checked' : '' ?> required>
                                <label for="star<?= $i ?>_<?= (int) $item['id_product'] ?>">★</label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="mb-2">
                        <textarea name="review" class="form-control" rows="2" placeholder="Ceritain pengalamanmu sama produk ini..." required><?= htmlspecialchars($item['review'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-muted">Foto (opsional)</label>
                        <input type="file" name="photo" class="form-control form-control-sm" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-sm" style="background:#e83e8c; color:#fff; border-radius:10px; font-weight:600;">
                        <?= $item['id_review'] ? 'Update Ulasan' : 'Kirim Ulasan' ?>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>
