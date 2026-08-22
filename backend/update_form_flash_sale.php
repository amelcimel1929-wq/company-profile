<?php

include "connection.php";

// menerima id flash sale dari tombol update di tabel_flash_sale.php
$id_flash_sale = $_GET['id_flash_sale'];

// menampilkan data flash sale berdasarkan id
$select_id = mysqli_query($koneksi, "SELECT * FROM flash_sale WHERE id_flash_sale='$id_flash_sale'");
$flash_sale = mysqli_fetch_object($select_id);

// Daftar produk untuk dropdown (flash sale menempel ke produk asli).
$select_produk = mysqli_query($koneksi, "SELECT id_product, name_product, price, stock FROM products ORDER BY name_product ASC");

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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Flash Sale</h1>
                    </div>

                    <?php if (empty($flash_sale->id_product)): ?>
                        <div class="alert alert-warning">
                            Flash sale ini belum terhubung ke produk, jadi tombol <strong>Pesan Sekarang</strong> di halaman depan belum muncul.
                            Pilih produknya di bawah lalu simpan.
                        </div>
                    <?php endif; ?>

                    <form action="action_update_flash_sale.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_flash_sale" value="<?php echo $flash_sale->id_flash_sale; ?>">
                        <div class="mb-3">
                            <label for="id_product" class="form-label">Produk</label>
                            <select class="form-control" id="id_product" name="id_product" required>
                                <option value="">-- Pilih produk --</option>
                                <?php while ($p = mysqli_fetch_object($select_produk)) : ?>
                                    <option value="<?php echo $p->id_product; ?>"
                                            data-harga="<?php echo $p->price; ?>"
                                            <?php echo ((int) $flash_sale->id_product === (int) $p->id_product) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($p->name_product); ?> — Rp <?php echo number_format($p->price, 0, ',', '.'); ?> (stok <?php echo (int) $p->stock; ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <small class="form-text text-muted">Nama produk dan harga awal diambil otomatis dari produk yang dipilih.</small>
                        </div>
                        <div class="mb-3">
                            <label for="harga_awal_preview" class="form-label">Harga Awal</label>
                            <input type="text" class="form-control" id="harga_awal_preview" value="<?php echo $flash_sale->harga_awal; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Produk</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo htmlspecialchars($flash_sale->jenis); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga_akhir" class="form-label">Harga Akhir (harga flash sale)</label>
                            <input type="number" min="0" step="1" class="form-control" id="harga_akhir" name="harga_akhir" value="<?php echo $flash_sale->harga_akhir; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label><br>
                            <img src="foto/<?php echo $flash_sale->foto; ?>" width="150"><br><br>
                            <label for="img" class="form-label">Ganti foto (boleh kosong)</label>
                            <input type="file" class="form-control" id="img" name="img">
                        </div>


                        <button type="submit" class="btn btn-primary">Update</button>
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
