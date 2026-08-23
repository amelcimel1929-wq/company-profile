<?php
session_start();
require '../../backend/connection.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}

$id_user    = (int) $_SESSION['id_user'];
$id_product = isset($_POST['id_product']) ? (int) $_POST['id_product'] : 0;
$quantity   = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 1;

if ($id_product <= 0 || $quantity <= 0) {
    header('Location: produk.php?error=invalid');
    exit;
}

// 1. Cek produk masih ada stoknya (barang preloved = stok biasanya 0/1)
$stmt = mysqli_prepare($koneksi, 'SELECT stock FROM products WHERE id_product = ?');
mysqli_stmt_bind_param($stmt, 'i', $id_product);
mysqli_stmt_execute($stmt);
$result  = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

if (!$product || $product['stock'] <= 0) {
    header('Location: produk.php?error=soldout');
    exit;
}

// Karena preloved, quantity yang boleh ditambahkan tidak boleh melebihi stok
if ($quantity > $product['stock']) {
    $quantity = $product['stock'];
}

// 2. Cari / buat cart aktif untuk user ini
$stmt = mysqli_prepare($koneksi, 'SELECT id_cart FROM carts WHERE id_user = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 'i', $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$cart   = mysqli_fetch_assoc($result);

if ($cart) {
    $id_cart = (int) $cart['id_cart'];
} else {
    $stmt = mysqli_prepare($koneksi, 'INSERT INTO carts (id_user, created_at, updated_at) VALUES (?, NOW(), NOW())');
    mysqli_stmt_bind_param($stmt, 'i', $id_user);
    mysqli_stmt_execute($stmt);
    $id_cart = mysqli_insert_id($koneksi);
}

// 3. Cek apakah produk ini sudah ada di cart_items (biar tidak duplikat baris)
$stmt = mysqli_prepare($koneksi, 'SELECT id_cart_item, quantity FROM cart_items WHERE id_cart = ? AND id_product = ?');
mysqli_stmt_bind_param($stmt, 'ii', $id_cart, $id_product);
mysqli_stmt_execute($stmt);
$result    = mysqli_stmt_get_result($stmt);
$existing  = mysqli_fetch_assoc($result);

if ($existing) {
    // Sudah ada -> update quantity (tidak boleh melebihi stok tersedia)
    $newQuantity = min($existing['quantity'] + $quantity, $product['stock']);
    $stmt = mysqli_prepare($koneksi, 'UPDATE cart_items SET quantity = ? WHERE id_cart_item = ?');
    mysqli_stmt_bind_param($stmt, 'ii', $newQuantity, $existing['id_cart_item']);
    mysqli_stmt_execute($stmt);
} else {
    // Belum ada -> insert baru (quantity & selected sudah punya default di database)
    $stmt = mysqli_prepare($koneksi, 'INSERT INTO cart_items (id_cart, id_product, quantity) VALUES (?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'iii', $id_cart, $id_product, $quantity);
    mysqli_stmt_execute($stmt);
}

header('Location: keranjang.php?success=added');
exit;