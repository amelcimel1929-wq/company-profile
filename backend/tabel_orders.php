<?php
include "connection.php";

// 1. Tangkap parameter filter tanggal & pagination
$filter_tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : '';
$halaman_aktif   = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$limit           = 10; // Mengubah batas menjadi 10 data per halaman
$offset          = ($halaman_aktif - 1) * $limit;

// 2. Query dasar & filter tanggal
$where_clause = "";
if (!empty($filter_tanggal)) {
    $where_clause = " WHERE DATE(orders.order_date) = '$filter_tanggal' ";
}

// 3. Hitung total data untuk pagination
$query_total = "SELECT COUNT(*) as total FROM orders $where_clause";
$res_total   = mysqli_query($koneksi, $query_total);
$data_total  = mysqli_fetch_assoc($res_total);
$total_data  = $data_total['total'];
$total_halaman = ceil($total_data / $limit);

// 4. Query utama dengan JOIN, WHERE, ORDER BY, dan LIMIT
$query = "SELECT orders.*, users.name AS customer_name 
          FROM orders 
          JOIN users ON orders.id_user = users.id_user 
          $where_clause
          ORDER BY orders.id_order DESC 
          LIMIT $limit OFFSET $offset";

$select_orders = mysqli_query($koneksi, $query);
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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">📋 Daftar Pesanan</h1>
                    </div>

                    <!-- Filter Tanggal Pembelian -->
                    <div class="card mb-3 border-0 shadow-sm">
                        <div class="card-body p-3">
                            <form method="GET" action="" class="form-inline">
                                <label for="tanggal" class="mr-2 font-weight-bold" style="color: #7d5260;">Filter Tanggal:</label>
                                <input type="date" id="tanggal" name="tanggal" class="form-control form-control-sm mr-2" value="<?php echo $filter_tanggal; ?>">
                                <button type="submit" class="btn btn-sm btn-pink-add">Cari</button>
                                <?php if (!empty($filter_tanggal)) : ?>
                                    <a href="tabel_orders.php" class="btn btn-sm btn-secondary ml-2">Reset</a>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>

                    <!-- Tabel Pesanan -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th>Kode Pesanan</th>
                                    <th>Nama Customer</th>
                                    <th>No. Telepon</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($select_orders) > 0) : ?>
                                    <?php while ($order = mysqli_fetch_object($select_orders)) : ?>
                                        <tr>
                                            <td><strong><?php echo $order->order_code; ?></strong></td>
                                            <td><?php echo $order->customer_name; ?></td>
                                            <td><?php echo !empty($order->no_telepon) ? htmlspecialchars($order->no_telepon) : '-'; ?></td>
                                            <td><?php echo date('d-m-Y H:i', strtotime($order->order_date)); ?></td>
                                            <td>Rp <?php echo number_format($order->total_price, 0, ',', '.'); ?></td>
                                            <td>
                                                <?php 
                                                $badge_class = 'badge-secondary';
                                                if ($order->status == 'Menunggu') $badge_class = 'badge-warning';
                                                elseif ($order->status == 'Diproses') $badge_class = 'badge-info';
                                                elseif ($order->status == 'Siap diambil') $badge_class = 'badge-primary';
                                                elseif ($order->status == 'Sudah Diambil') $badge_class = 'badge-success';
                                                elseif ($order->status == 'Dibatalkan') $badge_class = 'badge-danger';
                                                ?>
                                                <span class="badge <?php echo $badge_class; ?> p-2"><?php echo $order->status; ?></span>
                                            </td>
                                            <td>
                                                <a href="detail_orders.php?id_order=<?php echo $order->id_order; ?>" class="btn btn-pink-update btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Tidak ada data pesanan untuk tanggal ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Navigation dengan Tombol Kiri Kanan (< >) -->
                    <div class="d-flex justify-content-between align-items-center mt-3 mb-4">
                        <div>
                            <small class="text-muted">
                                Menampilkan <?php echo $total_data > 0 ? $offset + 1 : 0; ?>–<?php echo min($offset + $limit, $total_data); ?> dari <?php echo $total_data; ?> pesanan
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