<?php
session_start();
require "../../backend/connection.php"; // Sesuaikan jalur koneksi

// 1. Cek apakah parameter id_order ada di URL
if (!isset($_GET['id_order']) || empty($_GET['id_order'])) {
    die("Akses ditolak: ID Order tidak ditemukan di URL.");
}

$id_order = $_GET['id_order'];

// 2. Query ke database
$query = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_order = '$id_order'");
$order = mysqli_fetch_assoc($query);

if (!$order) {
    die("Pesanan tidak ditemukan di database.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
</head>
<body>

<section class="py-5">
    <div class="container">
        <h3>Pembayaran Pesanan</h3>
        <p>Kode Pesanan: <strong><?= htmlspecialchars($order['order_code']) ?></strong></p>
        <p>Total Bayar: <strong>Rp<?= number_format((float)$order['total_price'], 0, ',', '.') ?></strong></p>

      <form action="../../backend/action_insert_payment.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_order" value="<?= $order['id_order'] ?>">

            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-select" required>
                    <option value="Transfer Bank">Transfer Bank</option>
                    <option value="QRIS">QRIS</option>
                    <option value="COD">COD</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Bukti Pembayaran</label>
                <input type="file" name="proof_image" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-dark">Konfirmasi Pembayaran</button>
        </form>
    </div>
</section>

</body>
</html>