<?php include "connection.php";
$id_kateg = $_GET['id_kategori'];
$select_id = mysqli_query($koneksi, "SELECT*FROM kategori WHERE id_kategori='$id_kateg'");
$kategori = mysqli_fetch_object($select_id);
?>
<?php include "components/header.php" ?>
<body id="page-top">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "components/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "components/topbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
                    </div>

                    <!-- content start -->

<form action= "action_update_kategori.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_kategori" value="<?php echo $kategori->id_kategori; ?>">
    <input type="hidden" name="foto_lama" value="<?php echo $kategori->foto; ?>">
    <div class="mb-3">
        <label for="nama_model_baju" class="form-label">Nama Model Baju</label>
        <input type="text" class="form-control" id="nama_model_baju"
        name="nama_model_baju" value="<?php echo
        $kategori->nama_model_baju?>">
    </div>
      <div class="mb-3">
        <label for="jenis_kategori" class="form-label">Jenis Kategori</label>
        <input type="text" class="form-control" id="jenis_kategori"
        name="jenis_kategori" value="<?php echo
        $kategori->jenis_kategori?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Foto</label><br>
        <img src="foto/<?php echo $kategori->foto; ?>" width="150"><br><br>
        <label for="img" class="form-label">Ganti foto (boleh kosong)</label>
        <input type="file" class="form-control" id="img" name="img">
    </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" class="form-control" id="harga"
        name="harga" value="<?php echo
        $kategori->harga?>">
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-control" id="status" name="status">
            <option value="tersedia" <?php if ($kategori->status == 'tersedia') echo 'selected'; ?>>Tersedia</option>
            <option value="habis" <?php if ($kategori->status == 'habis') echo 'selected'; ?>>Habis</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

                    <!-- content end -->

                    </div>
                    <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "components/footer.php" ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include "partials/bottom.php" ?>