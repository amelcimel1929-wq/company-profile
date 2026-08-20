<?php
session_start();
require "../../backend/connection.php";

$idOrder = isset($_GET['order']) ? (int) $_GET['order'] : 0;
if ($idOrder <= 0 || !isset($_SESSION['id_user'])) {
    header('Location: produk.php');
    exit;
}
$idUser = (int) $_SESSION['id_user'];
$orderStmt = mysqli_prepare($koneksi, "SELECT o.*, p.payment_method, p.payment_status, p.payment_date, p.proof_image FROM orders o LEFT JOIN payments p ON p.id_order = o.id_order WHERE o.id_order = ? AND o.id_user = ?");
mysqli_stmt_bind_param($orderStmt, 'ii', $idOrder, $idUser);
mysqli_stmt_execute($orderStmt);
$order = mysqli_fetch_assoc(mysqli_stmt_get_result($orderStmt));
mysqli_stmt_close($orderStmt);
if (!$order) {
    http_response_code(403);
    exit('Pesanan tidak ditemukan atau bukan milik Anda.');
}

$detailStmt = mysqli_prepare($koneksi, "SELECT d.quantity, d.price, d.subtotal, p.name_product FROM order_details d JOIN products p ON p.id_product = d.id_product WHERE d.id_order = ?");
mysqli_stmt_bind_param($detailStmt, 'i', $idOrder);
mysqli_stmt_execute($detailStmt);
$details = mysqli_stmt_get_result($detailStmt);

$statusClass = str_contains(strtolower($order['status']), 'verifikasi') || str_contains(strtolower($order['status']), 'menunggu') ? 'warning' : 'success';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pesanan <?= htmlspecialchars($order['order_code']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5" style="max-width: 780px;">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-lg-5">
            <div class="text-center mb-4">
                <div class="text-success fs-1">✓</div>
                <h1 class="h3">Bukti pembayaran sudah dikirim</h1>
                <p class="text-muted mb-0">Simpan halaman ini sebagai struk dan cek perkembangan pesananmu di sini.</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6"><div class="border rounded p-3 h-100"><small class="text-muted d-block">Kode pesanan</small><strong><?= htmlspecialchars($order['order_code']) ?></strong></div></div>
                <div class="col-md-6"><div class="border rounded p-3 h-100"><small class="text-muted d-block">Status pesanan</small><span class="badge text-bg-<?= $statusClass ?>"><?= htmlspecialchars($order['status']) ?></span></div></div>
                <div class="col-md-6"><div class="border rounded p-3 h-100"><small class="text-muted d-block">Metode pembayaran</small><strong><?= htmlspecialchars($order['payment_method'] ?: 'QRIS') ?></strong></div></div>
                <div class="col-md-6"><div class="border rounded p-3 h-100"><small class="text-muted d-block">Status pembayaran</small><strong><?= htmlspecialchars($order['payment_status'] ?: 'Menunggu Verifikasi') ?></strong></div></div>
            </div>

            <?php if (!empty($order['proof_image'])): ?>
                <div class="mb-4 text-center">
                    <p class="fw-semibold mb-2">Foto bukti pembayaran</p>
                    <a href="../../backend/bukti_bayar/<?= rawurlencode($order['proof_image']) ?>" target="_blank">
                        <img src="../../backend/bukti_bayar/<?= rawurlencode($order['proof_image']) ?>" class="img-fluid rounded border" style="max-height: 360px;" alt="Bukti pembayaran">
                    </a>
                </div>
            <?php endif; ?>

            <h2 class="h5 border-bottom pb-2">Rincian pesanan</h2>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead><tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th class="text-end">Subtotal</th></tr></thead>
                    <tbody>
                    <?php while ($item = mysqli_fetch_assoc($details)): ?>
                        <tr><td><?= htmlspecialchars($item['name_product']) ?></td><td><?= (int) $item['quantity'] ?></td><td>Rp<?= number_format((float) $item['price'], 0, ',', '.') ?></td><td class="text-end">Rp<?= number_format((float) $item['subtotal'], 0, ',', '.') ?></td></tr>
                    <?php endwhile; ?>
                    </tbody>
                    <tfoot><tr><th colspan="3" class="text-end">Total</th><th class="text-end">Rp<?= number_format((float) $order['total_price'], 0, ',', '.') ?></th></tr></tfoot>
                </table>
            </div>
            <div class="d-flex flex-wrap gap-2 justify-content-center mt-4">
                <a class="btn btn-dark" href="terima_kasih.php?order=<?= (int) $order['id_order'] ?>">Muat Ulang Status</a>
                <a class="btn btn-outline-dark" href="status_pesanan.php">Semua Pesanan</a>
                <a class="btn btn-outline-dark" href="produk.php">Belanja Lagi</a>
                <button class="btn btn-outline-secondary" onclick="window.print()">Cetak Struk</button>
            </div>
        </div>
    </div>
</main>
</body>
</html>
<?php mysqli_stmt_close($detailStmt); ?>
