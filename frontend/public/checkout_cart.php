<?php
session_start();
require "../../backend/connection.php";
require "../../backend/cart_helper.php";

// Checkout beberapa produk keranjang sekaligus jadi 1 pesanan (order_details
// udah 1-ke-banyak dari sononya, cuma checkout.php lama cuma isi 1 baris).
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php?redirect=' . rawurlencode('keranjang.php'));
    exit;
}

$idUser = (int) $_SESSION['id_user'];
ensureCartTables($koneksi);
removeOutOfStockCartItems($koneksi, $idUser);

$selected = array_map('intval', $_POST['selected'] ?? ($_GET['selected'] ?? []));
$selected = array_values(array_unique(array_filter($selected, function ($id) {
    return $id > 0;
})));

if (empty($selected)) {
    header('Location: keranjang.php');
    exit;
}

// Cuma ambil cart_items yang beneran punya user ini & id-nya ada di $selected.
$placeholders = implode(',', array_fill(0, count($selected), '?'));
$types = 'i' . str_repeat('i', count($selected));
$params = array_merge([$idUser], $selected);

// LEFT JOIN flash_sale, divalidasi ulang (id_flash_sale HARUS masih nunjuk produk yang
// sama) -- kalau flash sale-nya udah dihapus/diganti admin, otomatis balik ke harga normal.
$stmt = mysqli_prepare($koneksi, "SELECT ci.id_cart_item, ci.quantity, p.id_product, p.name_product, p.image, p.stock,
                                   COALESCE(fs.harga_akhir, p.price) AS price, (fs.id_flash_sale IS NOT NULL) AS is_flash_sale
                                   FROM carts c
                                   INNER JOIN cart_items ci ON ci.id_cart = c.id_cart
                                   INNER JOIN products p ON p.id_product = ci.id_product
                                   LEFT JOIN flash_sale fs ON fs.id_flash_sale = ci.id_flash_sale AND fs.id_product = ci.id_product
                                   WHERE c.id_user = ? AND p.stock > 0 AND ci.id_cart_item IN ($placeholders)
                                   ORDER BY ci.id_cart_item DESC");
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$items = [];
$total = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $row['quantity'] = min((int) $row['quantity'], (int) $row['stock']);
    $row['subtotal'] = (float) $row['price'] * $row['quantity'];
    $items[] = $row;
    $total += $row['subtotal'];
}
mysqli_stmt_close($stmt);

if (empty($items)) {
    header('Location: keranjang.php?error=soldout');
    exit;
}

$errorMessages = [
    'stok'    => 'Ada produk yang stoknya berubah/tidak cukup. Cek lagi keranjangmu.',
    'telepon' => 'Nomor telepon wajib diisi.',
    'invalid' => 'Data pesanan tidak valid. Coba ulangi dari keranjang.',
];
$error = $errorMessages[$_GET['error'] ?? ''] ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout Keranjang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { background: #fdf3f7; font-family: 'Poppins', sans-serif; color: #4a4a4a; }
        .brand-header { font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 600; color: #4a2e35; }
        .brand-pink { color: #d63384; }
        .card-checkout { background: #fff; border-radius: 20px; border: 1px solid rgba(0,0,0,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.06); }
    </style>
</head>
<body>
<main class="container py-4">
    <div class="text-center mb-3">
        <h1 class="brand-header">preloved by<span class="brand-pink">meii</span> ♡</h1>
    </div>
    <div class="mx-auto" style="max-width: 720px;">
        <a href="keranjang.php" class="text-decoration-none small">&larr; Kembali ke keranjang</a>

        <div class="card card-checkout border-0 p-3 p-md-4 mt-3">
            <h2 class="h5 fw-bold mb-3">Checkout <?= count($items) ?> Produk</h2>

            <?php if ($error): ?>
                <div class="alert alert-danger py-2 small rounded-3"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php foreach ($items as $item): ?>
                <div class="d-flex gap-3 py-2 border-bottom align-items-center">
                    <img src="../../backend/foto/<?= rawurlencode($item['image']) ?>" alt="<?= htmlspecialchars($item['name_product']) ?>" width="64" height="64" class="rounded flex-shrink-0" style="object-fit:cover">
                    <div class="flex-grow-1" style="min-width:0;">
                        <div class="fw-semibold small text-break"><?= htmlspecialchars($item['name_product']) ?><?php if ($item['is_flash_sale']): ?> <span class="badge rounded-pill text-white" style="background:#e83e8c;font-size:.6rem;">⚡</span><?php endif; ?></div>
                        <div class="text-muted small"><?= (int) $item['quantity'] ?> x Rp<?= number_format((float) $item['price'], 0, ',', '.') ?></div>
                    </div>
                    <div class="fw-bold small flex-shrink-0">Rp<?= number_format($item['subtotal'], 0, ',', '.') ?></div>
                </div>
            <?php endforeach; ?>

            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                <span class="fw-semibold">Total Pesanan</span>
                <span class="fs-4 fw-bold" style="color:#d63384">Rp<?= number_format($total, 0, ',', '.') ?></span>
            </div>

            <form action="../../backend/action_insert_order_cart.php" method="post">
                <?php foreach ($items as $item): ?>
                    <input type="hidden" name="id_cart_item[]" value="<?= (int) $item['id_cart_item'] ?>">
                <?php endforeach; ?>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label small fw-semibold text-muted">Nomor Telepon / WhatsApp</label>
                    <input id="no_telepon" type="text" name="no_telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                </div>
                <button type="submit" class="btn w-100 py-2" style="background:#e83e8c; color:#fff; border-radius:12px; font-weight:600;">Buat Pesanan</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
