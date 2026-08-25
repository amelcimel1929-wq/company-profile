<?php
    require "../../backend/connection.php";
    // Tanpa LIMIT agar menampilkan SEMUA ulasan
    $query_semua_ulasan = mysqli_query($koneksi, "SELECT r.rating, r.review, r.photo, r.create_at,
                                                       u.name AS reviewer_name, p.name_product, p.image AS product_image
                                                FROM product_reviews r
                                                JOIN users u ON u.id_user = r.id_user
                                                JOIN products p ON p.id_product = r.id_product
                                                ORDER BY r.id_review DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Ulasan Pelanggan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body style="background-color: #fdf3f7;">

<div class="container py-5">
    <!-- Header & Tombol Kembali Tanpa Scroll -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold" style="font-family: 'Playfair Display', serif; color: #2b2b2b;">Semua Ulasan Pelanggan</h3>
            <p class="text-muted small mb-0">Ulasan asli dari pembeli yang udah nerima produknya.</p>
        </div>
        
        <!-- Kembali menggunakan riwayat browser -->
        <a href="javascript:history.back()" 
           class="btn btn-outline-dark btn-sm" 
           style="border-radius:20px; padding: 6px 18px;">
           Kembali
        </a>
    </div>

    <!-- Grid Semua Ulasan -->
    <div class="row g-2">
        <?php 
        $ulasanNo = 0;
        if ($query_semua_ulasan && mysqli_num_rows($query_semua_ulasan) > 0):
            while ($ulasan = mysqli_fetch_assoc($query_semua_ulasan)): 
                $ulasanNo++;
        ?>
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm p-3 d-flex flex-column" style="border-radius: 12px;">
                    
                    <!-- Header Produk -->
                    <div class="d-flex gap-2 align-items-center mb-2 pb-2 border-bottom">
                        <?php 
                        $imgProductPath = "../../backend/foto/" . $ulasan['product_image'];
                        if (!empty($ulasan['product_image']) && file_exists($imgProductPath)): 
                        ?>
                            <img src="../../backend/foto/<?= rawurlencode($ulasan['product_image']) ?>" 
                                 alt="<?= htmlspecialchars($ulasan['name_product']) ?>" 
                                 width="44" height="44" class="rounded flex-shrink-0" 
                                 style="object-fit:cover; border:1px solid #f9a8d4; cursor:pointer;"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#ulasanProductModal<?= $ulasanNo ?>">

                            <!-- Modal Foto Produk -->
                            <div class="modal fade" id="ulasanProductModal<?= $ulasanNo ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content bg-transparent border-0 position-relative">
                                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        <div class="text-center p-2" data-bs-dismiss="modal" style="cursor:pointer;">
                                            <img src="../../backend/foto/<?= rawurlencode($ulasan['product_image']) ?>" alt="<?= htmlspecialchars($ulasan['name_product']) ?>" class="img-fluid rounded shadow">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="fw-semibold small text-break" style="font-family: 'Playfair Display', serif; color: #2b2b2b; font-size: 0.8rem;">
                            <?= htmlspecialchars($ulasan['name_product']) ?>
                        </div>
                    </div>

                    <!-- Reviewer & Rating -->
                    <div class="fw-semibold small mb-1" style="font-size: 0.8rem;"><?= htmlspecialchars($ulasan['reviewer_name']) ?></div>
                    <div style="color:#f8b400; font-size: 0.75rem;" class="mb-1">
                        <?= str_repeat('★', (int) $ulasan['rating']) . str_repeat('☆', 5 - (int) $ulasan['rating']) ?>
                    </div>
                    <p class="small text-muted mb-2 flex-grow-1" style="font-family: 'Poppins', sans-serif; font-size: 0.75rem;">
                        <?= nl2br(htmlspecialchars($ulasan['review'])) ?>
                    </p>

                    <!-- Foto Ulasan Pelanggan -->
                    <?php 
                    $imgPhotoPath = "../../backend/foto/" . $ulasan['photo'];
                    if (!empty($ulasan['photo']) && file_exists($imgPhotoPath)): 
                    ?>
                        <div class="mt-auto">
                            <img src="../../backend/foto/<?= rawurlencode($ulasan['photo']) ?>" 
                                 alt="Foto ulasan" class="rounded" width="55" height="55" 
                                 style="object-fit:cover; cursor:pointer;"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#ulasanPhotoModal<?= $ulasanNo ?>">
                        </div>

                        <!-- Modal Foto Ulasan -->
                        <div class="modal fade" id="ulasanPhotoModal<?= $ulasanNo ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content bg-transparent border-0 position-relative">
                                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <div class="text-center p-2" data-bs-dismiss="modal" style="cursor:pointer;">
                                        <img src="../../backend/foto/<?= rawurlencode($ulasan['photo']) ?>" alt="Foto ulasan" class="img-fluid rounded shadow">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        <?php 
            endwhile;
        else:
        ?>
            <div class="col-12 text-center py-5">
                <p class="text-muted">Belum ada ulasan.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>