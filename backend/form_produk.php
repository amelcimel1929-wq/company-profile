<?php 
include "connection.php";
$categories = mysqli_query($koneksi, "SELECT * FROM categories");
?>
<?php include "components/header.php"; ?>
<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">
    <div id="wrapper">
        <?php include "components/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "components/topbar.php"; ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Tambah Produk</h1>
                    </div>

                    <!-- FORMS HARUS MEMBUNGKUS SELURUH INPUT & BUTTON -->
                    <form action="action_insert_produk.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="id_category" class="form-label">Kategori</label>
                            <select class="form-control" id="id_category" name="id_category" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php while($cat = mysqli_fetch_object($categories)): ?>
                                    <option value="<?php echo $cat->id_category; ?>"><?php echo $cat->name_kategori; ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name_product" name="name_product" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Foto (min 1, maks 5)</label>
                            <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple required>
                            <div class="form-text">Pilih 1 sampai 5 foto sekaligus (Ctrl/Cmd+klik buat pilih banyak). Foto pertama jadi foto utama.</div>
                            <div id="images-warning" class="text-danger small mt-1" style="display:none;">Maksimal 5 foto ya, kamu pilih <span id="images-count"></span>.</div>
                        </div>

                        <button type="submit" class="btn btn-pink-add">Submit</button>
                        <a href="tabel_produk.php" class="btn btn-secondary">Batal</a>
                    </form>
                    <!-- Validasi jumlah foto di sisi browser -- cuma buat UX cepat,
                         validasi yang beneran/wajib tetap di action_insert_produk.php -->
                    <script>
                        document.getElementById('images').addEventListener('change', function () {
                            var warning = document.getElementById('images-warning');
                            var countSpan = document.getElementById('images-count');
                            if (this.files.length > 5) {
                                countSpan.textContent = this.files.length;
                                warning.style.display = 'block';
                            } else {
                                warning.style.display = 'none';
                            }
                        });
                    </script>
                    <!-- TAG PENUTUP FORM HARUS DI SINI -->
                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>