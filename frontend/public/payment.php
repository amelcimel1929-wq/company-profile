<?php
session_start();
require "../../backend/connection.php";

$idOrder = isset($_GET['id_order']) ? (int) $_GET['id_order'] : 0;
if ($idOrder <= 0 || !isset($_SESSION['id_user'])) {
    header('Location: produk.php');
    exit;
}
$idUser = (int) $_SESSION['id_user'];
$stmt = mysqli_prepare($koneksi, 'SELECT id_order, order_code, total_price, status FROM orders WHERE id_order = ? AND id_user = ?');
mysqli_stmt_bind_param($stmt, 'ii', $idOrder, $idUser);
mysqli_stmt_execute($stmt);
$order = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);
if (!$order) {
    http_response_code(403);
    exit('Pesanan tidak ditemukan atau bukan milik Anda.');
}
$qrisPath = '../../backend/foto/qris.jpeg';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran QRIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<main class="container py-5" style="max-width: 620px;">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-lg-5 text-center">
            <p class="text-uppercase small text-muted mb-2">Pembayaran</p>
            <h1 class="h3 mb-4">Bayar dengan QRIS</h1>
            <div class="text-start bg-light rounded p-3 mb-4">
                <div class="d-flex justify-content-between"><span>Kode pesanan</span><strong><?= htmlspecialchars($order['order_code']) ?></strong></div>
                <div class="d-flex justify-content-between mt-2"><span>Total bayar</span><strong>Rp<?= number_format((float) $order['total_price'], 0, ',', '.') ?></strong></div>
            </div>

            <?php if (file_exists(__DIR__ . '/../../backend/foto/qris.jpeg')): ?>
                <img src="<?= $qrisPath ?>" alt="Kode QRIS toko" class="img-fluid rounded border p-2 mb-3" style="max-width: 300px;">
                <p class="text-muted small">Scan QRIS sesuai nominal di atas, lalu unggah foto bukti pembayaran.</p>
            <?php else: ?>
                <div class="alert alert-warning text-start">File QRIS belum tersedia. Tambahkan gambar QRIS toko dengan nama <code>backend/foto/qris.jpeg</code> sebelum menerima pembayaran.</div>
            <?php endif; ?>

            <form action="../../backend/action_insert_payment.php" method="post" enctype="multipart/form-data" class="text-start mt-4">
                <input type="hidden" name="id_order" value="<?= (int) $order['id_order'] ?>">
                <div class="mb-3">
                    <label for="proof_image" class="form-label">Foto bukti pembayaran</label>
                    <input id="proof_image" type="file" name="proof_image" class="form-control" accept="image/jpeg,image/png,image/webp" required>
                    <div class="form-text">JPG, PNG, atau WEBP, maksimal 5 MB.</div>
                </div>
                <button type="submit" class="btn btn-dark w-100">Kirim Bukti Pembayaran</button>
            </form>
        </div>
    </div>
</main>
</body>
</html>
