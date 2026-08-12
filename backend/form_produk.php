<?php include "components/header.php" ?>
<link href="css/custom-style.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">produk</h1>
                    </div>

                    <!-- content start -->
                     <form action="action_insert_produk.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_produk" class="form_label"> Nama Produk </label>
                            <input type="text" class="form-control" id="nam_produk" name="nama_produk">
                        </div>
                          <div class="mb-3">
                            <label for="img" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="img" name="img" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
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