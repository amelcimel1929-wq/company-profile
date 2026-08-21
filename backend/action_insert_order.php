<?php
session_start();
require "connection.php";

function redirectTo($path) {
    header("Location: " . $path);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/company-profile/frontend/public/produk.php');
}

if (!isset($_SESSION['id_user'])) {
    http_response_code(401);
    exit('Silakan login terlebih dahulu sebelum membuat pesanan.');
}

$idUser = (int) $_SESSION['id_user'];
$idProduct = isset($_POST['id_product']) ? (int) $_POST['id_product'] : 0;
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;
// Ambil input nomor telepon dari POST request
$noTelepon = isset($_POST['no_telepon']) ? trim($_POST['no_telepon']) : '';

if ($idProduct <= 0 || $quantity <= 0 || empty($noTelepon)) {
    exit('Data pesanan tidak valid atau nomor telepon belum diisi.');
}

mysqli_begin_transaction($koneksi);
try {
    $productStmt = mysqli_prepare($koneksi, "SELECT price, stock FROM products WHERE id_product = ? FOR UPDATE");
    mysqli_stmt_bind_param($productStmt, 'i', $idProduct);
    mysqli_stmt_execute($productStmt);
    $product = mysqli_fetch_assoc(mysqli_stmt_get_result($productStmt));
    mysqli_stmt_close($productStmt);

    if (!$product || (int) $product['stock'] < $quantity) {
        throw new Exception('Produk tidak tersedia atau stok tidak mencukupi.');
    }

    $price = (float) $product['price'];
    $subtotal = $price * $quantity;
    $orderCode = 'ORD' . date('YmdHis') . random_int(10, 99);
    $orderDate = date('Y-m-d H:i:s');
    $status = 'Menunggu';
    $size = '-';

    // Sertakan kolom no_telepon pada query insert
    $orderStmt = mysqli_prepare($koneksi, "INSERT INTO orders (id_user, order_code, no_telepon, order_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?)");
    // Parameter types: i (int), s (string), s (string), s (string), d (double), s (string)
    mysqli_stmt_bind_param($orderStmt, 'isssds', $idUser, $orderCode, $noTelepon, $orderDate, $subtotal, $status);
    mysqli_stmt_execute($orderStmt);
    $idOrder = mysqli_insert_id($koneksi);
    mysqli_stmt_close($orderStmt);

    $detailStmt = mysqli_prepare($koneksi, "INSERT INTO order_details (id_order, id_product, size, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($detailStmt, 'iissdd', $idOrder, $idProduct, $size, $quantity, $price, $subtotal);
    mysqli_stmt_execute($detailStmt);
    mysqli_stmt_close($detailStmt);

    $stockStmt = mysqli_prepare($koneksi, "UPDATE products SET stock = stock - ? WHERE id_product = ?");
    mysqli_stmt_bind_param($stockStmt, 'ii', $quantity, $idProduct);
    mysqli_stmt_execute($stockStmt);
    mysqli_stmt_close($stockStmt);

    mysqli_commit($koneksi);
    redirectTo('/company-profile/frontend/public/payment.php?id_order=' . $idOrder);
} catch (Throwable $e) {
    mysqli_rollback($koneksi);
    http_response_code(400);
    exit('Gagal membuat pesanan: ' . htmlspecialchars($e->getMessage()));
}
?>