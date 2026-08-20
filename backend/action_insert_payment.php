<?php
session_start();
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_user'])) {
    header('Location: /company-profile/frontend/public/produk.php');
    exit;
}

$idOrder = isset($_POST['id_order']) ? (int) $_POST['id_order'] : 0;
$idUser = (int) $_SESSION['id_user'];
if ($idOrder <= 0 || !isset($_FILES['proof_image']) || $_FILES['proof_image']['error'] !== UPLOAD_ERR_OK) {
    exit('Bukti pembayaran wajib diunggah.');
}

$orderStmt = mysqli_prepare($koneksi, 'SELECT id_order FROM orders WHERE id_order = ? AND id_user = ?');
mysqli_stmt_bind_param($orderStmt, 'ii', $idOrder, $idUser);
mysqli_stmt_execute($orderStmt);
$order = mysqli_fetch_assoc(mysqli_stmt_get_result($orderStmt));
mysqli_stmt_close($orderStmt);
if (!$order) {
    http_response_code(403);
    exit('Pesanan tidak ditemukan atau bukan milik Anda.');
}

$allowedMime = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
$mime = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['proof_image']['tmp_name']);
if (!isset($allowedMime[$mime]) || $_FILES['proof_image']['size'] > 5 * 1024 * 1024) {
    exit('Bukti pembayaran harus berupa JPG, PNG, atau WEBP dengan ukuran maksimal 5 MB.');
}

$uploadDir = __DIR__ . '/bukti_bayar';
if (!is_dir($uploadDir) && !mkdir($uploadDir, 0755, true)) {
    exit('Folder bukti pembayaran tidak dapat dibuat.');
}
$filename = 'payment_' . $idOrder . '_' . bin2hex(random_bytes(8)) . '.' . $allowedMime[$mime];
if (!move_uploaded_file($_FILES['proof_image']['tmp_name'], $uploadDir . '/' . $filename)) {
    exit('Bukti pembayaran gagal diunggah.');
}

mysqli_begin_transaction($koneksi);
try {
    $checkStmt = mysqli_prepare($koneksi, 'SELECT 1 FROM payments WHERE id_order = ?');
    mysqli_stmt_bind_param($checkStmt, 'i', $idOrder);
    mysqli_stmt_execute($checkStmt);
    $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($checkStmt));
    mysqli_stmt_close($checkStmt);

    if ($existing) {
        $paymentStmt = mysqli_prepare($koneksi, "UPDATE payments SET payment_method = 'QRIS', payment_status = 'belum_bayar', proof_image = ?, payment_date = NOW() WHERE id_order = ?");
        mysqli_stmt_bind_param($paymentStmt, 'si', $filename, $idOrder);
    } else {
        $paymentStmt = mysqli_prepare($koneksi, "INSERT INTO payments (id_order, payment_method, payment_status, proof_image, payment_date) VALUES (?, 'QRIS', 'belum_bayar', ?, NOW())");
        mysqli_stmt_bind_param($paymentStmt, 'is', $idOrder, $filename);
    }
    mysqli_stmt_execute($paymentStmt);
    mysqli_stmt_close($paymentStmt);

    $status = 'Menunggu';
    $statusStmt = mysqli_prepare($koneksi, 'UPDATE orders SET status = ? WHERE id_order = ?');
    mysqli_stmt_bind_param($statusStmt, 'si', $status, $idOrder);
    mysqli_stmt_execute($statusStmt);
    mysqli_stmt_close($statusStmt);
    mysqli_commit($koneksi);

    header('Location: /company-profile/frontend/public/terima_kasih.php?order=' . $idOrder);
    exit;
} catch (Throwable $e) {
    mysqli_rollback($koneksi);
    @unlink($uploadDir . '/' . $filename);
    exit('Gagal menyimpan pembayaran.');
}
?>
