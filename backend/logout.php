<?php
session_start();

// menghapus session login menggunakan session_destroy();
$_SESSION = array();
session_destroy();

// setelah dihapus, akan diarahkan ke page login.php
header("Location:login.php?pesan=logout");
exit;
?>