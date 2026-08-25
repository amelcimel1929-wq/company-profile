<?php
include "connection.php";
include "product_image_helper.php";

// Proteksi jika id_product tidak dikirim via URL
if (!isset($_GET['id_product']) || empty($_GET['id_product'])) {
    header("Location: tabel_produk.php");
    exit();
}

$id_product = (int) $_GET['id_product'];
$get_data   = mysqli_query($koneksi, "SELECT * FROM products WHERE id_product = '$id_product'");
$data       = mysqli_fetch_object($get_data);

// Proteksi jika data ID tidak ada di database
if (!$data) {
    header("Location: tabel_produk.php");
    exit();
}

// Produk lama (dibuat sebelum fitur galeri ini ada) belum punya baris di
// product_images sama sekali -- migrasi on-the-fly sekali aja pas dibuka
// halaman edit-nya, biar mulai sekarang semua produk konsisten punya
// minimal 1 baris galeri (products.image jadi foto pertamanya).
$count_gallery = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM product_images WHERE id_product = $id_product"))['total'];
if ($count_gallery == 0 && !empty($data->image)) {
    $image_aman = mysqli_real_escape_string($koneksi, $data->image);
    mysqli_query($koneksi, "INSERT INTO product_images (id_product, image, sort_order) VALUES ($id_product, '$image_aman', 0)");
}

$gallery = mysqli_query($koneksi, "SELECT * FROM product_images WHERE id_product = $id_product ORDER BY sort_order ASC, id_image ASC");
$gallery_rows = mysqli_fetch_all($gallery, MYSQLI_ASSOC);
$gallery_count = count($gallery_rows);
$slot_sisa = PRODUCT_IMAGE_MAX - $gallery_count;

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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Edit Produk</h1>
                    </div>

                    <form action="action_update_produk.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_product" value="<?php echo $data->id_product; ?>">

                        <div class="mb-3">
                            <label for="id_category" class="form-label">Kategori</label>
                            <select class="form-control" id="id_category" name="id_category" required>
                                <?php while($cat = mysqli_fetch_object($categories)): ?>
                                    <option value="<?php echo $cat->id_category; ?>" <?php echo ($cat->id_category == $data->id_category) ? 'selected' : ''; ?>>
                                        <?php echo $cat->name_kategori; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name_product" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="name_product" name="name_product" value="<?php echo $data->name_product; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $data->description; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?php echo $data->price; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $data->stock; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block">Galeri Foto (<?php echo $gallery_count; ?>/<?php echo PRODUCT_IMAGE_MAX; ?>)</label>
                            <div class="d-flex flex-wrap gap-2 mb-2">
                                <?php foreach ($gallery_rows as $i => $img): ?>
                                    <div class="position-relative" style="width: 100px;">
                                        <img src="foto/<?php echo htmlspecialchars($img['image']); ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px;" class="d-block">
                                        <?php if ($i === 0): ?>
                                            <span class="badge bg-secondary position-absolute" style="top: 4px; left: 4px; font-size: 10px;">Utama</span>
                                        <?php endif; ?>
                                        <?php if ($gallery_count > PRODUCT_IMAGE_MIN): ?>
                                            <a href="action_delete_product_image.php?id_image=<?php echo $img['id_image']; ?>&id_product=<?php echo $id_product; ?>"
                                               class="btn btn-pink-delete btn-sm w-100 mt-1"
                                               onclick="return confirm('Hapus foto ini?')">Hapus</a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php if ($gallery_count <= PRODUCT_IMAGE_MIN): ?>
                                <div class="form-text text-muted">Minimal 1 foto harus tetap ada, jadi tombol Hapus disembunyikan kalau cuma tersisa 1.</div>
                            <?php endif; ?>

                            <?php if ($slot_sisa > 0): ?>
                                <label for="images" class="form-label mt-2">Tambah Foto (sisa slot: <?php echo $slot_sisa; ?>)</label>
                                <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple>
                                <div id="images-warning" class="text-danger small mt-1" style="display:none;"></div>
                                <script>
                                    document.getElementById('images').addEventListener('change', function () {
                                        var warning = document.getElementById('images-warning');
                                        var sisa = <?php echo $slot_sisa; ?>;
                                        if (this.files.length > sisa) {
                                            warning.textContent = 'Sisa slot cuma ' + sisa + ', kamu pilih ' + this.files.length + '.';
                                            warning.style.display = 'block';
                                        } else {
                                            warning.style.display = 'none';
                                        }
                                    });
                                </script>
                            <?php else: ?>
                                <div class="form-text text-muted mt-2">Udah maksimal 5 foto -- hapus salah satu dulu kalau mau ganti.</div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-pink-update">Update</button>
                        <a href="tabel_produk.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>
