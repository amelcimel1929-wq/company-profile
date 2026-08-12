<?php include "components/header.php" ?>
<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">
    <div id="wrapper">
        <?php include "components/sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "components/topbar.php" ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Tambah Bestseller</h1>

                    <form action="action_insert_bestseller.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="img" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" required>
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