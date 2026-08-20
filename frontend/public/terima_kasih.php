<?php
require "backend/connection.php";
$id_order = $_GET['order'];
?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Terima Kasih</title></head>
<body>
<section class="py-5 text-center">
    <div class="container">
        <h2>Terima kasih! Pesananmu sedang diproses.</h2>
        <p>Admin akan mengecek pembayaranmu dan mengubah status pesanan.</p>
        <a href="index.php" class="btn btn-dark">Kembali ke Beranda</a>
    </div>
</section>
</body>
</html>