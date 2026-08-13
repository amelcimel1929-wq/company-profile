<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Amelora Collection</title>
    
    <!-- FontAwesome & SB Admin 2 CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- CSS KUSTOM UNTUK TEMA PINK ELEGANT -->
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
        }

        /* 1. Warna Background Sidebar Pink Pastel Soft */
        .bg-gradient-primary {
            background-color: #f5cfdb !important;
            background-image: none !important;
            border-right: 1px solid #f3d5df !important;
        }

        /* 2. Warna Teks Brand / Logo & Penambahan Jarak ke Bawah */
        .sidebar .sidebar-brand {
            color: #69293f !important;
            font-weight: 600 !important;
            padding-top: 2.5rem !important;    /* Menambah jarak atas */
            padding-bottom: 2.5rem !important; /* Menambah jarak bawah */
            margin-bottom: 1rem !important;    /* Memberi spasi ekstra sebelum Dashboard */
        }

        /* 3. Warna Teks Sub-Heading (INTERFACE) */
        .sidebar .sidebar-heading {
            color: #822e4a !important;
            font-weight: 600;
        }

        /* 4. Warna Teks Menu & Ikon */
        .sidebar-dark .nav-item .nav-link {
            color: #761435 !important;
            font-weight: 400;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-dark .nav-item .nav-link i {
            color: #a06d7d !important;
        }

        /* 5. Efek Hover & Menu Aktif */
        .sidebar-dark .nav-item:hover .nav-link,
        .sidebar-dark .nav-item.active .nav-link {
            color: #7d3b52 !important;
            background-color: #fadfe7 !important;
            border-radius: 8px;
            font-weight: 600;
        }

        .sidebar-dark .nav-item:hover .nav-link i,
        .sidebar-dark .nav-item.active .nav-link i {
            color: #583340 !important;
        }

        /* 6. Warna Garis Pembatas (Divider) */
        .sidebar-dark .sidebar-divider {
            border-top: 1px solid #ebd0d9 !important;
        }

        /* 7. Style Tombol Toggle Sidebar */
        #sidebarToggle {
            background-color: #ebd0d9 !important;
        }
        #sidebarToggle::after {
            color: #7d5260 !important;
        }
    </style>
</head>
<body>

    <!-- Sidebar Wrapper Asli SB Admin 2 -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand (Jarak Atas & Bawah Diperluas) -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="sidebar-brand-text mx-3">amelora collection</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Profile -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_profile.php">
                <i class="fas fa-id-card"></i>
                <span>Profile</span>
            </a>
        </li>

        <!-- Nav Item - Produk -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_produk.php">
                <i class="fas fa-box-open"></i>
                <span>Produk</span>
            </a>
        </li>

        <!-- Nav Item - Flash Sale -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_flash_sale.php">
                <i class="fas fa-bolt"></i>
                <span>flash sale</span>
            </a>
        </li>

        <!-- Nav Item - Kategori -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_kategori.php">
                <i class="fas fa-tags"></i>
                <span>kategori</span>
            </a>
        </li>

        <!-- Nav Item - Best Seller -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_bestseller.php">
                <i class="fas fa-star"></i>
                <span>Best Seller</span>
            </a>
        </li>

        <!-- Nav Item - About -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_about.php">
                <i class="fas fa-info-circle"></i>
                <span>about</span>
            </a>
        </li>

        <!-- Nav Item - Owner -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_owner.php">
                <i class="fas fa-crown"></i>
                <span>owner</span>
            </a>
        </li>

        <!-- Nav Item - Contact -->
        <li class="nav-item">
            <a class="nav-link" href="tabel_contact.php">
                <i class="fas fa-envelope"></i>
                <span>Contact</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="tabel_login.php">
                <i class="fas fa-user"></i>
                <span>login</span>
            </a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>

</body>
</html>