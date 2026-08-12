<?php

include "connection.php";

// menerima id bestseller dari tombol update di tabel_bestseller.php
$id_bestseller = $_GET['id_bestseller'];

// menampilkan data bestseller berdasarkan id
$select_id = mysqli_query($koneksi, "SELECT * FROM bestseller WHERE id_bestseller='$id_bestseller'");
$bestseller = mysqli_fetch_object($select_id);

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
                        <h1 class="h3 mb-0 text-gray-800">Bestseller</h1>
                    </div>

                    <form action="action_update_bestseller.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_bestseller" value="<?php echo $bestseller->id_bestseller; ?>">
                        <div class="mb-3">
                            <label class="form-label">Foto</label><br>
                            <img src="foto/<?php echo $bestseller->img; ?>" width="150"><br><br>
                            <label for="img" class="form-label">Ganti foto (boleh kosong)</label>
                            <input type="file" class="form-control" id="img" name="img">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $bestseller->nama_produk; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $bestseller->harga; ?>">
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
