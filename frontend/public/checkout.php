<?php
session_start();
require "../../backend/connection.php";

// 1. Validasi parameter id_product
if (!isset($_GET['id_product']) || empty($_GET['id_product'])) {
    die("Produk tidak ditemukan.");
}

$id_product = $_GET['id_product'];

// 2. Gunakan Prepared Statement untuk keamanan SQL Injection
$stmt = mysqli_prepare($koneksi, "SELECT * FROM products WHERE id_product = ?");
mysqli_stmt_bind_param($stmt, "s", $id_product); // gunakan "i" jika id_product bertipe INT/Angka
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    die("Produk tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout - <?= htmlspecialchars($produk['name_product']) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="../../foto/<?= htmlspecialchars($produk['image']) ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($produk['name_product']) ?>">
            </div>
            <div class="col-md-7">
                <h3><?= htmlspecialchars($produk['name_product']) ?></h3>
                <p class="text-muted"><?= htmlspecialchars($produk['description']) ?></p>
                <h4 class="text-primary">Rp<?= number_format((float)$produk['price'], 0, ',', '.') ?></h4>

                <!-- PATH ACTION DISESUAIKAN DENGAN STRUKTUR "../../backend/" -->
                <form action="../../backend/action_insert_order.php" method="POST">
                    <input type="hidden" name="id_product" value="<?= htmlspecialchars($produk['id_product']) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($produk['price']) ?>">

                    <div class="mb-3">
                        <label class="form-label">Ukuran</label>
                        <select name="size" class="form-select" required>
                            <option value="">-- Pilih Ukuran --</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="quantity" class="form-control"
                               value="1" min="1" max="<?= (int)$produk['stock'] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-dark btn-lg">Lanjut ke Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>