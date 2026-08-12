<?php

include "connection.php";

// menerima id flash sale dari tombol update di tabel_flash_sale.php
$id_flash_sale = $_GET['id_flash_sale'];

// menampilkan data flash sale berdasarkan id
$select_id = mysqli_query($koneksi, "SELECT * FROM flash_sale WHERE id_flash_sale='$id_flash_sale'");
$flash_sale = mysqli_fetch_object($select_id);

?>

<?php include "components/header.php" ?>

<body id="page-top">
    <div id="wrapper">
        <?php include "components/sidebar.php" ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "components/topbar.php" ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Flash Sale</h1>
                    </div>

                    <form action="action_update_flash_sale.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_flash_sale" value="<?php echo $flash_sale->id_flash_sale; ?>">
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $flash_sale->nama_produk; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis Produk</label>
                            <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $flash_sale->jenis; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga_awal" class="form-label">Harga Awal</label>
                            <input type="text" class="form-control" id="harga_awal" name="harga_awal" value="<?php echo $flash_sale->harga_awal; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga_akhir" class="form-label">Harga Akhir</label>
                            <input type="text" class="form-control" id="harga_akhir" name="harga_akhir" value="<?php echo $flash_sale->harga_akhir; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto</label><br>
                            <img src="foto/<?php echo $flash_sale->foto; ?>" width="150"><br><br>
                            <label for="img" class="form-label">Ganti foto (boleh kosong)</label>
                            <input type="file" class="form-control" id="img" name="img">
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

            <?php include "components/footer.php" ?>
        </div>
    </div>

    <?php include "partials/bottom.php" ?>
</body>
</html>
