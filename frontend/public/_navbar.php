<?php
// Navbar bersama untuk halaman selain index.php (produk.php, dst).
// Disamain persis sama navbar di index.php biar gak keliatan kayak 2 web beda.
// Halaman pemanggil sudah menjalankan session_start().
$navLoggedIn = isset($_SESSION['id_user']);
$navActive = $activePage ?? '';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Sama kayak index.php: 'Playfair Display' dipakai di navbar tapi gak pernah
     di-load, jadi jatuh ke serif bawaan OS tiap komputer. -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm py-3 fixed-top">
    <div class="container">
        <!-- Navbar Brand -->
        <a class="navbar-brand d-inline-flex align-items-center" href="index.php" style="text-decoration: none;">
            <i class="fa-solid fa-bag-shopping fs-3 me-2" style="color: #e83e8c;"></i>
            <span class="fw-bold tracking-wide" style="
                font-family: 'Playfair Display', 'Poppins', serif;
                font-size: 1.25rem;
                color: #2b2b2b;
                letter-spacing: 0.5px;">
                Preloved by<span style="color: #e83e8c; font-style: italic;">Meii</span><span style="color: #e83e8c; font-size: 1rem; margin-left: 2px;">♡</span>
            </span>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item px-2">
                    <a class="nav-link fw-semibold" href="index.php" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">Home</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fw-semibold" href="index.php#about" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">About</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fw-semibold" href="index.php#flash-sale" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">Flash Sale</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fw-semibold" href="produk.php" style="font-family: 'Playfair Display', serif; font-size: 1rem; letter-spacing: 0.5px; <?= $navActive === 'products' ? 'color: #d94f76; font-weight: 700; border-bottom: 2px solid #d94f76;' : 'color: #2b2b2b;' ?>">Produk</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link fw-semibold" href="index.php#owner" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">Owner</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <?php if ($navLoggedIn): ?>
                    <!-- Link Status Pesanan (Ikon User) -->
                    <a class="text-1000" href="status_pesanan.php" title="Status Pesanan">
                        <svg class="feather feather-user me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a>

                    <!-- Link Logout (Ikon Log Out) -->
                    <a class="text-1000" href="logout.php" title="Logout" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
                        <svg class="feather feather-log-out me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </a>
                <?php else: ?>
                    <!-- Belum login: ikon profil, Login & Register muncul lewat dropdown pas diklik -->
                    <div class="dropdown">
                        <button class="btn text-1000 p-0 border-0 bg-transparent" type="button" id="navAccountDropdown" data-bs-toggle="dropdown" aria-expanded="false" title="Akun">
                            <svg class="feather feather-user me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navAccountDropdown" style="font-family: 'Playfair Display', serif;">
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="register.php">Register</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
