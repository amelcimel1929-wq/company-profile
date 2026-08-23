<?php
session_start();
require '../../backend/connection.php';
require '../../backend/cart_helper.php';

if (!isset($_SESSION['id_user'])) {
    header('Location: login.php?redirect=' . rawurlencode('keranjang.php'));
    exit;
}

$idUser = (int) $_SESSION['id_user'];
ensureCartTables($koneksi);

// Produk yang ditekan saat belum login dimasukkan sekali setelah login berhasil.
if (isset($_GET['add_pending']) && isset($_SESSION['pending_cart_item'])) {
    $pending = $_SESSION['pending_cart_item'];
    unset($_SESSION['pending_cart_item']);
    $_POST = $pending;
    $_SERVER['REQUEST_METHOD'] = 'POST';
    require '../../backend/action_add_to_cart.php';
    exit;
}

removeOutOfStockCartItems($koneksi, $idUser);
// LEFT JOIN flash_sale, divalidasi ulang (id_flash_sale HARUS masih nunjuk produk
// yang sama) -- kalau flash sale-nya udah dihapus/diganti admin, otomatis balik ke
// harga normal produk (COALESCE), gak ikutan ke-hapus dari keranjang.
$stmt = mysqli_prepare($koneksi, 'SELECT ci.id_cart_item, ci.quantity, ci.id_flash_sale, p.id_product, p.name_product, p.image, p.stock,
    COALESCE(fs.harga_akhir, p.price) AS price, (fs.id_flash_sale IS NOT NULL) AS is_flash_sale
    FROM carts c
    INNER JOIN cart_items ci ON ci.id_cart = c.id_cart
    INNER JOIN products p ON p.id_product = ci.id_product
    LEFT JOIN flash_sale fs ON fs.id_flash_sale = ci.id_flash_sale AND fs.id_product = ci.id_product
    WHERE c.id_user = ? AND p.stock > 0 ORDER BY ci.id_cart_item DESC');
mysqli_stmt_bind_param($stmt, 'i', $idUser);
mysqli_stmt_execute($stmt);
$items = mysqli_stmt_get_result($stmt);
$cartRows = [];
$total = 0;
while ($row = mysqli_fetch_assoc($items)) {
    $row['quantity'] = min((int) $row['quantity'], (int) $row['stock']);
    $cartRows[] = $row;
    $total += (float) $row['price'] * $row['quantity'];
}
mysqli_stmt_close($stmt);
$activePage = 'cart';
?>
<!doctype html>
<html lang="id"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Keranjang Belanja</title><link href="assets/css/theme.css" rel="stylesheet">
</head><body class="bg-light">
<?php include '_navbar.php'; ?>
<main class="container py-5" style="margin-top:92px; max-width:960px;">
    <div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h3 mb-1">Keranjang Belanja</h1><p class="text-muted mb-0">Produk yang stoknya habis otomatis dihapus dari keranjang.</p></div><a class="btn btn-outline-dark" href="index.php#categoryWomen">Lanjut Belanja</a></div>
    <?php if (isset($_GET['success'])): ?><div class="alert alert-success"><?= $_GET['success'] === 'removed' ? 'Produk dihapus dari keranjang.' : 'Produk berhasil ditambahkan ke keranjang.' ?></div><?php endif; ?>
    <?php if (isset($_GET['error'])): ?><div class="alert alert-warning">Produk sudah habis dan tidak bisa dimasukkan ke keranjang.</div><?php endif; ?>
    <?php if (empty($cartRows)): ?>
        <div class="card border-0 shadow-sm"><div class="card-body text-center py-5"><p class="h5">Keranjangmu masih kosong.</p><a class="btn btn-dark mt-2" href="index.php#categoryWomen">Pilih Produk</a></div></div>
    <?php else: ?>
        <!-- Centang produk yang mau di-checkout bareng -> 1 pesanan berisi banyak produk. -->
        <form action="checkout_cart.php" method="post" id="cartCheckoutForm">
        <div class="card border-0 shadow-sm"><div class="card-body p-0">
        <?php foreach ($cartRows as $item): ?>
            <div class="d-flex gap-3 p-3 border-bottom align-items-center">
                <input type="checkbox" name="selected[]" value="<?= (int)$item['id_cart_item'] ?>" class="form-check-input flex-shrink-0 js-cart-select" data-subtotal="<?= (float)$item['price'] * $item['quantity'] ?>" checked style="width:1.2em;height:1.2em;">
                <img src="../../backend/foto/<?= rawurlencode($item['image']) ?>" alt="<?= htmlspecialchars($item['name_product']) ?>" width="82" height="82" class="rounded" style="object-fit:cover">
                <div class="flex-grow-1"><h2 class="h6 mb-1"><?= htmlspecialchars($item['name_product']) ?><?php if ($item['is_flash_sale']): ?> <span class="badge rounded-pill text-white" style="background:#e83e8c;font-size:.65rem;">⚡ Flash Sale</span><?php endif; ?></h2><div class="small text-muted">Jumlah: <?= (int) $item['quantity'] ?> · Stok tersedia: <?= (int) $item['stock'] ?></div><div class="fw-bold mt-1">Rp<?= number_format((float)$item['price'] * $item['quantity'], 0, ',', '.') ?></div></div>
                <?php $beliUrl = 'checkout.php?id_product=' . (int)$item['id_product'] . '&quantity=' . (int)$item['quantity']; ?>
                <?php if ($item['is_flash_sale']): ?>
                    <?php $beliUrl .= '&id_flash_sale=' . (int) $item['id_flash_sale']; ?>
                <?php endif; ?>
                <div class="d-flex flex-column gap-2"><a class="btn btn-dark btn-sm" href="<?= htmlspecialchars($beliUrl) ?>">Beli</a><button type="submit" form="removeForm<?= (int)$item['id_cart_item'] ?>" class="btn btn-outline-danger btn-sm w-100" onclick="return confirm('Hapus produk ini dari keranjang?')">Hapus</button></div>
            </div>
        <?php endforeach; ?>
        </div><div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span class="fw-bold">Total produk terpilih <span id="cartSelectedTotal" style="color:#d63384">Rp<?= number_format($total, 0, ',', '.') ?></span></span>
            <button type="submit" class="btn btn-dark px-4">Checkout Produk Terpilih</button>
        </div></div>
        </form>
        <?php foreach ($cartRows as $item): ?>
            <form id="removeForm<?= (int)$item['id_cart_item'] ?>" action="../../backend/action_remove_from_cart.php" method="post" class="d-none"><input type="hidden" name="id_cart_item" value="<?= (int)$item['id_cart_item'] ?>"></form>
        <?php endforeach; ?>
        <script>
            // Total di footer ngikutin produk yang dicentang doang.
            (function () {
                var boxes = document.querySelectorAll('.js-cart-select');
                var totalEl = document.getElementById('cartSelectedTotal');
                function recalc() {
                    var sum = 0;
                    boxes.forEach(function (b) { if (b.checked) sum += parseFloat(b.dataset.subtotal || '0'); });
                    totalEl.textContent = 'Rp' + Math.round(sum).toLocaleString('id-ID');
                }
                boxes.forEach(function (b) { b.addEventListener('change', recalc); });
                recalc();

                document.getElementById('cartCheckoutForm').addEventListener('submit', function (e) {
                    var anyChecked = Array.prototype.some.call(boxes, function (b) { return b.checked; });
                    if (!anyChecked) {
                        e.preventDefault();
                        alert('Centang minimal 1 produk dulu ya.');
                    }
                });
            })();
        </script>
    <?php endif; ?>
</main></body></html>
