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

if ($idProduct <= 0 || $quantity <= 0) {
    exit('Data pesanan tidak valid.');
}

mysqli_begin_transaction($koneksi);
try {
    // Harga dan stok selalu diambil dari database, bukan dari input browser.
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
    // Nilai harus sesuai ENUM orders.status di database.
    $status = 'Menunggu';
    $size = '-';

    $orderStmt = mysqli_prepare($koneksi, "INSERT INTO orders (id_user, order_code, order_date, total_price, status) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($orderStmt, 'issds', $idUser, $orderCode, $orderDate, $subtotal, $status);
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
