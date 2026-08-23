<?php
session_start();
require 'connection.php';
require 'cart_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_user'])) {
    header('Location: /company-profile/frontend/public/login.php');
    exit;
}

ensureCartTables($koneksi);
$idUser = (int) $_SESSION['id_user'];
$idItem = (int) ($_POST['id_cart_item'] ?? 0);
if ($idItem > 0) {
    $stmt = mysqli_prepare($koneksi, 'DELETE ci FROM cart_items ci INNER JOIN carts c ON c.id_cart = ci.id_cart WHERE ci.id_cart_item = ? AND c.id_user = ?');
    mysqli_stmt_bind_param($stmt, 'ii', $idItem, $idUser);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
header('Location: /company-profile/frontend/public/keranjang.php?success=removed');
exit;
