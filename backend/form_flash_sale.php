<?php
include "connection.php";

// Daftar produk untuk dropdown: flash sale sekarang menempel ke produk asli
// supaya stok dan id_product-nya bisa dipakai saat pemesanan.
$select_produk = mysqli_query($koneksi, "SELECT id_product, name_product, price, stock, image FROM products ORDER BY name_product ASC");
?>

<?php include "components/header.php" ?>

<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">
    <div id="wrapper">
        <?php include "components/sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "components/topbar.php" ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Tambah Flash Sale</h1>

                    <form action="action_insert_flash_sale.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_product" class="form-label">Produk</label>
                            <select class="form-control" id="id_product" name="id_product" required>
                                <option value="">-- Pilih produk --</option>
                                <?php while ($p = mysqli_fetch_object($select_produk)) : ?>
                                    <option value="<?php echo $p->id_product; ?>"
                                            data-nama="<?php echo htmlspecialchars($p->name_product); ?>"
                                            data-harga="<?php echo $p->price; ?>">
                                        <?php echo htmlspecialchars($p->name_product); ?> — Rp <?php echo number_format($p->price, 0, ',', '.'); ?> (stok <?php echo (int) $p->stock; ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <small class="form-text text-muted">Nama produk, harga awal, dan foto diambil otomatis dari produk yang dipilih.</small>
                        </div>
                        <div class="mb-3">
                            <label for="harga_awal_preview" class="form-label">Harga Awal</label>
                            <input type="text" class="form-control" id="harga_awal_preview" value="" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="harga_akhir" class="form-label">Harga Akhir (harga flash sale)</label>
                            <input type="number" min="0" step="1" class="form-control" id="harga_akhir" name="harga_akhir" required>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Foto (boleh kosong, ikut foto produk)</label>
                            <input type="file" class="form-control" id="img" name="img">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

            <?php include "components/footer.php" ?>
        </div>
    </div>

    <?php include "partials/bottom.php" ?>

    <script>
        // Preview harga awal mengikuti produk yang dipilih (nilai final tetap diambil di server).
        document.getElementById('id_product').addEventListener('change', function () {
            var opt = this.options[this.selectedIndex];
            document.getElementById('harga_awal_preview').value = opt.dataset.harga || '';
        });
    </script>
</body>
</html>
