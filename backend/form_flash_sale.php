<?php include "components/header.php" ?>

<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">
    <div id="wrapper">
        <?php include "components/sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "components/topbar.php" ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Tambah Flash Sale</h1>

                    <form action="action_insert_flash_sale.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Produk</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga_awal" class="form-label">Harga Awal</label>
                            <input type="text" class="form-control" id="harga_awal" name="harga_awal" required>
                        </div>
                         <div class="mb-3">
                            <label for="harga_akhir" class="form-label">Harga Akhir</label>
                            <input type="text" class="form-control" id="harga_akhir" name="harga_akhir" required>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>
                        

                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>

            <?php include "components/footer.php" ?>
        </div>
    </div>

    <?php include "partials/bottom.php" ?>
</body>
</html>