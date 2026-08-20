<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /company-profile/frontend/public/login.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
    header('Location: /company-profile/frontend/public/login.php?error=1');
    exit;
}

$stmt = mysqli_prepare($koneksi, 'SELECT id_user, name, email, password, role FROM users WHERE email = ? LIMIT 1');
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

// Mendukung password_hash baru dan data password lama yang masih disimpan sebagai teks biasa.
if (!$user || !(password_verify($password, $user['password']) || hash_equals((string) $user['password'], $password))) {
    header('Location: /company-profile/frontend/public/login.php?error=1');
    exit;
}

session_regenerate_id(true);
$_SESSION['id_user'] = (int) $user['id_user'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_role'] = $user['role'];
header('Location: /company-profile/frontend/public/index.php');
exit;
?>
