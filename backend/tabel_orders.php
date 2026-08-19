<?php
include "connection.php";

// Query mengambil data pesanan beserta nama customer dari tabel users
$query = "SELECT orders.*, users.name AS customer_name 
          FROM orders 
          JOIN users ON orders.id_user = users.id_user 
          ORDER BY orders.id_order DESC";

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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Daftar Pesanan</h1>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th>Kode Pesanan</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($order = mysqli_fetch_object($select_orders)) : ?>
                                    <tr>
                                        <td><strong><?php echo $order->order_code; ?></strong></td>
                                        <td><?php echo $order->customer_name; ?></td>
                                        <td><?php echo date('d-m-Y H:i', strtotime($order->order_date)); ?></td>
                                        <td>Rp <?php echo number_format($order->total_price, 0, ',', '.'); ?></td>
                                        <td>
                                            <?php 
                                            $badge_class = 'badge-secondary';
                                            if ($order->status == 'Menunggu') $badge_class = 'badge-warning';
                                            elseif ($order->status == 'Diproses') $badge_class = 'badge-info';
                                            elseif ($order->status == 'Siap Diambil') $badge_class = 'badge-primary';
                                            elseif ($order->status == 'Sudah Diambil') $badge_class = 'badge-success';
                                            elseif ($order->status == 'Dibatalkan') $badge_class = 'badge-danger';
                                            ?>
                                            <span class="badge <?php echo $badge_class; ?> p-2"><?php echo $order->status; ?></span>
                                        </td>
                                        <td>
                                          <a href="detail_orders.php?id_order=<?php echo $order->id_order; ?>" class="btn btn-pink-update btn-sm">
                                            <i class="fas fa-eye"></i> Detail   
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