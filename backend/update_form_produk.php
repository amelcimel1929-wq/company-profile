<?php
include "connection.php";

// Proteksi jika id_product tidak dikirim via URL
if (!isset($_GET['id_product']) || empty($_GET['id_product'])) {
    header("Location: tabel_produk.php");
    exit();
}

$id_product = $_GET['id_product'];
$get_data   = mysqli_query($koneksi, "SELECT * FROM products WHERE id_product = '$id_product'");
$data       = mysqli_fetch_object($get_data);

// Proteksi jika data ID tidak ada di database
if (!$data) {
    header("Location: tabel_produk.php");
    exit();
}

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
                            <label for="image" class="form-label">Foto Produk (Biarkan kosong jika tidak diganti)</label><br>
                            <?php if (!empty($data->image)): ?>
                                <img src="foto/<?php echo $data->image; ?>" style="width: 100px; height: 100px; object-fit: cover; border-radius: 6px;" class="mb-2"><br>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="image" name="image">
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