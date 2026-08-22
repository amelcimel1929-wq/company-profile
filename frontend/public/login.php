<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header('Location: index.php');
    exit;
}
$error = isset($_GET['error']) ? 'Email atau password tidak sesuai.' : '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
<main class="container" style="max-width: 430px;">
    <section class="card border-0 shadow-sm"><div class="card-body p-4 p-lg-5">
        <h1 class="h3 text-center mb-2">Masuk</h1>
        <p class="text-muted text-center mb-4">Login untuk melihat produk dan membuat pesanan.</p>
        <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <form action="../../backend/action_login_user.php" method="post">
            <div class="mb-3"><label for="email" class="form-label">Email</label><input id="email" type="email" name="email" class="form-control" required autofocus></div>
            <div class="mb-4"><label for="password" class="form-label">Password</label><input id="password" type="password" name="password" class="form-control" required></div>
            <button class="btn btn-dark w-100" type="submit">Login</button>
        </form>
        <p class="text-center text-muted small mt-4 mb-0">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div></section>
</main>
</body>
</html>
