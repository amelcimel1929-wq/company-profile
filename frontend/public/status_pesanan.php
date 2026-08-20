<?php
session_start();
require "../../backend/connection.php";

if (!isset($_SESSION['id_user'])) {
    header('Location: produk.php');
    exit;
}
$idUser = (int) $_SESSION['id_user'];
$stmt = mysqli_prepare($koneksi, "SELECT o.id_order, o.order_code, o.order_date, o.total_price, o.status, p.payment_status FROM orders o LEFT JOIN payments p ON p.id_order = o.id_order WHERE o.id_user = ? ORDER BY o.id_order DESC");
mysqli_stmt_bind_param($stmt, 'i', $idUser);
mysqli_stmt_execute($stmt);
$orders = mysqli_stmt_get_result($stmt);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pesanan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5" style="max-width: 960px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div><h1 class="h3 mb-1">Status Pesanan Saya</h1><p class="text-muted mb-0">Pilih pesanan untuk melihat struk dan status terbarunya.</p></div>
        <a class="btn btn-outline-dark" href="produk.php">Belanja</a>
    </div>
    <div class="card border-0 shadow-sm"><div class="table-responsive"><table class="table table-hover align-middle mb-0">
        <thead><tr><th>Kode</th><th>Tanggal</th><th>Total</th><th>Status Pesanan</th><th>Status Bayar</th><th></th></tr></thead>
        <tbody>
        <?php if (mysqli_num_rows($orders) === 0): ?><tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pesanan.</td></tr><?php endif; ?>
        <?php while ($order = mysqli_fetch_assoc($orders)): ?>
            <tr>
                <td><strong><?= htmlspecialchars($order['order_code']) ?></strong></td>
                <td><?= date('d-m-Y H:i', strtotime($order['order_date'])) ?></td>
                <td>Rp<?= number_format((float) $order['total_price'], 0, ',', '.') ?></td>
                <td><span class="badge text-bg-secondary"><?= htmlspecialchars($order['status']) ?></span></td>
                <td><?= htmlspecialchars($order['payment_status'] ?: 'Belum Bayar') ?></td>
                <td><a class="btn btn-sm btn-dark" href="terima_kasih.php?order=<?= (int) $order['id_order'] ?>">Lihat</a></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table></div></div>
</main>
</body>
</html>
<?php mysqli_stmt_close($stmt); ?>
