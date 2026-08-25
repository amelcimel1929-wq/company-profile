<?php
include "connection.php";

$id_review = isset($_GET['id_review']) ? (int)$_GET['id_review'] : 0;

// Query detail review beserta data user dan produk
$query = "SELECT product_reviews.*, 
                 IFNULL(users.name, 'User Tidak Ditemukan') AS customer_name, 
                 IFNULL(users.email, '-') AS customer_email,
                 IFNULL(products.name_product, 'Produk Dihapus/Tidak Ada') AS name_product 
          FROM product_reviews 
          LEFT JOIN users ON product_reviews.id_user = users.id_user 
          LEFT JOIN products ON product_reviews.id_product = products.id_product 
          WHERE product_reviews.id_review = '$id_review'";

$result = mysqli_query($koneksi, $query);
$review = mysqli_fetch_object($result);

if (!$review) {
    echo "<script>alert('Data review tidak ditemukan!'); window.location='tabel_review.php';</script>";
    exit;
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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">📋 Detail Review #<?php echo $review->id_review; ?></h1>
                        <a href="tabel_review.php" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="180" style="color: #7d5260;">Nama Customer</th>
                                            <td>: <?php echo htmlspecialchars($review->customer_name); ?> (<?php echo htmlspecialchars($review->customer_email); ?>)</td>
                                        </tr>
                                        <tr>
                                            <th style="color: #7d5260;">Nama Produk</th>
                                            <td>: <?php echo htmlspecialchars($review->name_product); ?></td>
                                        </tr>
                                        <tr>
                                            <th style="color: #7d5260;">Rating</th>
                                            <td>: 
                                                <span class="badge badge-warning p-2" style="color: #2b2b2b;">
                                                    ★ <?php echo $review->rating; ?>/5
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style="color: #7d5260;">Tanggal Review</th>
                                            <td>: <?php echo date('d-m-Y H:i:s', strtotime($review->create_at)); ?></td>
                                        </tr>
                                        <tr>
                                            <th style="color: #7d5260;">Isi Ulasan</th>
                                            <td>: <br>
                                                <div class="p-3 bg-light rounded mt-2 border">
                                                    <?php echo nl2br(htmlspecialchars($review->review)); ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-md-4 text-center">
                                    <label class="font-weight-bold d-block" style="color: #7d5260;">Foto Lampiran Review:</label>
                                    <?php if (!empty($review->photo)) : ?>
                                        <img src="foto/<?php echo rawurlencode($review->photo); ?>" 
                                             alt="Foto Review" 
                                             class="img-fluid rounded border shadow-sm mt-2" 
                                             style="max-height: 250px; object-fit: cover;">
                                    <?php else : ?>
                                        <div class="p-4 bg-light rounded border text-muted mt-2">
                                            Tidak ada foto lampiran
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Balasan Admin -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h2 class="h6 mb-3" style="color: #7d5260;">💬 Balasan Admin</h2>
                            <?php if (!empty($review->admin_reply)) : ?>
                                <div class="p-3 bg-light rounded border mb-3">
                                    <?php echo nl2br(htmlspecialchars($review->admin_reply)); ?>
                                    <div class="text-muted small mt-2">Dibalas <?php echo date('d-m-Y H:i', strtotime($review->replied_at)); ?></div>
                                </div>
                            <?php endif; ?>
                            <form action="action_reply_review.php" method="POST">
                                <input type="hidden" name="id_review" value="<?php echo $review->id_review; ?>">
                                <div class="form-group">
                                    <label for="admin_reply" style="color: #7d5260;">
                                        <?php echo !empty($review->admin_reply) ? 'Edit balasan' : 'Tulis balasan'; ?>
                                    </label>
                                    <textarea id="admin_reply" name="admin_reply" class="form-control" rows="3" placeholder="Balas ulasan customer di sini..."><?php echo htmlspecialchars($review->admin_reply ?? ''); ?></textarea>
                                    <small class="form-text text-muted">Balasan ini bakal muncul di halaman detail produk buat semua orang. Kosongin lalu simpan buat menghapus balasan.</small>
                                </div>
                                <button type="submit" class="btn btn-pink-add">
                                    <i class="fas fa-reply"></i> <?php echo !empty($review->admin_reply) ? 'Simpan Balasan' : 'Kirim Balasan'; ?>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <?php include "components/footer.php"; ?>
        </div>
    </div>
    <?php include "partials/bottom.php"; ?>
</body>
</html>