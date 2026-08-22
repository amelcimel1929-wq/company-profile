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

$statusClass = str_contains(strtolower($order['status']), 'verifikasi') || str_contains(strtolower($order['status']), 'menunggu') ? 'badge-warning-pink' : 'badge-success-pink';

$belumBayar = empty($order['proof_image']);
$sudahLunas = strtolower((string) $order['payment_status']) === 'lunas';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pesanan <?= htmlspecialchars($order['order_code']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fdf2f4;
            color: #5a4048;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container-compact {
            max-width: 440px;
            position: relative;
        }
        /* Tombol Kembali di Samping Kotak */
        .btn-back-side {
            position: absolute;
            left: -55px;
            top: 0;
            background-color: #ffffff;
            color: #e83e8c;
            border: 1px solid #f8d7da;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(214, 51, 132, 0.1);
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }
        .btn-back-side:hover {
            background-color: #e83e8c;
            color: #ffffff;
            transform: scale(1.05);
        }
        .card-custom {
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #f8d7da;
            box-shadow: 0 4px 12px rgba(214, 51, 132, 0.05);
        }
        .text-pink-primary {
            color: #7d5260;
        }
        .box-info-mini {
            background-color: #fff5f7;
            border: 1px solid #efe6e6;
            border-radius: 6px;
            padding: 4px 8px !important;
        }
        .badge-warning-pink {
            background-color: #ffe8cc;
            color: #d97706;
        }
        .badge-success-pink {
            background-color: #d1fae5;
            color: #059669;
        }
        .btn-pink-main {
            background-color: #e83e8c;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-pink-main:hover {
            background-color: #d63384;
            color: #ffffff;
        }
        .btn-outline-pink {
            border: 1px solid #e83e8c;
            color: #e83e8c;
            border-radius: 6px;
            font-weight: 600;
        }
        .btn-outline-pink:hover {
            background-color: #e83e8c;
            color: #ffffff;
        }
        .table-pink-theme thead {
            background-color: #fce8e6;
            color: #7d5260;
        }
        
        /* Responsif untuk Layar Kecil (HP) */
        @media (max-width: 576px) {
            .btn-back-side {
                position: static;
                width: auto;
                height: auto;
                border-radius: 6px;
                padding: 4px 12px;
                margin-bottom: 10px;
                display: inline-flex;
                font-size: 0.75rem;
            }
        }

        @media print {
            .no-print { display: none !important; }
            body { background-color: #fff; }
            .card-custom { border: none; box-shadow: none; }
        }
    </style>
</head>
<body>
<main class="container container-compact py-3">

    <!-- Tombol Kembali di Samping Luar Kotak -->
    <a href="status_pesanan.php" class="btn-back-side no-print" title="Kembali">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="card card-custom">
        <div class="card-body p-3">
            
            <?php if ($belumBayar): ?>
                <div class="text-center mb-2">
                    <div class="fs-3 text-warning mb-1"><i class="fas fa-exclamation-circle"></i></div>
                    <h1 class="h6 fw-bold text-pink-primary mb-1">Pembayaran Belum Diselesaikan</h1>
                    <p class="text-muted small mb-0" style="font-size: 0.75rem;">Silakan bayar via QRIS & unggah buktinya.</p>
                </div>
                <div class="alert alert-warning border-0 shadow-sm d-flex flex-wrap align-items-center justify-content-between gap-1 rounded-3 mb-2 p-2 small" style="font-size: 0.75rem;">
                    <span><i class="fas fa-clock me-1"></i> Menunggu pembayaran.</span>
                    <a class="btn btn-pink-main btn-sm px-2 py-1" style="font-size: 0.7rem;" href="payment.php?id_order=<?= (int) $order['id_order'] ?>">Selesaikan Bayar</a>
                </div>
            <?php else: ?>
                <div class="text-center mb-2">
                    <div class="fs-3 mb-1" style="color: #e83e8c;"><i class="fas fa-check-circle"></i></div>
                    <h1 class="h6 fw-bold text-pink-primary mb-1">Bukti Pembayaran Dikirim</h1>
                </div>
            <?php endif; ?>

            <!-- Foto Bukti Pembayaran -->
            <?php if (!empty($order['proof_image'])): ?>
                <div class="mb-3 text-center">
                    <span class="fw-bold text-pink-primary d-block mb-1" style="font-size: 0.8rem;">Foto Bukti Pembayaran</span>
                    <a href="../../backend/bukti_bayar/<?= rawurlencode($order['proof_image']) ?>" target="_blank">
                        <img src="../../backend/bukti_bayar/<?= rawurlencode($order['proof_image']) ?>" class="img-fluid rounded-3 border p-1 bg-white shadow-sm w-100" style="max-height: 320px; object-fit: contain;" alt="Bukti pembayaran">
                    </a>
                </div>
            <?php endif; ?>

            <!-- Kotak Ringkasan Informasi -->
            <div class="row g-1 mb-3">
                <div class="col-6">
                    <div class="box-info-mini h-100">
                        <small class="text-muted d-block" style="font-size: 0.65rem;">Kode Pesanan</small>
                        <strong class="text-pink-primary" style="font-size: 0.75rem;"><?= htmlspecialchars($order['order_code']) ?></strong>
                    </div>
                </div>
                <div class="col-6">
                    <div class="box-info-mini h-100">
                        <small class="text-muted d-block" style="font-size: 0.65rem;">Status Pesanan</small>
                        <span class="badge px-1 py-0 <?= $statusClass ?>" style="font-size: 0.65rem;"><?= htmlspecialchars($order['status']) ?></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="box-info-mini h-100">
                        <small class="text-muted d-block" style="font-size: 0.65rem;">No. Telepon</small>
                        <strong style="font-size: 0.75rem;"><?= htmlspecialchars($order['no_telepon'] ?: '-') ?></strong>
                    </div>
                </div>
                <div class="col-6">
                    <div class="box-info-mini h-100">
                        <small class="text-muted d-block" style="font-size: 0.65rem;">Metode Bayar</small>
                        <strong style="font-size: 0.75rem;"><?= htmlspecialchars($order['payment_method'] ?: 'QRIS') ?></strong>
                    </div>
                </div>
                <div class="col-12">
                    <div class="box-info-mini">
                        <small class="text-muted d-block" style="font-size: 0.65rem;">Status Pembayaran</small>
                        <strong style="font-size: 0.75rem;"><?= $sudahLunas ? 'Lunas' : ($belumBayar ? 'Belum Bayar' : 'Menunggu Verifikasi') ?></strong>
                    </div>
                </div>
            </div>

            <h2 class="fw-bold text-pink-primary border-bottom pb-1 mb-2" style="font-size: 0.8rem;">Rincian Pesanan</h2>
            <div class="table-responsive mb-3">
                <table class="table table-sm align-middle table-pink-theme mb-0" style="font-size: 0.72rem;">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Qty</th>
                            <th>Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($item = mysqli_fetch_assoc($details)): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($item['name_product']) ?></strong></td>
                            <td class="text-center"><?= (int) $item['quantity'] ?></td>
                            <td>Rp<?= number_format((float) $item['price'], 0, ',', '.') ?></td>
                            <td class="text-end fw-semibold">Rp<?= number_format((float) $item['subtotal'], 0, ',', '.') ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end text-pink-primary">Total</th>
                            <th class="text-end text-pink-primary fw-bold">Rp<?= number_format((float) $order['total_price'], 0, ',', '.') ?></th>
                        </tr>
                    </tfoot>
                </table
            </div>

            <!-- Tombol Aksi -->
            <div class="d-flex flex-wrap gap-1 justify-content-center mt-2 no-print">
                <?php if ($belumBayar): ?>
                    <a class="btn btn-pink-main btn-sm py-1 px-2" style="font-size: 0.72rem;" href="payment.php?id_order=<?= (int) $order['id_order'] ?>">Bayar</a>
                <?php endif; ?>
                <a class="btn btn-outline-pink btn-sm py-1 px-2" style="font-size: 0.72rem;" href="terima_kasih.php?order=<?= (int) $order['id_order'] ?>"><i class="fas fa-sync-alt me-1"></i> Muat Ulang</a>
                <a class="btn btn-outline-pink btn-sm py-1 px-2" style="font-size: 0.72rem;" href="status_pesanan.php">Semua Pesanan</a>
                <a class="btn btn-outline-pink btn-sm py-1 px-2" style="font-size: 0.72rem;" href="produk.php">Belanja Lagi</a>
                <button class="btn btn-secondary btn-sm py-1 px-2" style="font-size: 0.72rem;" onclick="window.print()"><i class="fas fa-print me-1"></i> Cetak</button>
            </div>

        </div>
    </div>
</main>
</body>
</html>
<?php mysqli_stmt_close($detailStmt); ?>