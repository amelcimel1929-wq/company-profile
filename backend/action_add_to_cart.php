<?php
session_start();
require 'connection.php';
require 'cart_helper.php';

function cartRedirect($path) {
    header('Location: /company-profile/frontend/public/' . $path);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    cartRedirect('index.php');
}

$idProduct = (int) ($_POST['id_product'] ?? 0);
$quantity = max(1, (int) ($_POST['quantity'] ?? 1));
if ($idProduct <= 0) {
    cartRedirect('index.php');
}

// Guest tetap bisa menekan ikon: setelah login, produk ini langsung dimasukkan.
if (!isset($_SESSION['id_user'])) {
    $_SESSION['pending_cart_item'] = ['id_product' => $idProduct, 'quantity' => $quantity];
    cartRedirect('login.php?redirect=' . rawurlencode('keranjang.php?add_pending=1'));
}

ensureCartTables($koneksi);
$productStmt = mysqli_prepare($koneksi, 'SELECT stock FROM products WHERE id_product = ?');
mysqli_stmt_bind_param($productStmt, 'i', $idProduct);
mysqli_stmt_execute($productStmt);
$product = mysqli_fetch_assoc(mysqli_stmt_get_result($productStmt));
mysqli_stmt_close($productStmt);

if (!$product || (int) $product['stock'] <= 0) {
    cartRedirect('keranjang.php?error=soldout');
}

$idUser = (int) $_SESSION['id_user'];
$cartStmt = mysqli_prepare($koneksi, 'INSERT INTO carts (id_user) VALUES (?) ON DUPLICATE KEY UPDATE updated_at = CURRENT_TIMESTAMP');
mysqli_stmt_bind_param($cartStmt, 'i', $idUser);
mysqli_stmt_execute($cartStmt);
mysqli_stmt_close($cartStmt);

$cartStmt = mysqli_prepare($koneksi, 'SELECT id_cart FROM carts WHERE id_user = ? LIMIT 1');
mysqli_stmt_bind_param($cartStmt, 'i', $idUser);
mysqli_stmt_execute($cartStmt);
$cart = mysqli_fetch_assoc(mysqli_stmt_get_result($cartStmt));
mysqli_stmt_close($cartStmt);
$idCart = (int) $cart['id_cart'];

$itemStmt = mysqli_prepare($koneksi, 'SELECT id_cart_item, quantity FROM cart_items WHERE id_cart = ? AND id_product = ?');
mysqli_stmt_bind_param($itemStmt, 'ii', $idCart, $idProduct);
mysqli_stmt_execute($itemStmt);
$existing = mysqli_fetch_assoc(mysqli_stmt_get_result($itemStmt));
mysqli_stmt_close($itemStmt);

$newQuantity = min((int) $product['stock'], $quantity + (int) ($existing['quantity'] ?? 0));
if ($existing) {
    $itemStmt = mysqli_prepare($koneksi, 'UPDATE cart_items SET quantity = ? WHERE id_cart_item = ?');
    $idItem = (int) $existing['id_cart_item'];
    mysqli_stmt_bind_param($itemStmt, 'ii', $newQuantity, $idItem);
} else {
    $itemStmt = mysqli_prepare($koneksi, 'INSERT INTO cart_items (id_cart, id_product, quantity) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($itemStmt, 'iii', $idCart, $idProduct, $newQuantity);
}
mysqli_stmt_execute($itemStmt);
mysqli_stmt_close($itemStmt);
cartRedirect('keranjang.php?success=added');
