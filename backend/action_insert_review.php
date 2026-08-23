<?php
session_start();
require "connection.php";

function redirectTo($path) {
    header("Location: " . $path);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_SESSION['id_user'])) {
    redirectTo('/company-profile/frontend/public/login.php');
}

$idUser = (int) $_SESSION['id_user'];
$idOrder = (int) ($_POST['id_order'] ?? 0);
$idProduct = (int) ($_POST['id_product'] ?? 0);
$rating = (int) ($_POST['rating'] ?? 0);
$review = trim($_POST['review'] ?? '');

if ($idOrder <= 0 || $idProduct <= 0) {
    redirectTo('/company-profile/frontend/public/status_pesanan.php');
}
if ($rating < 1 || $rating > 5 || $review === '') {
    redirectTo('/company-profile/frontend/public/review.php?id_order=' . $idOrder . '&error=invalid');
}

// Cuma boleh review produk yang beneran ada di pesanan MILIK user ini, dan
// pesanannya udah "Sudah Diambil" -- jangan percaya id_product dari POST doang.
$checkStmt = mysqli_prepare($koneksi, "SELECT d.id_detail
                                        FROM order_details d
                                        JOIN orders o ON o.id_order = d.id_order
                                        WHERE d.id_order = ? AND d.id_product = ? AND o.id_user = ? AND o.status = 'Sudah Diambil'");
mysqli_stmt_bind_param($checkStmt, 'iii', $idOrder, $idProduct, $idUser);
mysqli_stmt_execute($checkStmt);
$valid = mysqli_fetch_assoc(mysqli_stmt_get_result($checkStmt));
mysqli_stmt_close($checkStmt);

if (!$valid) {
    exit('Produk ini tidak ada di pesanan tersebut, atau pesanan belum "Sudah Diambil".');
}

// Foto opsional -- kalau gak upload baru pas update, foto lama dipertahankan.
$photoName = null;
$hasNewPhoto = !empty($_FILES['photo']['name']) && is_uploaded_file($_FILES['photo']['tmp_name']);
if ($hasNewPhoto) {
    $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'webp'];
    if (in_array($ext, $allowedExt, true)) {
        $photoName = time() . '_review_' . $idUser . '_' . $idProduct . '.' . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], "foto/" . $photoName);
    }
}

// Satu user cuma 1 review per produk -- submit ulang jadi update, bukan baris baru.
$existingStmt = mysqli_prepare($koneksi, "SELECT id_review, photo FROM product_reviews WHERE id_user = ? AND id_product = ?");
mysqli_stmt_bind_param($existingStmt, 'ii', $idUser, $idProduct);
mysqli_stmt_execute($existingStmt);
$existing = mysqli_fetch_assoc(mysqli_stmt_get_result($existingStmt));
mysqli_stmt_close($existingStmt);

if ($existing) {
    $finalPhoto = $photoName ?? $existing['photo'];
    $updateStmt = mysqli_prepare($koneksi, "UPDATE product_reviews SET rating = ?, review = ?, photo = ? WHERE id_review = ?");
    $idReview = (int) $existing['id_review'];
    mysqli_stmt_bind_param($updateStmt, 'issi', $rating, $review, $finalPhoto, $idReview);
    mysqli_stmt_execute($updateStmt);
    mysqli_stmt_close($updateStmt);
} else {
    $insertStmt = mysqli_prepare($koneksi, "INSERT INTO product_reviews (id_user, id_product, rating, review, photo) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($insertStmt, 'iiiss', $idUser, $idProduct, $rating, $review, $photoName);
    mysqli_stmt_execute($insertStmt);
    mysqli_stmt_close($insertStmt);
}

redirectTo('/company-profile/frontend/public/review.php?id_order=' . $idOrder . '&success=1');
?>
