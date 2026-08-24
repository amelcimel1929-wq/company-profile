<?php
include "connection.php";

// 1. SETTING PAGINATION (7 DATA PER HALAMAN)
$limit = 7; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$start = ($page - 1) * $limit;

// 2. FILTER KATEGORI
$id_category = isset($_GET['id_category']) ? $_GET['id_category'] : '';

$where_sql = "";
if ($id_category != '') {
    $where_sql = "WHERE products.id_category = '$id_category'";
}

// 3. HITUNG TOTAL DATA UNTUK PAGINATION
$query_count = "SELECT COUNT(*) as total FROM products $where_sql";
$count_result = mysqli_query($koneksi, $query_count);
$total_data = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_data / $limit);

// 4. QUERY DATA PRODUK DENGAN LIMIT 7
$query = "SELECT products.*, categories.name_kategori 
          FROM products 
          JOIN categories ON products.id_category = categories.id_category 
          $where_sql
          ORDER BY products.id_product DESC 
          LIMIT $start, $limit";

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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Daftar Produk</h1>
                    </div>

                    <!-- Filter Kategori -->
                    <div class="mb-3 d-flex gap-2 align-items-center">
                        <a href="tabel_produk.php#tabel-produk" 
                           class="btn btn-outline-secondary btn-sm <?php echo $id_category == '' ? 'active' : ''; ?>">Semua</a>
                        
                        <?php 
                        $categories_btn = mysqli_query($koneksi, "SELECT * FROM categories");
                        while($cat = mysqli_fetch_object($categories_btn)): 
                        ?>
                            <a href="tabel_produk.php?id_category=<?php echo $cat->id_category; ?>#tabel-produk" 
                               class="btn btn-outline-danger btn-sm <?php echo $id_category == $cat->id_category ? 'active' : ''; ?>">
                                <?php echo $cat->name_kategori; ?>
                            </a>
                        <?php endwhile; ?>
                    </div>

                    <a href="form_produk.php" class="btn btn-pink-add mb-3">
                        <i class="fas fa-plus fa-sm"></i> Add Produk
                    </a>

                    <!-- Anchor Target (#tabel-produk) & Tabel Produk -->
                    <div id="tabel-produk" class="table-responsive">
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
                                <?php if (mysqli_num_rows($select_products) > 0): ?>
                                    <?php while ($tampil = mysqli_fetch_object($select_products)) : ?>
                                        <tr>
                                            <td class="fw-bold"><?php echo $tampil->name_product; ?></td>
                                            <td><span class="badge badge-info"><?php echo $tampil->name_kategori; ?></span></td>
                                            <td><?php echo $tampil->description; ?></td>
                                            <td>Rp <?php echo number_format($tampil->price, 0, ',', '.'); ?></td>
                                            <td><?php echo $tampil->stock; ?></td>
                                            <td>
                                                <img src="foto/<?php echo $tampil->image; ?>" alt="" style="width: 70px; height: 70px; object-fit: cover; border-radius: 6px;">
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
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-3 text-muted">Tidak ada data produk.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Footer Pagination & Keterangan Jumlah Data -->
                    <?php if ($total_data > 0): ?>
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                            <?php 
                            $from_data = $start + 1;
                            $to_data = min($start + $limit, $total_data);
                            ?>
                            <div class="small text-muted">
                                Menampilkan <?php echo $from_data; ?>–<?php echo $to_data; ?> dari <?php echo $total_data; ?> produk
                            </div>

                            <!-- Navigasi Halaman -->
                            <?php if ($total_pages > 1): ?>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm mb-0">
                                        <!-- Tombol Prev -->
                                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $page - 1; ?>&id_category=<?php echo $id_category; ?>#tabel-produk">&lt;</a>
                                        </li>

                                        <!-- Halaman Angka -->
                                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                            <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                                <a class="page-link" href="?page=<?php echo $i; ?>&id_category=<?php echo $id_category; ?>#tabel-produk"><?php echo $i; ?></a>
                                            </li>
                                        <?php endfor; ?>

                                        <!-- Tombol Next -->
                                        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $page + 1; ?>&id_category=<?php echo $id_category; ?>#tabel-produk">&gt;</a>
                                        </li>
                                    </ul>
                                </nav>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>