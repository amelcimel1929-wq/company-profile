<?php
session_start();
require "connection.php";

// 1. Pastikan request dikirim via metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /company-profile/frontend/public/index.php");
    exit;
}

// 2. Cek status login
if (!isset($_SESSION['id_user'])) {
    header("Location: /company-profile/frontend/public/login.php");
    exit;
}

// 3. Tangkap & validasi input POST
$id_user    = $_SESSION['id_user'];
$id_product = isset($_POST['id_product']) ? trim($_POST['id_product']) : '';
$size       = isset($_POST['size']) ? trim($_POST['size']) : '';
$quantity   = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
$price      = isset($_POST['price']) ? (float)$_POST['price'] : 0.0;

if (empty($id_product) || empty($size) || $quantity <= 0 || $price <= 0) {
    die("Data pesanan tidak valid.");
}

$subtotal   = $price * $quantity;
$order_code = "ORD" . date('YmdHis') . rand(10, 99);
$order_date = date('Y-m-d H:i:s');
$status     = "Menunggu";

// 4. Gunakan Transaction untuk memastikan semua query sukses bersamaan
mysqli_begin_transaction($koneksi);

try {
    // A. Insert ke tabel orders
    $stmt1 = mysqli_prepare($koneksi, "
        INSERT INTO orders (id_user, order_code, order_date, total_price, status)
        VALUES (?, ?, ?, ?, ?)
    ");
    mysqli_stmt_bind_param($stmt1, "issds", $id_user, $order_code, $order_date, $subtotal, $status);
    mysqli_stmt_execute($stmt1);
    
    // PENTING: Mengambil ID Order yang baru dibuat di tabel orders
    $id_order = mysqli_insert_id($koneksi);
    mysqli_stmt_close($stmt1);

    // B. Insert ke tabel order_details
    $stmt2 = mysqli_prepare($koneksi, "
        INSERT INTO order_details (id_order, id_product, size, quantity, price, subtotal)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    mysqli_stmt_bind_param($stmt2, "iissdd", $id_order, $id_product, $size, $quantity, $price, $subtotal);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_close($stmt2);

    // C. Kurangi stok produk (dengan cek sisa stok)
    $stmt3 = mysqli_prepare($koneksi, "
        UPDATE products SET stock = stock - ? WHERE id_product = ? AND stock >= ?
    ");
    mysqli_stmt_bind_param($stmt3, "isi", $quantity, $id_product, $quantity);
    mysqli_stmt_execute($stmt3);

    if (mysqli_stmt_affected_rows($stmt3) === 0) {
        throw new Exception("Stok produk tidak mencukupi.");
    }
    mysqli_stmt_close($stmt3);

    // Commit jika semua query berhasil
    mysqli_commit($koneksi);

    // 5. Redirect ke halaman payment dengan path absolut Laragon
    header("Location: /company-profile/frontend/public/payment.php?id_order=" . $id_order);
    exit;

} catch (Exception $e) {
    // Rollback jika ada satu query yang gagal
    mysqli_rollback($koneksi);
    die("Gagal memproses order: " . $e->getMessage());
}
?>