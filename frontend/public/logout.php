<?php
// logout.php
session_start();

// Hapus semua variabel sesi
$_SESSION = [];

// Hapus cookie sesi jika ada
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), 
        '', 
        time() - 42000, 
        $params['path'], 
        $params['domain'], 
        $params['secure'], 
        $params['httponly']
    );
}

// Hancurkan sesi sepenuhnya
session_destroy();

// Alihkan halaman ke login.php
header('Location: login.php');
exit;
?>