<?php
session_start();
require "../../backend/connection.php";

$idProduct = isset($_GET['id_product']) ? (int) $_GET['id_product'] : 0;
if ($idProduct <= 0) {
    header('Location: produk.php');
    exit;
}

$stmt = mysqli_prepare($koneksi, "SELECT * FROM products WHERE id_product = ?");
mysqli_stmt_bind_param($stmt, "i", $idProduct);
mysqli_stmt_execute($stmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if (!$product) {
    exit('Produk tidak ditemukan.');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan - <?= htmlspecialchars($product['name_product']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            /* Latar belakang bungga.jpeg pudar */
            background: linear-gradient(rgba(255, 255, 255, 0.75), rgba(255, 255, 255, 0.75)), 
                        url('../../backend/foto/bungga.jpeg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: #4a4a4a;
        }

        /* Header preloved bymeii ♡ */
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

        /* Card Soft Glassmorphism */
        .card-checkout {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Tombol Soft Pink */
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

        .back-link {
            color: #4a4a4a;
            font-size: 0.9rem;
            font-weight: 500;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 8px 18px;
            border-radius: 20px;
            display: inline-block;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .back-link:hover {
            background-color: #ffffff;
            color: #d63384;
        }

        .product-img {
            border-radius: 18px;
            object-fit: cover;
            max-height: 420px;
        }
    </style>
</head>
<body>

<main class="container py-4">
    <!-- Header Brand -->
    <div class="text-center mb-3">
        <h1 class="brand-header">preloved by<span class="brand-pink">meii</span> ♡</h1>
    </div>

    <div class="mx-auto" style="max-width: 820px;">
        <!-- Link Kembali Langsung ke Halaman Sebelumnya -->
        <a href="javascript:history.back()" class="text-decoration-none back-link mb-3 shadow-sm">&larr; Kembali</a>
        
        <!-- Card Utama -->
        <div class="card card-checkout border-0 p-3 p-md-4 mt-2">
            <div class="row g-4 align-items-center">
                
                <!-- Gambar Produk -->
                <div class="col-md-6 text-center">
                    <img src="../../backend/foto/<?= rawurlencode($product['image']) ?>" 
                         class="w-100 product-img shadow-sm" 
                         alt="<?= htmlspecialchars($product['name_product']) ?>">
                </div>

                <!-- Detail Produk & Form -->
                <div class="col-md-6">
                    <span class="badge rounded-pill bg-white text-muted border px-3 py-2 text-uppercase fw-semibold mb-2" style="font-size: 0.75rem; letter-spacing: 1px;">Detail Pesanan</span>
                    
                    <h2 class="h3 fw-bold mb-1" style="color: #2c2c2c;"><?= htmlspecialchars($product['name_product']) ?></h2>
                    <p class="text-muted small mb-3"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                    
                    <div class="mb-3">
                        <span class="fs-3 fw-bold" style="color: #d63384;">Rp<?= number_format((float) $product['price'], 0, ',', '.') ?></span>
                        <span class="small text-muted d-block">Stok tersedia: <?= (int) $product['stock'] ?> pcs</span>
                    </div>

                    <?php if ((int) $product['stock'] > 0): ?>
                        <!-- Form mengarah langsung ke payment.php -->
                        <form action="payment.php" method="get" class="mt-4">
                            <!-- Mengirim id_order sesuai ID produk -->
                            <input type="hidden" name="id_order" value="<?= (int) $product['id_product'] ?>">
                            
                            <div class="mb-4" style="max-width: 140px;">
                                <label for="quantity" class="form-label small fw-semibold text-muted">Jumlah</label>
                                <input id="quantity" type="number" name="quantity" class="form-control text-center border-0 bg-white shadow-sm" value="1" min="1" max="<?= (int) $product['stock'] ?>" style="border-radius: 10px;" required>
                            </div>

                            <button type="submit" class="btn btn-soft-pink btn-lg w-100 py-2.5 shadow-sm">Lanjut ke Pembayaran</button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-secondary border-0 text-center rounded-3 mb-0">Produk ini sedang habis.</div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</main>

</body>
</html>