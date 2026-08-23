<?php
include "connection.php";

// 1. Tangkap parameter filter tanggal & pagination
$filter_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$halaman_aktif   = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$limit           = 10;
$offset          = ($halaman_aktif - 1) * $limit;

// 2. Query dasar & filter tanggal (menggunakan kolom create_at)
$where_clause = "";
if (!empty($filter_tanggal)) {
    $where_clause = " WHERE DATE(product_reviews.create_at) = '$filter_tanggal' ";
}

// 3. Hitung total data untuk pagination
$query_total = "SELECT COUNT(*) as total FROM product_reviews $where_clause";
$res_total   = mysqli_query($koneksi, $query_total);
$data_total  = mysqli_fetch_assoc($res_total);
$total_data  = $data_total['total'];
$total_halaman = ceil($total_data / $limit);

// 4. Query utama dengan JOIN tabel users & products
$query = "SELECT product_reviews.*, users.name AS customer_name, products.name_product 
          FROM product_reviews 
          JOIN users ON product_reviews.id_user = users.id_user 
          JOIN products ON product_reviews.id_product = products.id_product 
          $where_clause
          ORDER BY product_reviews.id_review DESC 
          LIMIT $limit OFFSET $offset";

$select_reviews = mysqli_query($koneksi, $query);

// Cek jika terjadi error pada query
if (!$select_reviews) {
    die("Query Error: " . mysqli_error($koneksi));
}
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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">⭐ Daftar Review Produk</h1>
                    </div>

                    <!-- Filter Tanggal Ulasan -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body p-3">
                            <form method="GET" action="" class="form-inline">
                                <label for="tanggal" class="mr-2 font-weight-bold" style="color: #7d5260;">Filter Tanggal:</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control form-control-sm mr-2" value="<?php echo $filter_tanggal; ?>">
                                <button type="submit" class="btn btn-sm btn-pink-add">Cari</button>
                                <?php if (!empty($filter_tanggal)) : ?>
                                    <a href="tabel_reviews.php" class="btn btn-sm btn-secondary ml-2">Reset</a>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Review -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Customer</th>
                                    <th>Nama Produk</th>
                                    <th>Rating</th>
                                    <th>Ulasan</th>
                                    <th>Foto</th>
                                    <th>Tanggal Review</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($select_reviews) > 0) : ?>
                                    <?php while ($review = mysqli_fetch_object($select_reviews)) : ?>
                                        <tr>
                                            <td><strong>#<?php echo $review->id_review; ?></strong></td>
                                            <td><?php echo htmlspecialchars($review->customer_name); ?></td>
                                            <td><?php echo htmlspecialchars($review->name_product); ?></td>
                                            <td>
                                                <span class="badge badge-warning p-2" style="color: #2b2b2b;">
                                                    ★ <?php echo $review->rating; ?>/5
                                                </span>
                                            </td>
                                            <td><?php echo nl2br(htmlspecialchars($review->review)); ?></td>
                                            <td class="text-center">
                                                <?php if (!empty($review->photo)) : ?>
                                                    <img src="foto/<?php echo rawurlencode($review->photo); ?>" 
                                                         alt="Foto Review" 
                                                         class="rounded border" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                <?php else : ?>
                                                    <span class="text-muted small">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo date('d-m-Y H:i', strtotime($review->create_at)); ?></td>
                                            <td>
                                              <a href="detail_review.php?id_review=<?php echo $review->id_review; ?>" 
       class="btn btn-pink-update btn-sm">
        <i class="fas fa-eye"></i> Detail
    </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Tidak ada data review untuk tanggal ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Navigation -->
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                        <div>
                            <small class="text-muted">
                                Menampilkan <?php echo $total_data > 0 ? $offset + 1 : 0; ?>–<?php echo min($offset + $limit, $total_data); ?> dari <?php echo $total_data; ?> review
                            </small>
                        </div>
                        <nav>
                            <ul class="pagination pagination-sm m-0">
                                <!-- Tombol Kiri (<) -->
                                <li class="page-item <?php echo ($halaman_aktif <= 1) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?halaman=<?php echo $halaman_aktif - 1; ?>&tanggal=<?php echo $filter_tanggal; ?>">
                                        &lt;
                                    </a>
                                </li>

                                <!-- Angka Halaman -->
                                <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
                                    <li class="page-item <?php echo ($halaman_aktif == $i) ? 'active' : ''; ?>">
                                        <a class="page-link" href="?halaman=<?php echo $i; ?>&tanggal=<?php echo $filter_tanggal; ?>">
                                            <?php echo $i; ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <!-- Tombol Kanan (>) -->
                                <li class="page-item <?php echo ($halaman_aktif >= $total_halaman) ? 'disabled' : ''; ?>">
                                    <a class="page-link" href="?halaman=<?php echo $halaman_aktif + 1; ?>&tanggal=<?php echo $filter_tanggal; ?>">
                                        &gt;
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>