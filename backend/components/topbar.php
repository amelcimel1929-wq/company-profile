<?php
// Pastikan koneksi database sudah tersedia
if (!isset($koneksi)) {
    include "connection.php";
}

// Query mengambil pesanan baru (misal status 'Menunggu')
$query_notif = mysqli_query($koneksi, "SELECT orders.*, users.name AS customer_name 
                                       FROM orders 
                                       JOIN users ON orders.id_user = users.id_user 
                                       WHERE orders.status = 'Menunggu' 
                                       ORDER BY orders.order_date DESC 
                                       LIMIT 5");
$total_notif = mysqli_num_rows($query_notif);
?>

<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Alerts / Notifikasi Pesanan -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <?php if ($total_notif > 0): ?>
                    <span class="badge badge-danger badge-counter" id="notifBadge"><?php echo $total_notif; ?></span>
                <?php endif; ?>
            </a>
            
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Pesanan Masuk
                </h6>
                
                <?php if ($total_notif > 0): ?>
                    <?php while ($notif = mysqli_fetch_object($query_notif)): ?>
                        <a class="dropdown-item d-flex align-items-center" href="detail_order.php?id_order=<?php echo $notif->id_order; ?>">
                            <div class="mr-3">
                                <div class="icon-circle bg-primary">
                                    <i class="fas fa-shopping-bag text-white"></i>
                                </div>
                            </div>
                            <div>
                                <div class="small text-gray-500"><?php echo date('d-m-Y H:i', strtotime($notif->order_date)); ?></div>
                                <span class="font-weight-bold">Pesanan Baru dari <?php echo htmlspecialchars($notif->customer_name); ?></span>
                                <div class="small text-gray-600">Total: Rp <?php echo number_format($notif->total_price, 0, ',', '.'); ?></div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                <?php else: ?>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Tidak ada pesanan baru</a>
                <?php endif; ?>

                <a class="dropdown-item text-center small text-gray-500" href="tabel_orders.php">Lihat Semua Pesanan</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Amelora Collection</span>
                <span class="icon-circle-pink">
                    <svg class="dress-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2c-1.1 0-2 .9-2 2 0 .74.4 1.38 1 1.72V7l-1.5 1.5L8 10l-3 9c-.3.9.3 2 1.3 2h11.4c1 0 1.6-1.1 1.3-2l-3-9-1.5-1.5L13 7V5.72c.6-.34 1-.98 1-1.72 0-1.1-.9-2-2-2zm0 2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm-1.5 6.5L12 9l1.5 1.5 1 3-2.5-1-2.5 1 1-3z"/>
                    </svg>
                </span>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>

<!-- Fitur Audio Notifikasi -->
<audio id="notifSound" src="assets/audio/notification.mp3" preload="auto"></audio>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var totalNotif = <?php echo (int)$total_notif; ?>;
        // Bunyikan suara notifikasi jika ada pesanan baru
        if (totalNotif > 0) {
            var audio = document.getElementById("notifSound");
            if (audio) {
                audio.play().catch(function(error) {
                    console.log("Autoplay diblokir oleh browser, butuh interaksi user pertama kali.");
                });
            }
        }
    });
</script>