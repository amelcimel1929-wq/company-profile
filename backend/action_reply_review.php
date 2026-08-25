<?php
include "connection.php";

$id_review   = isset($_POST['id_review']) ? (int) $_POST['id_review'] : 0;
$admin_reply = trim($_POST['admin_reply'] ?? '');

if ($id_review <= 0) {
    header("Location: tabel_review.php");
    exit();
}

if ($admin_reply === '') {
    // Kosongin balasan = hapus balasan yg sudah ada (admin ganti pikiran / typo parah).
    mysqli_query($koneksi, "UPDATE product_reviews SET admin_reply = NULL, replied_at = NULL WHERE id_review = $id_review");
} else {
    $reply_aman = mysqli_real_escape_string($koneksi, $admin_reply);
    mysqli_query($koneksi, "UPDATE product_reviews SET admin_reply = '$reply_aman', replied_at = NOW() WHERE id_review = $id_review");
}

header("Location: detail_review.php?id_review=$id_review");
