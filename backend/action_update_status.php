<?php
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_order = $_POST['id_order'];
    $status   = $_POST['status'];

    $update = mysqli_query($koneksi, "UPDATE orders SET status = '$status' WHERE id_order = '$id_order'");

    if ($update) {
        header("Location: detail_order.php?id_order=" . $id_order);
    } else {
        echo "Gagal memperbarui status: " . mysqli_error($koneksi);
    }
} else {
    header("Location: tabel_orders.php");
}
?>