<?php
include "connection.php";
$select_login = mysqli_query($koneksi, "SELECT * FROM login ORDER BY id_login DESC");
?>
<?php include "components/header.php"; ?>

<!-- 1. PEMANGGILAN CSS KUSTOM DIPASANG DI SINI -->
<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "components/sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "components/topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">login</h1>
                    </div>

                    <!-- content start -->
                    <div class="table-responsive">
                        <!-- 2. CLASS TABEL DIUBAH MENJADI table-pink-custom -->
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th scope="col">Email</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($tampil = mysqli_fetch_object($select_login)): ?>
                                <tr>
                                    <td><?php echo $tampil->email; ?></td>
                                    <td><?php echo $tampil->password; ?></td>
                                    <td>
                                        <!-- 3. CLASS TOMBOL DIUBAH MENJADI btn-pink-update -->
                                        <a href="update_form_login.php?id_login=<?php echo $tampil->id_login;?>" class="btn btn-pink-update">
                                            UPDATE <i class="fas fa-pen"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody> 
                        </table>
                    </div>
                    <!-- content end -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "components/footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include "partials/bottom.php"; ?>

</body>
</html>