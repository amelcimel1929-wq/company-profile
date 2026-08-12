<?php
include "connection.php";
$select_owner = mysqli_query($koneksi, "SELECT*FROM owner ORDER BY id_owner DESC");
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
                       <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <a href="form_owner.php" class="btn btn-info mb-2">Add</a>

                    <!-- content start -->

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">foto</th>
                            <th scope="col">deskripsi</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                     while ($tampil = mysqli_fetch_object
                        ($select_owner)):
                        ?>
                        <tr>
                            <td>
                                <img src="foto/<?php echo $tampil->foto; ?>" alt="" width="100">
                            </td>
                            <td><?php echo $tampil->deskripsi; ?></td>
                            <td>
                                <a href="delete_owner.php?
                                id_owner=<?php echo
                                $tampil->id_owner;?>"
                                class="btn btn-danger"
                                onclick="return confirm('confirm to delete?')">DELETE</a>
                                <a href="update_form_owner.php?id_owner=<?php echo $tampil->id_owner; ?>" class="btn btn-success">UPDATE</a>
                            </td>
                        </tr>
<?php endwhile ?>
                    </tbody> 
                </table>

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