<?php
include "connection.php";

$id_category = isset($_GET['id_category']) ? $_GET['id_category'] : '';

if ($id_category != '') {
    $query = "SELECT products.*, categories.name_kategori 
              FROM products 
              JOIN categories ON products.id_category = categories.id_category 
              WHERE products.id_category = '$id_category' 
              ORDER BY products.id_product DESC";
} else {
    $query = "SELECT products.*, categories.name_kategori 
              FROM products 
              JOIN categories ON products.id_category = categories.id_category 
              ORDER BY products.id_product DESC";
}

$select_products = mysqli_query($koneksi, $query);
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Produk</h1>
                    </div>

                    <!-- Filter Kategori (Kemeja / Dress) -->
                    <div class="mb-3 d-flex gap-2 align-items-center">
                        <a href="tabel_produk.php" class="btn btn-outline-secondary btn-sm <?php echo $id_category == '' ? 'active' : ''; ?>">Semua</a>
                        <?php 
                        $categories_btn = mysqli_query($koneksi, "SELECT * FROM categories");
                        while($cat = mysqli_fetch_object($categories_btn)): 
                        ?>
                            <a href="tabel_produk.php?id_category=<?php echo $cat->id_category; ?>" 
                               class="btn btn-outline-danger btn-sm <?php echo $id_category == $cat->id_category ? 'active' : ''; ?>">
                                <?php echo $cat->name_kategori; ?>
                            </a>
                        <?php endwhile; ?>
                    </div>

                    <a href="form_produk.php" class="btn btn-pink-add mb-3">
                        <i class="fas fa-plus fa-sm"></i> Add Produk
                    </a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th>Nama Product</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Image</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($tampil = mysqli_fetch_object($select_products)) : ?>
                                    <tr>
                                        <td><?php echo $tampil->name_product; ?></td>
                                        <td><span class="badge badge-info"><?php echo $tampil->name_kategori; ?></span></td>
                                        <td><?php echo $tampil->description; ?></td>
                                        <td>Rp <?php echo number_format($tampil->price, 0, ',', '.'); ?></td>
                                        <td><?php echo $tampil->stock; ?></td>
    <td>
    <img src="foto/<?php echo $tampil->image; ?>" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px;">
</td>
                                        <td>
                                            <a href="delete_produk.php?id_product=<?php echo $tampil->id_product; ?>" class="btn btn-pink-delete" onclick="return confirm('Confirm to delete?')">
                                                DELETE <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="update_form_produk.php?id_product=<?php echo $tampil->id_product; ?>" class="btn btn-pink-update">
                                                UPDATE <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>