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
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>

                        <button type="submit" class="btn btn-pink-add">Submit</button>
                        <a href="tabel_produk.php" class="btn btn-secondary">Batal</a>
                    </form> 
                    <!-- TAG PENUTUP FORM HARUS DI SINI -->
                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>