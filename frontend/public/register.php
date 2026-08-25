<?php
session_start();
// Sama kayak login.php: bawa balik ke checkout.php abis daftar sukses, kalau
// datangnya dari sana. Divalidasi ketat biar gak jadi open redirect.
$redirect = $_GET['redirect'] ?? '';
if (!preg_match('#^[a-zA-Z0-9_\-]+\.php(\?[^\s]*)?$#', $redirect)) {
    $redirect = '';
}
if (isset($_SESSION['id_user'])) {
    header('Location: ' . ($redirect !== '' ? $redirect : 'index.php'));
    exit;
}

$errors = [
    'invalid'   => 'Nama dan email wajib diisi dengan benar.',
    'short'     => 'Password minimal 6 karakter.',
    'mismatch'  => 'Konfirmasi password tidak sama.',
    'duplicate' => 'Email ini sudah terdaftar. Silakan login.',
    'failed'    => 'Pendaftaran gagal, coba lagi sebentar lagi.',
];
$errorCode = $_GET['error'] ?? '';
$error = $errors[$errorCode] ?? '';
// TEMPORARY debug aid, lihat action_register_user.php -- hapus ini juga
// begitu penyebab "Pendaftaran gagal" ketemu & kefix.
$errorDetail = $_GET['detail'] ?? '';

// Isi ulang form supaya user tidak mengetik dari nol setelah gagal.
$oldName = $_GET['name'] ?? '';
$oldEmail = $_GET['email'] ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
<main class="container py-5" style="max-width: 430px;">
    <section class="card border-0 shadow-sm"><div class="card-body p-4 p-lg-5">
        <h1 class="h3 text-center mb-2">Daftar</h1>
        <p class="text-muted text-center mb-4">Buat akun untuk mulai belanja di preloved bymeii ♡</p>
        <?php if ($error): ?><div class="alert alert-danger"><?= htmlspecialchars($error) ?><?php if ($errorDetail): ?><br><small class="text-muted"><?= htmlspecialchars($errorDetail) ?></small><?php endif; ?></div><?php endif; ?>
        <form action="../../backend/action_register_user.php" method="post">
            <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
            <div class="mb-3"><label for="name" class="form-label">Nama Lengkap</label><input id="name" type="text" name="name" class="form-control" value="<?= htmlspecialchars($oldName) ?>" required autofocus></div>
            <div class="mb-3"><label for="email" class="form-label">Email</label><input id="email" type="email" name="email" class="form-control" value="<?= htmlspecialchars($oldEmail) ?>" required></div>
            <div class="mb-3"><label for="password" class="form-label">Password</label><input id="password" type="password" name="password" class="form-control" minlength="6" required><div class="form-text">Minimal 6 karakter.</div></div>
            <div class="mb-4"><label for="password_confirm" class="form-label">Konfirmasi Password</label><input id="password_confirm" type="password" name="password_confirm" class="form-control" minlength="6" required></div>
            <button class="btn btn-dark w-100" type="submit">Daftar</button>
        </form>
        <p class="text-center text-muted small mt-4 mb-0">Sudah punya akun? <a href="login.php<?= $redirect !== '' ? '?redirect=' . urlencode($redirect) : '' ?>">Login di sini</a></p>
    </div></section>
</main>
</body>
</html>
