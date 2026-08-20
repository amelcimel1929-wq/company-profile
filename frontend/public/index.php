<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>majestic | Landing, Ecommerce &amp; Business Templatee</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="assets/css/theme.css" rel="stylesheet" />
    <style>
        html { scroll-behavior: smooth; }
        section[id] { scroll-margin-top: 92px; }
        .navbar .nav-link.is-active { color: #d94f76 !important; font-weight: 700 !important; border-bottom: 2px solid #d94f76; }
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
       .img-container {
            position: relative;
            overflow: hidden;
            cursor: pointer; /* Mengubah kursor jadi telunjuk */
        }

        .img-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(232, 62, 140, 0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .img-container:hover .img-overlay {
            opacity: 1;
        }
    </style>

</head>


<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container">
                <!-- Navbar Brand -->
                <a class="navbar-brand d-inline-flex align-items-center" href="#home" style="text-decoration: none;">
                    <!-- Icon Belanja Warna Pink -->
                    <i class="fa-solid fa-bag-shopping fs-3 me-2" style="color: #e83e8c;"></i>
                    
                    <!-- Teks Brand Estetik -->
                    <span class="fw-bold tracking-wide" style="
                        font-family: 'Playfair Display', 'Poppins', serif; 
                        font-size: 1.25rem; 
                        color: #2b2b2b;
                        letter-spacing: 0.5px;">
                        Preloved by<span style="color: #e83e8c; font-style: italic;">Meii</span><span style="color: #e83e8c; font-size: 1rem; margin-left: 2px;">♡</span>
                    </span>
                </a>                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-semibold js-scroll-nav" href="#home" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">Home</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-semibold js-scroll-nav" href="#about" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">About</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-semibold js-scroll-nav" href="#flash-sale" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">Flash Sale</a>
                                </li>
                                <li class="nav-item px-2">
                                    <a class="nav-link fw-semibold js-scroll-nav" href="#categoryWomen" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #2b2b2b; letter-spacing: 0.5px;">Produk</a>
                                </li>
                            </ul>
                    <form class="d-flex">
                        <a class="text-1000" href="#!">
                                        <svg class="feather feather-phone me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg></a>
                                    <a class="text-1000" href="#!">
                                        <svg class="feather feather-shopping-cart me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg></a>
                                    <a class="text-1000" href="#!">
                                        <svg class="feather feather-search me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg></a>
                                    <a class="text-1000" href="status_pesanan.php" title="Status pesanan">
                                        <svg class="feather feather-user me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            </svg></a>
                                    <a class="text-1000" href="logout.php" title="Logout">
                                        <svg class="feather feather-heart me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </a>
                    </form>
                </div>
            </div>
        </nav>
                                     <!--PROFILE LATAR BELAKANG-->
        <!--<section class="py-11 bg-light-gradient border-bottom border-white border-5">
            <div class="bg-holder overlay overlay-light" style="background-image:url(assets/img/gallery/header-bg.png);background-size:cover;">
            </div>
          

            <div class="container">
                <div class="row flex-center">
                    <div class="col-12 mb-10">
                        <div class="d-flex align-items-center flex-column">
                            <h1 class="fw-normal"> With an outstanding style, only for you</h1>
                            <h1 class="fs-4 fs-lg-8 fs-md-6 fw-bold">Exclusively designed for you</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <?php
             // 1. Panggil koneksi ke database dari folder backend
            include "../../backend/connection.php";

            // 2. Ambil data terbaru dari tabel profile
            $query_profile = mysqli_query($koneksi, "SELECT * FROM profile ORDER BY id_profile DESC LIMIT 1");
            $profile = mysqli_fetch_object($query_profile);

            // 3. Tentukan lokasi foto background (menggunakan foto default jika di database kosong)
            $bg_image = "assets/img/gallery/header-bg.png"; // Default background
            if (!empty($profile) && !empty($profile->foto)) {
                 // Jalur foto disesuaikan dengan folder penyimpanan foto kamu di backend
                 $bg_image = "../../backend/foto/" . $profile->foto; 
                }
        ?>

        <!-- SECTION HEADER / PROFILE FRONTEND -->
        <section id="home" class="py-11 bg-light-gradient border-bottom border-white border-5">
            <div class="bg-holder overlay overlay-light" style="background-image:url(<?php echo $bg_image; ?>);background-size:cover;"></div>
            <!--/.bg-holder-->
            <div class="container">
                <div class="row flex-center">
                    <div class="col-12 mb-10">
                        <div class="d-flex align-items-center flex-column text-center">
                            
                            <!-- Sub-heading -->
                            <h1 class="fw-normal" style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #4a4a4a; letter-spacing: 1px;">
                                Old pieces, new vibes.
                            </h1>

                            <!-- Heading Utama (Backend + Warna Pink pada Meii dan simbol hati) -->
                            <h1 class="fs-4 fs-lg-8 fs-md-6 fw-bold mt-2" style="font-family: 'Playfair Display', serif; color: #2b2b2b;">
                                <?php 
                                if (!empty($profile) && !empty($profile->about)) {
                                    $text = htmlspecialchars($profile->about);
                                    
                                    // 1. Ubah kata Meii jadi pink italic
                                    $text = str_ireplace('Meii', '<span style="color: #e83e8c; font-style: italic;">Meii</span>', $text);
                                    
                                    // 2. Ubah simbol hati ♡ jadi warna pink
                                    $text = str_replace('♡', '<span style="color: #e83e8c; font-style: normal;">♡</span>', $text);
                                    
                                    echo $text;
                                } else {
                                    echo 'Exclusively designed for <span style="color: #e83e8c; font-style: italic;">you</span>'; 
                                }
                                ?>
                            </h1>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
            <!--buat for her dan for him-->
        <!--<section class="py-0" id="header" style="margin-top: -23rem !important;">

            <div class="container">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"> <img class="img-fluid" src="assets/img/gallery/her.png" width="790" alt="..." />
                            <div class="card-img-overlay d-flex flex-center"> <a class="btn btn-lg btn-light" href="#!">For Her</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"> <img class="img-fluid" src="assets/img/gallery/him.png" width="790" alt="..." />
                            <div class="card-img-overlay d-flex flex-center"> <a class="btn btn-lg btn-light" href="#!">For Him </a></div>
                        </div>
                    </div>
                </div>
            </div>
         

        </section>-->
        <!--<section>

            <div class="container">
                <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                            <h4 class="text-800">Exclusive collection 2021</h4>
                            <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Be exclusive</h1>
                            <p class="mb-5 fs-1">The best everyday option in a Super Saver range within a reasonable price. It is our responsibility to keep you 100 percent stylish. Be smart &amp; , trendy with us.</p>
                            <div class="d-grid gap-2 d-md-block"><a class="btn btn-lg btn-dark" href="#" role="button">Explore</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/outfit.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">Outfit
                      <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                      </svg></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-100 g-2 py-1">
                    <div class="col-md-4">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/vanity-bag.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">Vanity Bags
                      <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                      </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/hat.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">Hats
                      <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                      </svg></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/high-heels.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">High Heels
                      <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                      </svg></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
       <?php
            // 1. Panggil file koneksi database
            include '../../backend/connection.php';

                // 2. Query ke tabel about (mengambil data dari database company-profile)
                $query_about = mysqli_query($koneksi, "SELECT * FROM about LIMIT 1");
                $data_about  = mysqli_fetch_assoc($query_about);

                // 3. Ambil data dari tabel about
                $nama_brand = $data_about['nama_brand'] ?? '';
                $deskripsi  = $data_about['deskripsi'] ?? '';

                // Menggabungkan folder "foto/" dengan nama file foto dari tabel about
                $foto_about = '../../backend/foto/' . ($data_about['foto'] ?? '');
        ?>

            <section id="about">
                <div class="container py-4">
                    <!-- Outer Wrapper (Lebar Pas & Bingkai Pink Meii #e83e8c) -->
                    <div class="mx-auto overflow-hidden" 
                        style="max-width: 1100px; 
                                border: 3px solid #e83e8c; 
                                border-radius: 16px; 
                                box-shadow: 0 4px 20px rgba(232, 62, 140, 0.15);">
                        
                        <div class="row g-0 align-items-stretch">
                            
                            <!-- KOLOM TEKS (Background Pink Muda Cerah & Pas) -->
                            <div class="col-md-7 p-4 p-lg-5 d-flex flex-column justify-content-center" 
                                style="background-color: #ffe6f0;">
                                
                                <!-- Field nama_brand dengan font Playfair Display & Style Estetik -->
                                <h4 class="fw-bold mb-2" style="font-family: 'Playfair Display', serif; color: #2b2b2b; letter-spacing: 0.5px;">
                                    <?php 
                                    $brand_text = !empty($nama_brand) ? htmlspecialchars($nama_brand) : 'Preloved byMeii♡';
                                    $brand_text = str_ireplace('Meii', '<span style="color: #e83e8c; font-style: italic;">Meii</span>', $brand_text);
                                    $brand_text = str_replace('♡', '<span style="color: #e83e8c; font-style: normal;">♡</span>', $brand_text);
                                    echo $brand_text;
                                    ?>
                                </h4>

                                <h1 class="fw-bold mb-3" style="font-family: 'Playfair Display', serif; color: #2b2b2b; font-size: 2.2rem;">Be exclusive</h1>

                                <!-- Field deskripsi -->
                                <div class="lh-base" style="font-family: 'Playfair Display', serif; color: #2b2b2b; font-size: 0.95rem; text-align: justify;">
                                    <?php 
                                    if (!empty($deskripsi)) {
                                        $desc_text = htmlspecialchars($deskripsi);
                                        $desc_text = str_ireplace('Meii', '<span style="color: #e83e8c; font-style: italic;">Meii</span>', $desc_text);
                                        $desc_text = str_replace('♡', '<span style="color: #e83e8c; font-style: normal;">♡</span>', $desc_text);
                                        echo nl2br($desc_text);
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- KOLOM FOTO (Presisi & Simetris) -->
                            <div class="col-md-5">
                                <div class="h-100 w-100">
                                    <img class="w-100 h-100 object-fit-cover" 
                                        src="<?= htmlspecialchars($foto_about); ?>" 
                                        alt="Foto About" />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--<div class="row h-100 g-2 py-1">
                    <div class="col-md-4">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/vanity-bag.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">Vanity Bags
                                    <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                                    </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/hat.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">Hats
                                    <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                                    </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/high-heels.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="d-flex align-items-end justify-content-center h-100"><a class="btn btn-lg text-light fs-1" href="#!" role="button">High Heels
                                    <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                                    </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
        </div>
        </section>
             <!-- ============================================-->
        <!-- <section> begin ============================-->
        <!--<section class="py-0">

            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mt-7 mb-5">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm">Best Deals</h5>
                    </div>
                    <div class="col-12">
                        <div class="carousel slide" id="carouselBestDeals" data-bs-touch="false" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/flat-hill.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Flat Hill Slingback</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/blue-ring.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Ocean Blue Ring</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wallet.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Brown Leathered Wallet</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wrist-watch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Silverside Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/flat-hill.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Flat Hill Slingback</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/blue-ring.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Ocean Blue Ring</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wallet.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Brown Leathered Wallet</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wrist-watch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Silverside Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/flat-hill.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Flat Hill Slingback</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/blue-ring.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Ocean Blue Ring</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wallet.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Brown Leathered Wallet</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wrist-watch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Silverside Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/flat-hill.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Flat Hill Slingback</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/blue-ring.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Ocean Blue Ring</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wallet.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Brown Leathered Wallet</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/wrist-watch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Silverside Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBestDeals" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBestDeals" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                </div>
            </div>
    

        </section>-->
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <div class="row h-100 align-items-center g-2">

                    <?php
                        include "../../backend/connection.php";

                        $query_flash_sale = mysqli_query(
                        $koneksi, "SELECT * FROM flash_sale");
                        if (!$query_flash_sale) {
                            die("Query gagal: " . mysqli_error($koneksi));
                        }
                   ?>
<section id="flash-sale" class="py-5" style="background-color: #fff0f5;">
    <div class="container">
        <!-- Judul Section -->
        <div class="row">
            <div class="col-lg-7 mx-auto text-center mb-4">
                <h3 class="fw-bold" style="font-family: 'Playfair Display', serif; color: #e83e8c; letter-spacing: 1px;">
                    ⚡ Flash Sale
                </h3>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="carousel slide" id="carouselFlashSale" data-bs-touch="false" data-bs-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row g-3 justify-content-center">
                                
                                <?php 
                                $no = 1;
                                while ($flash = mysqli_fetch_object($query_flash_sale)) { 
                                    $modal_id = "modalFoto" . $no; // ID unik untuk tiap modal
                                ?>
                                    <div class="col-6 col-sm-4 col-md-3">
                                        <div class="card h-100 border-0 shadow-sm overflow-hidden position-relative" 
                                             style="background-color: #ffe6f0; border: 1.5px solid #f9a8d4 !important; border-radius: 12px;">
                                            
                                            <!-- Container Foto (Diklik membuka Modal Full Screen) -->
                                            <div class="img-container ratio ratio-1x1 bg-white" 
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#<?php echo $modal_id; ?>">
                                                
                                                <img src="../../backend/foto/<?php echo $flash->foto; ?>" 
                                                     class="card-img-top object-fit-cover w-100 h-100" 
                                                     alt="<?php echo htmlspecialchars($flash->nama_produk); ?>">
                                                
                                                <!-- Overlay Hover -->
                                                <div class="img-overlay text-white fw-bold">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-eye-fill mb-1" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                    <span style="font-size: 0.85rem; font-family: 'Poppins', sans-serif;">Lihat Detail</span>
                                                </div>
                                            </div>

                                            <!-- Informasi Produk -->
                                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                                <h6 class="card-title text-truncate mb-2" 
                                                    style="font-family: 'Playfair Display', serif; color: #2b2b2b; font-size: 0.95rem;" 
                                                    title="<?php echo htmlspecialchars($flash->nama_produk); ?>">
                                                    <?php echo $flash->nama_produk; ?>
                                                </h6>

                                                <div>
                                                    <div class="text-muted small text-decoration-line-through mb-1" style="font-size: 0.8rem;">
                                                        Rp <?php echo number_format($flash->harga_awal, 0, ',', '.'); ?>
                                                    </div>
                                                    <div class="fw-bold" style="color: #e83e8c; font-size: 1.05rem;">
                                                        Rp <?php echo number_format($flash->harga_akhir, 0, ',', '.'); ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- MODAL POPUP (Tampil Foto Full) -->
                                    <div class="modal fade" id="<?php echo $modal_id; ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content border-0" style="background-color: transparent;">
                                                <div class="modal-body text-center p-0 position-relative">
                                                    <!-- Tombol Close -->
                                                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                                                    
                                                    <!-- Foto Full Tanpa Terpotong -->
                                                    <img src="../../backend/foto/<?php echo $flash->foto; ?>" 
                                                         class="img-fluid rounded-3 shadow-lg" 
                                                         style="max-height: 85vh; object-fit: contain;" 
                                                         alt="<?php echo htmlspecialchars($flash->nama_produk); ?>">
                                                    
                                                    <div class="mt-2 text-white fw-bold fs-5" style="font-family: 'Playfair Display', serif;">
                                                        <?php echo $flash->nama_produk; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php 
                                    $no++;
                                } 
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
                </div>
            </div>
        </div>
        
        
        <!-- <section> close ============================-->
        <!-- ============================================-->


        <!--<section class="py-0">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fs-3 fs-lg-5 lh-sm mb-3">Checkout New Arrivals</h5>
                    </div>
                    <div class="col-12">
                        <div class="carousel slide" id="carouselNewArrivals" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/full-body.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Flat Hill Slingback</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/formal-coat.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Ocean Blue Ring</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/ocean-blue.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Brown Leathered Wallet</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/sweater.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Silverside Wristwatch</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/full-body.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Flat Hill Slingback</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/formal-coat.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Ocean Blue Ring</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/ocean-blue.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Brown Leathered Wallet</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/sweater.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Silverside Wristwatch</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/full-body.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Flat Hill Slingback</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/formal-coat.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Ocean Blue Ring</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/ocean-blue.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Brown Leathered Wallet</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/sweater.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Silverside Wristwatch</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/full-body.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Flat Hill Slingback</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/formal-coat.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Ocean Blue Ring</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/ocean-blue.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Brown Leathered Wallet</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/sweater.png" alt="..." />
                                                <div class="card-img-overlay bg-dark-gradient d-flex flex-column-reverse">
                                                    <h6 class="text-primary">$175</h6>
                                                    <p class="text-400 fs-1">Jumper set for Women</p>
                                                    <h4 class="text-light">Silverside Wristwatch</h4>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselNewArrivals" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselNewArrivals" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <!--<section id="categoryWomen">
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Shop By Category</h5>
                    </div>
                    <div class="col-12">
                        <nav>
                            <div class="nav nav-tabs majestic-tabs mb-4 justify-content-center" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-women-tab" data-bs-toggle="tab" data-bs-target="#nav-women" type="button" role="tab" aria-controls="nav-women" aria-selected="true">For Women</button>
                                <button class="nav-link" id="nav-men-tab" data-bs-toggle="tab" data-bs-target="#nav-men" type="button" role="tab" aria-controls="nav-men" aria-selected="false">For Men</button>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-women" role="tabpanel" aria-labelledby="nav-women-tab">
                                    <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab-women" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-wtshirt-tab" data-bs-toggle="pill" data-bs-target="#pills-wtshirt" type="button" role="tab" aria-controls="pills-wtshirt" aria-selected="true">T-Shirt</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-dresses-tab" data-bs-toggle="pill" data-bs-target="#pills-dresses" type="button" role="tab" aria-controls="pills-dresses" aria-selected="false">Shirt</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-wshoes-tab" data-bs-toggle="pill" data-bs-target="#pills-wshoes" type="button" role="tab" aria-controls="pills-wshoes" aria-selected="false">Shoes</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-wwatch-tab" data-bs-toggle="pill" data-bs-target="#pills-wwatch" type="button" role="tab" aria-controls="pills-wwatch" aria-selected="false">Watch </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-wsunglasses-tab" data-bs-toggle="pill" data-bs-target="#pills-wsunglasses" type="button" role="tab" aria-controls="pills-wsunglasses" aria-selected="false">Sunglasses </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-wbagpacks-tab" data-bs-toggle="pill" data-bs-target="#pills-wbagpacks" type="button" role="tab" aria-controls="pills-wbagpacks" aria-selected="false">Bagpacks </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContentWomen">
                                        <div class="tab-pane fade" id="pills-dresses" role="tabpanel" aria-labelledby="pills-dresses-tab">
                                            <div class="carousel slide" id="carouselCategoryDresses" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryDresses" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryDresses" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade show active" id="pills-wtshirt" role="tabpanel" aria-labelledby="pills-wtshirt-tab">
                                            <div class="carousel slide" id="carouselCategoryWTshirt" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/red-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Red T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/pink-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Pink T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/orange-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Orange T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/purple-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Purple T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/red-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Red T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/pink-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Pink T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/orange-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Orange T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/purple-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Purple T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/red-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Red T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/pink-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Pink T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/orange-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Orange T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/purple-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Purple T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/red-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Red T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/pink-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Pink T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/orange-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Orange T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/purple-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Purple T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryWTshirt" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryWTshirt" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-wshoes" role="tabpanel" aria-labelledby="pills-wshoes-tab">
                                            <div class="carousel slide" id="carouselCategoryWShoes" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryWShoes" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryWShoes" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-wwatch" role="tabpanel" aria-labelledby="pills-wwatch-tab">
                                            <div class="carousel slide" id="carouselCategoryWwatch" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryWwatch" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryWwatch" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-wsunglasses" role="tabpanel" aria-labelledby="pills-wsunglasses-tab">
                                            <div class="carousel slide" id="carouselCategoryWSunglasses" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryWSunglasses" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryWSunglasses" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-wbagpacks" role="tabpanel" aria-labelledby="pills-wbagpacks-tab">
                                            <div class="carousel slide" id="carouselCategoryWBagpacks" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-1.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-2.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-3.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-4.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryWBagpacks" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryWBagpacks" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-men" role="tabpanel" aria-labelledby="nav-men-tab">
                                    <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab-men" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-tshirt-tab" data-bs-toggle="pill" data-bs-target="#pills-tshirt" type="button" role="tab" aria-controls="pills-tshirt" aria-selected="true">T-Shirt</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-shirt-tab" data-bs-toggle="pill" data-bs-target="#pills-shirt" type="button" role="tab" aria-controls="pills-shirt" aria-selected="false">Shirt</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-shoes-tab" data-bs-toggle="pill" data-bs-target="#pills-shoes" type="button" role="tab" aria-controls="pills-shoes" aria-selected="false">Shoes</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-watch-tab" data-bs-toggle="pill" data-bs-target="#pills-watch" type="button" role="tab" aria-controls="pills-watch" aria-selected="false">Watch </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-sunglasses-tab" data-bs-toggle="pill" data-bs-target="#pills-sunglasses" type="button" role="tab" aria-controls="pills-sunglasses" aria-selected="false">Sunglasses </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-bagpacks-tab" data-bs-toggle="pill" data-bs-target="#pills-bagpacks" type="button" role="tab" aria-controls="pills-bagpacks" aria-selected="false">Bagpacks </button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContentMen">
                                        <div class="tab-pane fade show active" id="pills-tshirt" role="tabpanel" aria-labelledby="pills-tshirt-tab">
                                            <div class="carousel slide" id="carouselCategoryTshirt" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/white-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sky-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sky T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/yellow-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Yellow T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/black-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/white-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sky-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sky T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/yellow-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Yellow T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/black-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/white-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sky-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sky T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/yellow-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Yellow T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/black-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/white-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sky-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sky T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/yellow-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Yellow T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/black-tshirt.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black T-Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryTshirt" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryTshirt" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-shirt" role="tabpanel" aria-labelledby="pills-shirt-tab">
                                            <div class="carousel slide" id="carouselCategoryShirt" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Gray Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">White Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shirt-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Black Shirt</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryShirt" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryShirt" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-shoes" role="tabpanel" aria-labelledby="pills-shoes-tab">
                                            <div class="carousel slide" id="carouselCategoryShoes" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$200</span><span class="text-primary">$175</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/shoe-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Shoe</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryShoes" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryShoes" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-watch" role="tabpanel" aria-labelledby="pills-watch-tab">
                                            <div class="carousel slide" id="carouselCategoryWatch" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/watch-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Watch</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryWatch" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryWatch" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-sunglasses" role="tabpanel" aria-labelledby="pills-sunglasses-tab">
                                            <div class="carousel slide" id="carouselCategorySunglasses" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/sunglass-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Sunglass</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategorySunglasses" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategorySunglasses" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-bagpacks" role="tabpanel" aria-labelledby="pills-bagpacks-tab">
                                            <div class="carousel slide" id="carouselCategoryBagpacks" data-bs-touch="false" data-bs-interval="false">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active" data-bs-interval="10000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="5000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item" data-bs-interval="3000">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="carousel-item">
                                                        <div class="row h-100 align-items-center g-2">
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-5.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-6.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-7.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                                                <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/bagpacks-8.png" alt="..." />
                                                                    <div class="card-img-overlay ps-0"> </div>
                                                                    <div class="card-body ps-0 bg-200">
                                                                        <h5 class="fw-bold text-1000 text-truncate">Bagpacks</h5>
                                                                        <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$500</span><span class="text-primary">$275</span></div>
                                                                    </div>
                                                                    <a class="stretched-link" href="#"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCategoryBagpacks" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselCategoryBagpacks" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-dark" href="#!">View All </a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </section>-->
        <section id="categoryWomen">
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-7 mx-auto text-center mb-6">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Shop By Category</h5>
            </div>
            <div class="col-12">
                <?php
                require "../../backend/connection.php";
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM categories ORDER BY FIELD(LOWER(name_kategori), 'kemeja', 'dress'), name_kategori");
                ?>

                <!-- Tab Kategori -->
                <ul class="nav nav-pills justify-content-center mb-5" id="pills-tab-kategori" role="tablist">
                    <?php $i = 0; while ($kat = mysqli_fetch_assoc($query_kategori)): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?= $i == 0 ? 'active' : '' ?>"
                                    id="pills-kat<?= $kat['id_category'] ?>-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-kat<?= $kat['id_category'] ?>"
                                    type="button" role="tab">
                                <?= htmlspecialchars($kat['name_kategori']) ?>
                            </button>
                        </li>
                    <?php $i++; endwhile; ?>
                </ul>

                <!-- Isi Tab -->
                <div class="tab-content" id="pills-tabContentKategori">
                    <?php
                    $query_kategori2 = mysqli_query($koneksi, "SELECT * FROM categories ORDER BY FIELD(LOWER(name_kategori), 'kemeja', 'dress'), name_kategori");
                    $i = 0;
                    while ($kat = mysqli_fetch_assoc($query_kategori2)):
                        $id_kat = $kat['id_category'];
                    ?>
                        <div class="tab-pane fade <?= $i == 0 ? 'show active' : '' ?>"
                             id="pills-kat<?= $id_kat ?>" role="tabpanel">

                            <div class="carousel slide" id="carouselKat<?= $id_kat ?>" data-bs-touch="false" data-bs-interval="false">
                                <div class="carousel-inner">
                                    <?php
                                    $query_produk = mysqli_query($koneksi,
                                        "SELECT * FROM products WHERE id_category = '$id_kat' ORDER BY id_product DESC"
                                    );

                                    $per_slide = 4;
                                    $index = 0;

                                    while ($produk = mysqli_fetch_assoc($query_produk)):
                                        if ($index % $per_slide == 0) {
                                            if ($index != 0) {
                                                echo '</div></div>';
                                            }
                                            $active = ($index == 0) ? 'active' : '';
                                            echo '<div class="carousel-item ' . $active . '">';
                                            echo '<div class="row h-100 align-items-center g-2">';
                                        }
                                    ?>
                                        <div class="col-sm-6 col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white">
                                                <img class="img-fluid h-100"
                                                     src="../../backend/foto/<?= rawurlencode($produk['image']) ?>"
                                                     alt="<?= htmlspecialchars($produk['name_product']) ?>" />
                                                <div class="card-img-overlay ps-0"></div>
                                      <div class="card-body ps-0 bg-200">
   <div class="card-body">
    <h5 class="fw-bold text-1000 text-truncate">
        <?= htmlspecialchars($produk['name_product']) ?>
    </h5>
    <div class="fw-bold mb-2">
        <span class="text-primary">
            Rp<?= number_format((float)$produk['price'], 0, ',', '.') ?>
        </span>
    </div>
    
    <!-- URL diperbaiki dengan urlencode untuk memastikan parameter ID terbaca -->
    <a href="checkout.php?id_product=<?= urlencode($produk['id_product']) ?>" 
       class="btn btn-dark btn-sm w-100 position-relative" 
       style="z-index: 2;">
        Pesan Sekarang
    </a>
</div>
                                                <a class="stretched-link" href="checkout.php?id_product=<?= $produk['id_product'] ?>"></a>
                                            </div>
                                        </div>
                                    <?php
                                        $index++;
                                    endwhile;

                                    if ($index > 0) {
                                        echo '</div></div>';
                                    } else {
                                        echo '<p class="text-center py-4">Belum ada produk di kategori ini.</p>';
                                    }
                                    ?>

                                    <?php if ($index > 0): ?>
                                    <div class="row">
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselKat<?= $id_kat ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselKat<?= $id_kat ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-center mt-5">
                                <a class="btn btn-lg btn-dark" href="produk.php?id_category=<?= $id_kat ?>">View All</a>
                            </div>
                        </div>
                    <?php $i++; endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</section>



        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <!--<section>

            <div class="container">
                <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="bg-300 p-4 h-100 d-flex flex-column justify-content-center">
                            <h1 class="fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Gentle Formal Looks </h1>
                            <p class="mb-5 fs-1">We provide the top formal apparel package to make your job look confident and comfortable. Stay connect.</p>
                            <div class="d-grid gap-2 d-md-block"><a class="btn btn-lg btn-dark" href="#!" role="button">Explore Collection</a></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/sharp-dress.png" alt="..." />
                            <a class="stretched-link" href="#!"></a>
                        </div>
                    </div>
                </div>
            </div>
           

        </section>-->
        <?php
            // Pastikan koneksi database sudah terhubung
            require "../../backend/connection.php"; 

            // Query untuk mengambil data owner terbaru
            $query_owner = mysqli_query($koneksi, "SELECT * FROM owner ORDER BY id_owner DESC LIMIT 1");
            $data_owner  = mysqli_fetch_assoc($query_owner);
        ?>
<section class="py-5">
    <div class="container">
        <div class="row g-0 align-items-stretch">
            
            <!-- Kolom Teks (Kiri) -->
            <div class="col-md-6 d-flex flex-column justify-content-center p-4 p-lg-5" style="background-color: #f3f4f6;">
                <h6 class="fw-bold text-uppercase mb-2" style="color: #4b5563; font-size: 0.9rem;">Preloved byMeii</h6>
                <h1 class="fw-bold mb-3" style="color: #111827; font-size: 2.2rem;">Be exclusive</h1>
                
                <div class="lh-base" style="color: #374151; font-size: 0.95rem; text-align: justify;">
                    <?php echo !empty($data_owner['deskripsi']) ? nl2br(htmlspecialchars($data_owner['deskripsi'])) : 'Deskripsi belum diisi.'; ?>
                </div>
            </div>

            <!-- Kolom Foto (Kanan) -->
            <div class="col-md-6">
                <div class="h-100 w-100 overflow-hidden" style="max-height: 520px;">
                    <img class="w-100 h-100 object-fit-cover" 
                         src="<?php echo !empty($data_owner['foto']) ? '../../backend/foto/' . htmlspecialchars($data_owner['foto']) : 'assets/img/gallery/sharp-dress.png'; ?>" 
                         alt="Owner Image" />
                </div>
            </div>

        </div>
    </div>
</section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <!--<section class="py-0" id="collection">

            <div class="container">
                <div class="row h-100 gx-2">
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/urban.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="p-5 p-md-2 p-xl-5">
                                    <h1 class="fs-md-4 fs-lg-7 text-light">Urban Stories </h1>
                                    <h5 class="fs-2 text-light">collection</h5>
                                </div>
                            </div>
                            <a class="stretched-link" href="#!"></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/country.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient">
                                <div class="p-5 p-md-2 p-xl-5 d-flex flex-column flex-end-center align-items-baseline h-100">
                                    <h1 class="fs-md-4 fs-lg-7 text-light">Urban Stories </h1>
                                    <h5 class="fs-2 text-light">collection</h5>
                                </div>
                            </div>
                            <a class="stretched-link" href="#!"></a>
                        </div>
                    </div>
                </div>
            </div>
        

        </section>-->
        <!-- <section> close ============================-->
        <!-- ============================================-->


        <!--<section>
            <div class="container">
                <div class="row h-100">
                    <div class="col-lg-7 mx-auto text-center mb-6">
                        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Best Sellers</h5>
                    </div>
                    <div class="col-12">
                        <div class="carousel slide" id="carouselBestSellers" data-bs-touch="false" data-bs-interval="false">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/handbag.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Marie Claire Handbag</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$399</span><span class="text-danger">$365</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/earrings.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red Gem Earrings</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$489</span><span class="text-danger">$466</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/lathered-wristwatch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Black Leathered Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$799</span><span class="text-danger">$745</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/tie.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red-White Stripped Tie</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$299</span><span class="text-danger">$243</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/handbag.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Marie Claire Handbag</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$399</span><span class="text-danger">$365</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/earrings.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red Gem Earrings</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$489</span><span class="text-danger">$466</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/lathered-wristwatch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Black Leathered Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$799</span><span class="text-danger">$745</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/tie.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red-White Stripped Tie</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$299</span><span class="text-danger">$243</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/handbag.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Marie Claire Handbag</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$399</span><span class="text-danger">$365</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/earrings.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red Gem Earrings</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$489</span><span class="text-danger">$466</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/lathered-wristwatch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Black Leathered Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$799</span><span class="text-danger">$745</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/tie.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red-White Stripped Tie</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$299</span><span class="text-danger">$243</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/handbag.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Marie Claire Handbag</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$399</span><span class="text-danger">$365</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/earrings.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red Gem Earrings</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$489</span><span class="text-danger">$466</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/lathered-wristwatch.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Black Leathered Wristwatch</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$799</span><span class="text-danger">$745</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3 mb-md-0 h-100">
                                            <div class="card card-span h-100 text-white"><img class="img-fluid h-100" src="assets/img/gallery/tie.png" alt="..." />
                                                <div class="card-img-overlay ps-0"> </div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">Red-White Stripped Tie</h5>
                                                    <div class="fw-bold"><span class="text-600 me-2 text-decoration-line-through">$299</span><span class="text-danger">$243</span></div>
                                                </div>
                                                <a class="stretched-link" href="#"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBestSellers" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselBestSellers" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <!--<section class="py-0" id="outlet">

            <div class="container">
                <div class="row h-100 g-0">
                    <div class="col-md-6">
                        <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/summer.png" alt="..." />
                            <div class="card-img-overlay bg-dark-gradient rounded-0">
                                <div class="p-5 p-md-2 p-xl-5 d-flex flex-column flex-end-center align-items-baseline h-100">
                                    <h1 class="fs-md-4 fs-lg-7 text-light">Summer of '21 </h1>
                                </div>
                            </div>
                            <a class="stretched-link" href="#!"></a>
                        </div>
                    </div>
                    <div class="col-md-6 h-100">
                        <div class="row h-100 g-0">
                            <div class="col-md-6 h-100">
                                <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/sunglasses.png" alt="..." />
                                    <div class="card-img-overlay bg-dark-gradient rounded-0">
                                        <div class="p-5 p-xl-5 p-md-0">
                                            <h3 class="text-light">Sunglasses</h3>
                                        </div>
                                    </div>
                                    <a class="stretched-link" href="#!"></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/footwear.png" alt="..." />
                                    <div class="card-img-overlay bg-dark-gradient rounded-0">
                                        <div class="p-5 p-xl-5 p-md-0">
                                            <h3 class="text-light">Footwear</h3>
                                        </div>
                                    </div>
                                    <a class="stretched-link" href="#!"></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/hat-black-border.png" alt="..." />
                                    <div class="card-img-overlay bg-dark-gradient rounded-0">
                                        <div class="p-5 p-xl-5 p-md-0">
                                            <h3 class="text-light">Hat</h3>
                                        </div>
                                    </div>
                                    <a class="stretched-link" href="#!"></a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-span h-100 text-white"><img class="card-img h-100" src="assets/img/gallery/watches.png" alt="..." />
                                    <div class="card-img-overlay bg-dark-gradient rounded-0">
                                        <div class="p-5 p-xl-5 p-md-0">
                                            <h3 class="text-light">Watches</h3>
                                        </div>
                                    </div>
                                    <a class="stretched-link" href="#!"> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         

        </section>-->
        <!-- <section> close ============================-->
        <!-- ============================================-->







        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 pb-8">

            <div class="container-fluid container-lg">
                <div class="row h-100 g-2 justify-content-center">
                    <div class="col-sm-9 col-md-4 mb-3 mb-md-0 h-100">
                        <div class="card card-span text-white h-100"><img class="img-card h-100" src="assets/img/gallery/shoes-blog-1.png" alt="..." />
                            <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                                <div class="d-flex justify-content-between align-items-center bg-100 mt-n5 me-auto"><img src="assets/img/gallery/author-1.png" width="60" alt="..." />
                                    <div class="d-flex flex-1 justify-content-around"> <span class="text-900 text-center"><i data-feather="eye"> </i><span class="text-900 ms-2">35</span></span><span class="text-900 text-center"><i data-feather="heart"> </i><span class="text-900 ms-2">23</span></span>
                                        <span
                                            class="text-900 text-center"><i data-feather="corner-up-right"> </i><span class="text-900 ms-2">14</span></span>
                                    </div>
                                </div>
                                <h6 class="text-900 mt-3">Kelly Hudson . <span class="fw-normal">Fashion actiKelly Hudson . </span></h6>
                                <h3 class="fw-bold text-1000 mt-5 text-truncate">How important are shoes in your style?</h3>
                                <p class="text-900 mt-3">Is it possible to assess a person just on the basis of their footwear? Obviously, nobody should criticize, but certainly, shoes say a lot about someone. It matters for the outsiders that we meet every day...</p><a class="btn btn-lg text-900 fs-1 px-0 hvr-icon-forward"
                                    href="#!" role="button">Read more
                    <svg class="bi bi-arrow-right-short hover-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-4 mb-3 mb-md-0 h-100">
                        <div class="card card-span text-white h-100"><img class="img-card h-100" src="assets/img/gallery/fashion-blog-2.png" alt="..." />
                            <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                                <div class="d-flex justify-content-between align-items-center bg-100 mt-n5 me-auto"><img src="assets/img/gallery/author-2.png" width="60" alt="..." />
                                    <div class="d-flex flex-1 justify-content-around"> <span class="text-900 text-center"><i data-feather="eye"> </i><span class="text-900 ms-2">35</span></span><span class="text-900 text-center"><i data-feather="heart"> </i><span class="text-900 ms-2">23</span></span>
                                        <span
                                            class="text-900 text-center"><i data-feather="corner-up-right"> </i><span class="text-900 ms-2">14</span></span>
                                    </div>
                                </div>
                                <h6 class="text-900 mt-3">Rotondwa Johnny . <span class="fw-normal">Fashion activist </span></h6>
                                <h3 class="fw-bold text-1000 mt-5 text-truncate">Fashion trend forecast for Summer 2021</h3>
                                <p class="text-900 mt-3">While the fashion industry has had a calm year, this season has seen some beautiful pieces. Over the previous several weeks, commanding coats, and elegant face masks have ruled Fashion Weeks...</p><a class="btn btn-lg text-900 fs-1 px-0 hvr-icon-forward"
                                    href="#!" role="button">Read more
                    <svg class="bi bi-arrow-right-short hover-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-9 col-md-4 mb-3 mb-md-0 h-100">
                        <div class="card card-span text-white h-100"><img class="img-card h-100" src="assets/img/gallery/spring-dress-blog-3.png" alt="..." />
                            <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                                <div class="d-flex justify-content-between align-items-center bg-100 mt-n5 me-auto"><img src="assets/img/gallery/author-3.png" width="60" alt="..." />
                                    <div class="d-flex flex-1 justify-content-around"> <span class="text-900 text-center"><i data-feather="eye"> </i><span class="text-900 ms-2">35</span></span><span class="text-900 text-center"><i data-feather="heart"> </i><span class="text-900 ms-2">23</span></span>
                                        <span
                                            class="text-900 text-center"><i data-feather="corner-up-right"> </i><span class="text-900 ms-2">14</span></span>
                                    </div>
                                </div>
                                <h6 class="text-900 mt-3">Martin . <span class="fw-normal">Fashion activist </span></h6>
                                <h3 class="fw-bold text-1000 mt-5 text-truncate">Spring exclusive collection for Men &amp; Women</h3>
                                <p class="text-900 mt-3">Explore the first real-time photographic fashion magazine NOWFASHION to broadcast exclusive live fashion shows. Some of the most beautiful spring collection i want to share. See the....</p><a class="btn btn-lg text-900 fs-1 px-0 hvr-icon-forward"
                                    href="#!" role="button">Read more
                    <svg class="bi bi-arrow-right-short hover-icon" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                    </svg></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


        <section class="py-11">
            <div class="bg-holder overlay overlay-0" style="background-image:url(assets/img/gallery/cta.png);background-position:center;background-size:cover;">
            </div>
            <!--/.bg-holder-->

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="carousel slide carousel-fade" id="carouseCta" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active" data-bs-interval="10000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-12">
                                            <div class="text-light text-center py-2">
                                                <h5 class="display-4 fw-normal text-400 fw-normal mb-4">visit our Outlets in</h5>
                                                <h1 class="display-1 text-white fw-normal mb-8">London</h1><a class="btn btn-lg text-light fs-1" href="#!" role="button">See Addresses
                            <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                            </svg></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-12">
                                            <div class="text-light text-center py-2">
                                                <h5 class="display-4 fw-normal text-400 fw-normal mb-4">visit our Outlets in</h5>
                                                <h1 class="display-1 text-white fw-normal mb-8">Bristol</h1><a class="btn btn-lg text-light fs-1" href="#!" role="button">See Addresses
                            <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                            </svg></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item" data-bs-interval="3000">
                                    <div class="row h-100 align-items-center g-2">
                                        <div class="col-12">
                                            <div class="text-light text-center py-2">
                                                <h5 class="display-4 fw-normal text-400 fw-normal mb-4">visit our Outlets in</h5>
                                                <h1 class="display-1 text-white fw-normal mb-8">Birmingham</h1><a class="btn btn-lg text-light fs-1" href="#!" role="button">See Addresses
                            <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                            </svg></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouseCta" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouseCta" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next </span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 pt-7">

            <div class="container">
                <div class="row">
                    <div class="col-6 col-lg-2 mb-3">
                        <h5 class="lh-lg fw-bold text-1000">Company Info</h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">About Us</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Affiliate</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Fashion Blogger</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-2 mb-3">
                        <h5 class="lh-lg fw-bold text-1000">Help &amp; Support</h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Shipping Info</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Refunds</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">How to Order</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">How to Track</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Size Guides</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-lg-2 mb-3">
                        <h5 class="lh-lg fw-bold text-1000">Customer Care</h5>
                        <ul class="list-unstyled mb-md-4 mb-lg-0">
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Contact Us</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Payment Methods</a></li>
                            <li class="lh-lg"><a class="text-800 text-decoration-none" href="#!">Bonus Point</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-lg-auto ms-auto">
                        <h5 class="lh-lg fw-bold text-1000">Signup For The Latest News</h5>
                        <div class="row input-group-icon mb-5">
                            <div class="col-12">
                                <input class="form-control input-box" type="email" placeholder="Enter Email" aria-label="email" />
                                <svg class="bi bi-arrow-right-short input-box-icon" xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="#424242" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"> </path>
                  </svg>
                            </div>
                        </div>
                        <p class="text-800">
                            <svg class="feather feather-phone me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg><span class="text-800">+3930219390</span>
                        </p>
                        <p class="text-800">
                            <svg class="feather feather-mail me-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                  <polyline points="22,6 12,13 2,6"></polyline>
                </svg><span class="text-800">something@gmail.com</span>
                        </p>
                    </div>
                </div>
                <div class="border-bottom border-3"></div>
                <div class="row flex-center my-3">
                    <div class="col-md-6 order-1 order-md-0">
                        <p class="my-2 text-1000 text-center text-md-start"> Made with&nbsp;
                            <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="#EB6453" viewBox="0 0 16 16">
                  <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                </svg>&nbsp;by&nbsp;<a class="text-800" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="text-center text-md-end"><a href="#!"><span class="me-4" data-feather="facebook"></span></a>
                            <a href="#!"> <span class="me-4" data-feather="instagram"></span></a>
                            <a href="#!"> <span class="me-4" data-feather="youtube"></span></a>
                            <a href="#!"> <span class="me-4" data-feather="twitter"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end of .container-->

        </section>
        <!-- <section> close ============================-->
        <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/feather-icons/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
    <script>
        (() => {
            const links = [...document.querySelectorAll('.js-scroll-nav')];
            const sections = links.map(link => document.querySelector(link.getAttribute('href'))).filter(Boolean);
            const activate = (id) => links.forEach(link => link.classList.toggle('is-active', link.getAttribute('href') === '#' + id));

            const observer = new IntersectionObserver((entries) => {
                const visible = entries.filter(entry => entry.isIntersecting).sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];
                if (visible) activate(visible.target.id);
            }, { rootMargin: '-35% 0px -55% 0px', threshold: [0.05, 0.2, 0.5] });

            sections.forEach(section => observer.observe(section));
            links.forEach(link => link.addEventListener('click', () => activate(link.getAttribute('href').slice(1))));
            activate((location.hash || '#home').slice(1));
        })();
    </script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
</body>

</html>
