<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_order'])) {
    $id_order = (int) $_POST['id_order'];

    // 1. Ubah status pembayaran di tabel payments menjadi Lunas
    $payment = mysqli_prepare($koneksi, "UPDATE payments SET payment_status = 'lunas', payment_date = NOW() WHERE id_order = ?");
    mysqli_stmt_bind_param($payment, 'i', $id_order);
    mysqli_stmt_execute($payment);
    mysqli_stmt_close($payment);

    // 2. Ubah status pesanan di tabel orders secara otomatis menjadi Diproses
    $status = 'Diproses';
    $order = mysqli_prepare($koneksi, "UPDATE orders SET status = ? WHERE id_order = ?");
    mysqli_stmt_bind_param($order, 'si', $status, $id_order);
    mysqli_stmt_execute($order);
    mysqli_stmt_close($order);

    header("Location: detail_orders.php?id_order=" . $id_order);
} else {
    header("Location: tabel_orders.php");
}
?>
