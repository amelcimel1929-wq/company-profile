<?php include "connection.php";
$id_contact = $_GET['id_contact'];
$select_id = mysqli_query($koneksi, "SELECT*FROM contact WHERE id_contact='$id_contact'");
$contact = mysqli_fetch_object($select_id);
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
                        <h1 class="h3 mb-0 text-gray-800">Contact</h1>
                    </div>

                    <!-- content start -->

            <form action= "action_update_contact.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_contact" value="<?php echo $contact->id_contact; ?>">
<input type="hidden" name="foto_lama" value="<?php echo $contact->foto; ?>">
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="no_telepon"
                    name="no_telepon" value="<?php echo
                    $contact->no_telepon?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email"
                    name="email" value="<?php echo
                    $contact->email?>">
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input type="text" class="form-control" id="instagram"
                    name="instagram" value="<?php echo
                    $contact->instagram?>">
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