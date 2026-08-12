<?php include "connection.php";
$id_owner = $_GET['id_owner'];
$select_id = mysqli_query($koneksi, "SELECT*FROM owner WHERE id_owner='$id_owner'");
$owner = mysqli_fetch_object($select_id);
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
                        <h1 class="h3 mb-0 text-gray-800">Owner</h1>
                    </div>

                    <!-- content start -->

            <form action= "action_update_owner.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_owner" value="<?php echo $owner->id_owner; ?>">
<input type="hidden" name="foto_lama" value="<?php echo $owner->foto; ?>">
                  <div class="mb-3">
                    <label class="form-label">Foto</label><br>
                    <img src="foto/<?php echo $owner->foto; ?>" width="150"><br><br>
                    <label for="img" class="form-label">Ganti foto (boleh kosong)</label>
                    <input type="file" class="form-control" id="img" name="img">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi"
                    name="deskripsi" value="<?php echo
                    $owner->deskripsi?>">
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