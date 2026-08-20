<section id="categoryWomen">
    <div class="container">
        <div class="row h-100">
            <div class="col-lg-7 mx-auto text-center mb-6">
                <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Shop By Category</h5>
            </div>
            <div class="col-12">
                <?php
                require "backend/connection.php";
                $query_kategori = mysqli_query($koneksi, "SELECT * FROM categories");
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
                    $query_kategori2 = mysqli_query($koneksi, "SELECT * FROM categories");
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
                                                     src="foto/<?= htmlspecialchars($produk['image']) ?>"
                                                     alt="<?= htmlspecialchars($produk['name_product']) ?>" />
                                                <div class="card-img-overlay ps-0"></div>
                                                <div class="card-body ps-0 bg-200">
                                                    <h5 class="fw-bold text-1000 text-truncate">
                                                        <?= htmlspecialchars($produk['name_product']) ?>
                                                    </h5>
                                                    <div class="fw-bold">
                                                        <span class="text-primary">
                                                            Rp<?= number_format((float)$produk['price'], 0, ',', '.') ?>
                                                        </span>
                                                    </div>
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