<?php
session_start();
require 'connection.php';

$registerPage = '/company-profile/frontend/public/register.php';

// ?redirect= (mis. balik ke checkout.php) divalidasi ulang di sini juga --
// cuma boleh file .php relatif di situs sendiri, biar gak jadi open redirect.
$redirect = $_POST['redirect'] ?? '';
if (!preg_match('#^[a-zA-Z0-9_\-]+\.php(\?[^\s]*)?$#', $redirect)) {
    $redirect = '';
}
$successTarget = $redirect !== '' ? $redirect : 'index.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $registerPage . ($redirect !== '' ? '?redirect=' . rawurlencode($redirect) : ''));
    exit;
}

function backToRegister($errorCode, $name = '', $email = '', $detail = '') {
    global $registerPage, $redirect;
    header('Location: ' . $registerPage . '?error=' . $errorCode
        . '&name=' . urlencode($name) . '&email=' . urlencode($email)
        . ($redirect !== '' ? '&redirect=' . rawurlencode($redirect) : '')
        // TEMPORARY debug aid buat lacak error "Pendaftaran gagal" -- hapus
        // param & blok tampilnya di register.php begitu penyebabnya ketemu.
        . ($detail !== '' ? '&detail=' . urlencode($detail) : ''));
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$passwordConfirm = $_POST['password_confirm'] ?? '';

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    backToRegister('invalid', $name, $email);
}
if (strlen($password) < 6) {
    backToRegister('short', $name, $email);
}
if ($password !== $passwordConfirm) {
    backToRegister('mismatch', $name, $email);
}

// Email harus unik supaya login tidak ambigu.
$checkStmt = mysqli_prepare($koneksi, 'SELECT id_user FROM users WHERE email = ? LIMIT 1');
mysqli_stmt_bind_param($checkStmt, 's', $email);
mysqli_stmt_execute($checkStmt);
$existing = mysqli_fetch_assoc(mysqli_stmt_get_result($checkStmt));
mysqli_stmt_close($checkStmt);
if ($existing) {
    backToRegister('duplicate', $name, $email);
}

$hash = password_hash($password, PASSWORD_DEFAULT);
$role = 'user';

$insertStmt = mysqli_prepare($koneksi, 'INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
mysqli_stmt_bind_param($insertStmt, 'ssss', $name, $email, $hash, $role);
// mysqli default (PHP 8.1+) itu exception mode, jadi execute() gagal = throw,
// bukan return false -- makanya query gagal harus ditangkap di sini juga,
// biar user balik ke form dengan pesan error, bukan nabrak fatal error page.
try {
    $executeOk = mysqli_stmt_execute($insertStmt);
} catch (mysqli_sql_exception $e) {
    error_log('register_user insert failed: ' . $e->getMessage());
    $executeOk = false;
    $insertError = $e->getMessage();
}
if (!$executeOk) {
    mysqli_stmt_close($insertStmt);
    backToRegister('failed', $name, $email, $insertError ?? '');
}
$idUser = mysqli_insert_id($koneksi);
mysqli_stmt_close($insertStmt);

// Langsung login supaya user tidak perlu isi form dua kali.
session_regenerate_id(true);
$_SESSION['id_user'] = (int) $idUser;
$_SESSION['user_name'] = $name;
$_SESSION['user_email'] = $email;
$_SESSION['user_role'] = $role;

header('Location: /company-profile/frontend/public/' . $successTarget);
exit;
?>
