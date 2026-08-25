<?php
session_start();
require "../../backend/connection.php";

$idOrder = isset($_GET['id_order']) ? (int) $_GET['id_order'] : 0;
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
if ($idOrder <= 0) {
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
$qrisPath = '../../backend/foto/qris.jpeg?' . filemtime(__DIR__ . '/../../backend/foto/qris.jpeg');
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran QRIS - Order #<?= htmlspecialchars($order['order_code']) ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --pink-bg-light: #fff0f3;
            --pink-card-bg: #ffffff;
            --pink-accent: #ffb3c1;
            --pink-main: #ff758f;
            --pink-hover: #c9184a;
            --pink-badge-bg: #ffe5ec;
            --pink-badge-text: #a4133c;
            --text-dark: #2b2d42;
        }

        body {
            background: linear-gradient(135deg, #fff0f3 0%, #ffccd5 100%);
            min-height: 100vh;
            color: var(--text-dark);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
        }
        
        .card-custom {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(255, 117, 143, 0.15);
            background-color: var(--pink-card-bg);
        }

        .qris-frame {
            background-color: #ffffff;
            border: 2px dashed var(--pink-accent);
            border-radius: 16px;
            padding: 12px;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .qris-frame:hover {
            border-color: var(--pink-main);
            box-shadow: 0 4px 15px rgba(255, 117, 143, 0.2);
        }

        .btn-pink-main {
            background-color: var(--pink-main);
            border-color: var(--pink-main);
            color: #ffffff;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-pink-main:hover, .btn-pink-main:focus {
            background-color: var(--pink-hover);
            border-color: var(--pink-hover);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(201, 24, 74, 0.3);
        }

        .btn-pink-outline {
            border: 1.5px solid var(--pink-main);
            color: var(--pink-hover);
            background-color: #ffffff;
            border-radius: 10px;
            font-weight: 500;
            padding: 8px 16px;
            transition: all 0.2s ease;
        }

        .btn-pink-outline:hover {
            background-color: var(--pink-badge-bg);
            color: var(--pink-hover);
            border-color: var(--pink-hover);
        }

        .btn-back {
            text-decoration: none;
            color: var(--pink-hover);
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .btn-back:hover {
            color: var(--pink-hover);
            text-decoration: underline;
        }

        .badge-pink {
            background-color: var(--pink-badge-bg);
            color: var(--pink-badge-text);
        }

        .order-summary-box {
            background-color: var(--pink-bg-light);
            border: 1px solid var(--pink-accent);
            border-radius: 12px;
        }

        .form-control:focus {
            border-color: var(--pink-main);
            box-shadow: 0 0 0 0.25rem rgba(255, 117, 143, 0.25);
        }
    </style>
</head>
<body>

<main class="container py-4 py-md-5" style="max-width: 580px;">

    <!-- Navigation Header (Tombol Kembali) -->
    <div class="mb-3 d-flex align-items-center">
        <a href="produk.php" class="btn-back d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-left fs-5"></i>
            <span>Kembali ke Daftar Produk</span>
        </a>
    </div>

    <!-- Main Card -->
    <div class="card card-custom">
        <div class="card-body p-4 p-sm-5 text-center">
            
            <!-- Header Section -->
            <div class="mb-4">
                <span class="badge badge-pink fw-semibold px-3 py-2 rounded-pill text-uppercase mb-2" style="letter-spacing: 0.5px;">
                    <i class="bi bi-qr-code-scan me-1"></i> Pembayaran QRIS
                </span>
                <h1 class="h3 fw-bold mb-1" style="color: var(--pink-hover);">Selesaikan Pembayaran</h1>
                <p class="text-muted small">Pindai kode QRIS di bawah ini untuk membayar pesanan Anda</p>
            </div>

            <!-- Detail Pesanan -->
            <div class="order-summary-box p-3 mb-4 text-start">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Kode Pesanan</span>
                    <span class="fw-bold font-monospace" style="color: var(--pink-hover);">#<?= htmlspecialchars($order['order_code']) ?></span>
                </div>
                <hr class="my-2" style="border-color: var(--pink-accent);">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Total Pembayaran</span>
                    <span class="fw-bold fs-5" style="color: var(--pink-hover);">Rp <?= number_format((float) $order['total_price'], 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- Tampilan QRIS Image & Tombol Unduh -->
            <div class="my-4">
                <?php if (file_exists(__DIR__ . '/../../backend/foto/qris.jpeg')): ?>
                    <div class="qris-frame shadow-sm mb-3">
                        <img src="<?= $qrisPath ?>" alt="Kode QRIS Toko" class="img-fluid rounded" style="max-width: 250px; height: auto;">
                    </div>

                    <!-- Tombol Unduh QRIS -->
                    <div class="mb-3">
                        <a href="<?= $qrisPath ?>" download="QRIS_Pembayaran_<?= htmlspecialchars($order['order_code']) ?>.jpeg" class="btn btn-pink-outline btn-sm d-inline-flex align-items-center gap-2">
                            <i class="bi bi-download"></i>
                            <span>Unduh Kode QRIS</span>
                        </a>
                    </div>

                    <p class="text-muted small px-3">
                        <i class="bi bi-info-circle me-1"></i> Scan atau unduh gambar QRIS di atas, lalu bayar sesuai nominal transaksi.
                    </p>
                <?php else: ?>
                    <div class="alert alert-warning text-start d-flex gap-2 align-items-start rounded-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0 mt-1"></i>
                        <div>
                            <strong>Gambar QRIS Tidak Ditemukan!</strong><br>
                            Silakan unggah file gambar QRIS toko ke folder <code>backend/foto/qris.jpeg</code>.
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <hr class="my-4" style="border-color: var(--pink-accent);">

            <!-- Form Upload Bukti Pembayaran -->
            <form action="../../backend/action_insert_payment.php" method="post" enctype="multipart/form-data" class="text-start">
                <input type="hidden" name="id_order" value="<?= (int) $order['id_order'] ?>">
                
                <div class="mb-4">
                    <label for="proof_image" class="form-label fw-semibold" style="color: var(--pink-hover);">
                        Foto Bukti Pembayaran <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input id="proof_image" type="file" name="proof_image" class="form-control" accept="image/jpeg,image/png,image/webp" required>
                    </div>
                    <div class="form-text mt-2 text-muted">
                        <i class="bi bi-file-earmark-image me-1"></i> JPG, PNG, atau WEBP (Maksimal 5 MB).
                    </div>
                </div>

                <button type="submit" class="btn btn-pink-main w-100 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-send-fill"></i>
                    <span>Kirim Bukti Pembayaran</span>
                </button>
            </form>

        </div>
    </div>
</main>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>