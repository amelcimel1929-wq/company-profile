<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_order'])) {
    $id_order = $_POST['id_order'];

    // 1. Ubah status pembayaran di tabel payments menjadi Lunas
    mysqli_query($koneksi, "UPDATE payments SET payment_status = 'Lunas', payment_date = NOW() WHERE id_order = '$id_order'");

    // 2. Ubah status pesanan di tabel orders secara otomatis menjadi Diproses
    mysqli_query($koneksi, "UPDATE orders SET status = 'Diproses' WHERE id_order = '$id_order'");

    header("Location: detail_order.php?id_order=" . $id_order);
} else {
    header("Location: tabel_orders.php");
}
?>