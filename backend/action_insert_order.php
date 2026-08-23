<?php
session_start();
require "connection.php";
require "cart_helper.php";

function redirectTo($path) {
    header("Location: " . $path);
    exit;
}

// Balik ke halaman checkout dengan pesan error, bukan halaman putih.
function backToCheckout($idProduct, $idFlashSale, $errorCode) {
    $url = '/company-profile/frontend/public/checkout.php?id_product=' . $idProduct;
    if ($idFlashSale > 0) {
        $url .= '&id_flash_sale=' . $idFlashSale;
    }
    redirectTo($url . '&error=' . $errorCode);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/company-profile/frontend/public/produk.php');
}

if (!isset($_SESSION['id_user'])) {
    redirectTo('/company-profile/frontend/public/login.php');
}

$idUser = (int) $_SESSION['id_user'];
$idProduct = isset($_POST['id_product']) ? (int) $_POST['id_product'] : 0;
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;
// Ambil input nomor telepon dari POST request
$noTelepon = isset($_POST['no_telepon']) ? trim($_POST['no_telepon']) : '';
// Diisi kalau pesanan datang dari kartu Flash Sale.
$idFlashSale = isset($_POST['id_flash_sale']) ? (int) $_POST['id_flash_sale'] : 0;

if ($idProduct <= 0 || $quantity <= 0) {
    backToCheckout($idProduct, $idFlashSale, 'invalid');
}
if ($noTelepon === '') {
    backToCheckout($idProduct, $idFlashSale, 'telepon');
}

mysqli_begin_transaction($koneksi);
try {
    $productStmt = mysqli_prepare($koneksi, "SELECT price, stock FROM products WHERE id_product = ? FOR UPDATE");
    mysqli_stmt_bind_param($productStmt, 'i', $idProduct);
    mysqli_stmt_execute($productStmt);
    $product = mysqli_fetch_assoc(mysqli_stmt_get_result($productStmt));
    mysqli_stmt_close($productStmt);

    if (!$product) {
        throw new Exception('Produk tidak tersedia.');
    }
    if ((int) $product['stock'] < $quantity) {
        mysqli_rollback($koneksi);
        backToCheckout($idProduct, $idFlashSale, 'stok');
    }

    $price = (float) $product['price'];

    // Harga flash sale hanya dipakai kalau baris flash_sale-nya memang
    // menunjuk produk ini, supaya harga promo tidak bisa dipindah lewat POST.
    if ($idFlashSale > 0) {
        $flashStmt = mysqli_prepare($koneksi, "SELECT harga_akhir FROM flash_sale WHERE id_flash_sale = ? AND id_product = ?");
        mysqli_stmt_bind_param($flashStmt, 'ii', $idFlashSale, $idProduct);
        mysqli_stmt_execute($flashStmt);
        $flash = mysqli_fetch_assoc(mysqli_stmt_get_result($flashStmt));
        mysqli_stmt_close($flashStmt);

        if ($flash) {
            $price = (float) $flash['harga_akhir'];
        }
    }

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

    // Barang yang berhasil dibuat menjadi pesanan tidak boleh tersisa di keranjang user.
    ensureCartTables($koneksi);
    $cartDeleteStmt = mysqli_prepare($koneksi, "DELETE ci FROM cart_items ci INNER JOIN carts c ON c.id_cart = ci.id_cart WHERE c.id_user = ? AND ci.id_product = ?");
    mysqli_stmt_bind_param($cartDeleteStmt, 'ii', $idUser, $idProduct);
    mysqli_stmt_execute($cartDeleteStmt);
    mysqli_stmt_close($cartDeleteStmt);

    mysqli_commit($koneksi);
    redirectTo('/company-profile/frontend/public/payment.php?id_order=' . $idOrder);
} catch (Throwable $e) {
    mysqli_rollback($koneksi);
    http_response_code(400);
    exit('Gagal membuat pesanan: ' . htmlspecialchars($e->getMessage()));
}
?>
