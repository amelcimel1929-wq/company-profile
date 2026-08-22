<?php
session_start();
require "../../backend/connection.php";

// Halaman ini hanya untuk user yang sudah login.
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
$idUser = (int) $_SESSION['id_user'];

// Status bayar ada di tabel payments, jadi harus di-join.
// LEFT JOIN supaya pesanan yang belum pernah bayar tetap muncul.
$stmt = mysqli_prepare($koneksi, "SELECT o.*, p.payment_status, p.proof_image
                                  FROM orders o
                                  LEFT JOIN payments p ON p.id_order = o.id_order
                                  WHERE o.id_user = ?
                                  ORDER BY o.id_order DESC");
mysqli_stmt_bind_param($stmt, 'i', $idUser);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Status Pesanan Saya - preloved bymeii ♡</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            /* Latar belakang bungga.jpeg pudar (overlay 0.75) */
            background: linear-gradient(rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0.75)), 
                        url('../../backend/foto/cinta.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #4a4a4a;
        }

        .brand-header {
            font-family: 'Playfair Display', serif;
            font-size: 2.3rem;
            font-weight: 600;
            color: #4a2e35;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.8);
        }
        
        .brand-pink {
            color: #d63384;
        }

        .card-status {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .btn-soft-pink {
            background-color: #f8c8dc;
            color: #5c2c3b;
            font-weight: 600;
            border: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .btn-soft-pink:hover {
            background-color: #f3b0cb;
            color: #3d1a25;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(248, 200, 220, 0.6);
        }

        .btn-outline-pink {
            border: 1px solid #d63384;
            color: #d63384;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-outline-pink:hover {
            background-color: #d63384;
            color: #ffffff;
        }

        .btn-secondary-custom {
            background-color: #e9ecef;
            color: #495057;
            border: 1px solid #ced4da;
            border-radius: 12px;
            font-weight: 500;
        }

        .btn-secondary-custom:hover {
            background-color: #dee2e6;
            color: #212529;
        }

        .table {
            color: #4a4a4a;
            vertical-align: middle;
        }

        .table thead th {
            border-bottom: 2px solid #f8c8dc;
            color: #5c2c3b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.82rem;
            letter-spacing: 0.5px;
        }

        .badge-status {
            border-radius: 20px;
            padding: 6px 14px;
            font-weight: 500;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>

<main class="container py-4">
    <!-- Header Brand -->
    <div class="text-center mb-3">
        <h1 class="brand-header">preloved by<span class="brand-pink">meii</span> ♡</h1>
    </div>

    <div class="mx-auto" style="max-width: 900px;">
        <div class="card card-status border-0 p-3 p-md-4 mt-2">
            
            <!-- Baris Judul & Tombol Navigasi (Kembali & Belanja) -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 pb-3 border-bottom">
                <div>
                    <h2 class="h4 fw-bold mb-1" style="color: #2c2c2c;">Status Pesanan Saya</h2>
                    <p class="text-muted small mb-0">Pilih pesanan untuk melihat struk dan status terbarunya.</p>
                </div>
                <!-- Tombol Kembali & Belanja -->
                <div class="d-flex gap-2">
                    <a href="javascript:history.back()" class="btn btn-secondary-custom px-3 py-2 shadow-sm">
                        &larr; Kembali
                    </a>
                    <a href="produk.php" class="btn btn-outline-pink px-3 py-2 shadow-sm">
                        Belanja
                    </a>
                </div>
            </div>

            <!-- Tabel Status Pesanan -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th class="text-center">Status Pesanan</th>
                            <th class="text-center">Status Bayar</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <?php
                                    // Dianggap lunas hanya kalau admin sudah konfirmasi di backend.
                                    $sudahLunas = strtolower((string) ($row['payment_status'] ?? '')) === 'lunas';
                                    // Belum ada bukti bayar = pembayaran belum diselesaikan.
                                    $belumBayar = empty($row['proof_image']);
                                ?>
                                <tr>
                                    <td class="fw-bold" style="color: #4a2e35;"><?= htmlspecialchars($row['order_code']) ?></td>
                                    <td class="text-muted small"><?= date('d-m-Y H:i', strtotime($row['order_date'])) ?></td>
                                    <td class="fw-semibold" style="color: #d63384;">Rp<?= number_format((float) $row['total_price'], 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary badge-status">
                                            <?= htmlspecialchars($row['status']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($sudahLunas): ?>
                                            <span class="badge bg-success badge-status">Lunas</span>
                                        <?php elseif ($belumBayar): ?>
                                            <span class="badge bg-warning text-dark badge-status">Belum Bayar</span>
                                        <?php else: ?>
                                            <span class="badge bg-info text-dark badge-status">Menunggu Verifikasi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex gap-2 justify-content-end flex-wrap">
                                            <?php if ($belumBayar): ?>
                                                <a href="payment.php?id_order=<?= (int) $row['id_order'] ?>" class="btn btn-outline-pink btn-sm px-3 shadow-sm">
                                                    Selesaikan Pembayaran
                                                </a>
                                            <?php endif; ?>
                                            <a href="terima_kasih.php?order=<?= (int) $row['id_order'] ?>" class="btn btn-soft-pink btn-sm px-3 shadow-sm">
                                                Lihat
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Belum ada pesanan untuk akun ini.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</main>

</body>
</html>