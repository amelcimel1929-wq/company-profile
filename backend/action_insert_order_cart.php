<?php
session_start();
require "connection.php";
require "cart_helper.php";

// Sama kayak action_insert_order.php, tapi ngambil beberapa cart_items sekaligus
// jadi 1 order dengan banyak order_details -- dipanggil dari checkout_cart.php.

function redirectTo($path) {
    header("Location: " . $path);
    exit;
}

function backToCart($selected, $errorCode) {
    $qs = 'error=' . $errorCode;
    foreach ($selected as $id) {
        $qs .= '&selected[]=' . (int) $id;
    }
    redirectTo('/company-profile/frontend/public/checkout_cart.php?' . $qs);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/company-profile/frontend/public/keranjang.php');
}
if (!isset($_SESSION['id_user'])) {
    redirectTo('/company-profile/frontend/public/login.php');
}

$idUser = (int) $_SESSION['id_user'];
$selected = array_map('intval', $_POST['id_cart_item'] ?? []);
$selected = array_values(array_unique(array_filter($selected, function ($id) {
    return $id > 0;
})));
$noTelepon = trim($_POST['no_telepon'] ?? '');

if (empty($selected)) {
    redirectTo('/company-profile/frontend/public/keranjang.php');
}
if ($noTelepon === '') {
    backToCart($selected, 'telepon');
}

mysqli_begin_transaction($koneksi);
try {
    ensureCartTables($koneksi);

    $placeholders = implode(',', array_fill(0, count($selected), '?'));
    $types = 'i' . str_repeat('i', count($selected));
    $params = array_merge([$idUser], $selected);

    // Kunci baris produk yang bakal dipotong stoknya, biar aman kalau ada
    // checkout lain jalan bersamaan buat produk yang sama. Harga ikut flash_sale
    // kalau id_flash_sale di cart_items masih valid nunjuk produk yang sama --
    // divalidasi ulang di sini juga (bukan percaya harga dari klien).
    $stmt = mysqli_prepare($koneksi, "SELECT ci.id_cart_item, ci.quantity, p.id_product, p.stock,
                                       COALESCE(fs.harga_akhir, p.price) AS price
                                       FROM carts c
                                       INNER JOIN cart_items ci ON ci.id_cart = c.id_cart
                                       INNER JOIN products p ON p.id_product = ci.id_product
                                       LEFT JOIN flash_sale fs ON fs.id_flash_sale = ci.id_flash_sale AND fs.id_product = ci.id_product
                                       WHERE c.id_user = ? AND ci.id_cart_item IN ($placeholders) FOR UPDATE");
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    mysqli_stmt_execute($stmt);
    $rows = mysqli_stmt_get_result($stmt);
    $items = [];
    while ($row = mysqli_fetch_assoc($rows)) {
        $items[] = $row;
    }
    mysqli_stmt_close($stmt);

    if (empty($items)) {
        mysqli_rollback($koneksi);
        redirectTo('/company-profile/frontend/public/keranjang.php?error=soldout');
    }

    // Kalau ada produk yang stoknya udah gak cukup pas checkout beneran
    // (berubah sejak halaman review dibuka), batalin semuanya -- jangan
    // separuh pesanan aja yang jalan.
    foreach ($items as $item) {
        if ((int) $item['stock'] < (int) $item['quantity']) {
            mysqli_rollback($koneksi);
            backToCart($selected, 'stok');
        }
    }

    $total = 0;
    foreach ($items as $item) {
        $total += (float) $item['price'] * (int) $item['quantity'];
    }

    $orderCode = 'ORD' . date('YmdHis') . random_int(10, 99);
    $orderDate = date('Y-m-d H:i:s');
    $status = 'Menunggu';

    $orderStmt = mysqli_prepare($koneksi, "INSERT INTO orders (id_user, order_code, no_telepon, order_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($orderStmt, 'isssds', $idUser, $orderCode, $noTelepon, $orderDate, $total, $status);
    mysqli_stmt_execute($orderStmt);
    $idOrder = mysqli_insert_id($koneksi);
    mysqli_stmt_close($orderStmt);

    $size = '-';
    foreach ($items as $item) {
        $idProduct = (int) $item['id_product'];
        $quantity = (int) $item['quantity'];
        $price = (float) $item['price'];
        $subtotal = $price * $quantity;

        $detailStmt = mysqli_prepare($koneksi, "INSERT INTO order_details (id_order, id_product, size, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($detailStmt, 'iissdd', $idOrder, $idProduct, $size, $quantity, $price, $subtotal);
        mysqli_stmt_execute($detailStmt);
        mysqli_stmt_close($detailStmt);

        $stockStmt = mysqli_prepare($koneksi, "UPDATE products SET stock = stock - ? WHERE id_product = ?");
        mysqli_stmt_bind_param($stockStmt, 'ii', $quantity, $idProduct);
        mysqli_stmt_execute($stockStmt);
        mysqli_stmt_close($stockStmt);

        $cartDeleteStmt = mysqli_prepare($koneksi, "DELETE FROM cart_items WHERE id_cart_item = ?");
        $idCartItem = (int) $item['id_cart_item'];
        mysqli_stmt_bind_param($cartDeleteStmt, 'i', $idCartItem);
        mysqli_stmt_execute($cartDeleteStmt);
        mysqli_stmt_close($cartDeleteStmt);
    }

    mysqli_commit($koneksi);
    redirectTo('/company-profile/frontend/public/payment.php?id_order=' . $idOrder);
} catch (Throwable $e) {
    mysqli_rollback($koneksi);
    http_response_code(400);
    exit('Gagal membuat pesanan: ' . htmlspecialchars($e->getMessage()));
}
?>
