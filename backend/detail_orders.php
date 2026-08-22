<?php
include "connection.php";

if (!isset($_GET['id_order']) || empty($_GET['id_order'])) {
    header("Location: tabel_orders.php");
    exit();
}

$id_order = $_GET['id_order'];

// Query JOIN orders, users, dan payments
$query_order = mysqli_query($koneksi, "SELECT orders.*, users.name AS customer_name, users.email,
                                              payments.payment_method, payments.payment_status, payments.payment_date, payments.proof_image 
                                       FROM orders 
                                       JOIN users ON orders.id_user = users.id_user 
                                       LEFT JOIN payments ON orders.id_order = payments.id_order
                                       WHERE orders.id_order = '$id_order'");
$order = mysqli_fetch_object($query_order);

if (!$order) {
    header("Location: tabel_orders.php");
    exit();
}

// Query rincian produk yang dibeli
$query_details = mysqli_query($koneksi, "SELECT order_details.*, products.name_product, products.Image 
                                         FROM order_details 
                                         JOIN products ON order_details.id_product = products.id_product 
                                         WHERE order_details.id_order = '$id_order'");
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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Detail Pesanan #<?php echo $order->order_code; ?></h1>
                        <a href="tabel_orders.php" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>

                    <!-- BARIS INFORMASI PESANAN (3 KOLOM) -->
                    <div class="row mb-4">
                        
                        <!-- Div 1: Informasi Customer -->
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold" style="color: #7d5260;">Pemesan</h5>
                                    <p class="mb-1"><strong>Nama:</strong> <?php echo $order->customer_name; ?></p>
                                    <p class="mb-1"><strong>Email:</strong> <?php echo $order->email; ?></p>
                                    <p class="mb-1"><strong>No. Telepon:</strong>
                                        <?php if (!empty($order->no_telepon)): ?>
                                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $order->no_telepon); ?>" target="_blank">
                                                <?php echo htmlspecialchars($order->no_telepon); ?>
                                            </a>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </p>
                                    <p class="mb-1"><strong>Tanggal Pesan:</strong> <?php echo date('d-m-Y H:i', strtotime($order->order_date)); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Div 2: Informasi Pembayaran (QRIS & Bukti Bayar) -->
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold" style="color: #7d5260;">Pembayaran (QRIS)</h5>
                                    <p class="mb-1"><strong>Status Bayar:</strong> 
                                        <?php if ($order->payment_status == 'lunas'): ?>
                                            <span class="badge badge-success">Lunas</span>
                                        <?php elseif (!empty($order->proof_image)): ?>
                                            <span class="badge badge-info">Menunggu Verifikasi</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning">Belum Bayar / Menunggu Verifikasi</span>
                                        <?php endif; ?>
                                    </p>

                                    <!-- Tampilan Bukti Transfer -->
                                    <div class="my-2">
                                        <small class="d-block mb-1"><strong>Bukti Pembayaran:</strong></small>
                                        <?php if (!empty($order->proof_image)): ?>
                                            <a href="bukti_bayar/<?php echo $order->proof_image; ?>" target="_blank">
                                                <img src="bukti_bayar/<?php echo $order->proof_image; ?>" style="width: 100%; max-height: 120px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                                            </a>
                                            <small class="text-muted d-block mt-1">*Klik gambar untuk memperbesar</small>
                                        <?php else: ?>
                                            <span class="text-muted small"><em>Customer belum mengunggah bukti bayar.</em></span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Tombol Cepat Set Lunas -->
                                    <?php if ($order->payment_status != 'Lunas' && !empty($order->proof_image)): ?>
                                        <form action="action_confirm_payment.php" method="post" class="mt-2">
                                            <input type="hidden" name="id_order" value="<?php echo $order->id_order; ?>">
                                            <button type="submit" class="btn btn-sm btn-success btn-block">Konfirmasi Pembayaran Lunas</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Div 3: Update Status Pesanan -->
                        <div class="col-md-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold" style="color: #7d5260;">Update Status Pesanan</h5>
                                    <form action="action_update_status.php" method="post">
                                        <input type="hidden" name="id_order" value="<?php echo $order->id_order; ?>">
                                        <div class="form-group mb-3">
                                            <select name="status" class="form-control" required>
                                                <option value="Menunggu" <?php echo ($order->status == 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                                                <option value="Diproses" <?php echo ($order->status == 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                                                <option value="Siap diambil" <?php echo ($order->status == 'Siap diambil') ? 'selected' : ''; ?>>Siap diambil</option>
                                                <option value="Sudah Diambil" <?php echo ($order->status == 'Sudah Diambil') ? 'selected' : ''; ?>>Sudah Diambil</option>
                                                <option value="Dibatalkan" <?php echo ($order->status == 'Dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-pink-add btn-block">Simpan Status</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- TABEL RINCIAN ITEM PRODUK -->
                    <div class="card shadow-sm">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold" style="color: #7d5260;">Item Pesanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th>Ukuran</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($item = mysqli_fetch_object($query_details)) : ?>
                                            <tr>
                                                <td>
                                                    <img src="foto/<?php echo $item->Image; ?>" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;" class="mr-2">
                                                    <?php echo $item->name_product; ?>
                                                </td>
                                                <td><span class="badge badge-secondary"><?php echo $item->size; ?></span></td>
                                                <td>Rp <?php echo number_format($item->price, 0, ',', '.'); ?></td>
                                                <td><?php echo $item->quantity; ?></td>
                                                <td>Rp <?php echo number_format($item->subtotal, 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4" class="text-right">Total Keseluruhan:</th>
                                            <th>Rp <?php echo number_format($order->total_price, 0, ',', '.'); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
