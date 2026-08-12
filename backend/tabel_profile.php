<?php
// Memanggil file koneksi database
include "connection.php";

// Mengambil semua data dari tabel profile
$select_profile = mysqli_query($koneksi, "SELECT * FROM profile");

// Mengecek apakah query berhasil

?>

<?php include "components/header.php"; ?>

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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">
                            Profile
                        </h1>
                    </div>

                    <!-- Membuat tabel profile -->
                    <div class="table-responsive">

                        <table class="table table-striped table-bordered">

                            <!-- Kepala tabel -->
                            <thead>
                                <tr>
                                    <th scope="col">about</th>
                                    <th scope="col">foto</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <!-- Isi tabel -->
                            <tbody>

                                <!-- Perulangan untuk menampilkan data profile -->
                                <?php while ($tampil = mysqli_fetch_object($select_profile)) : ?>

                                    <tr>

                                        <!-- Menampilkan data dari database -->
                                        <td>
                                            <?php echo $tampil->about; ?>
                                        </td>
                                       <td>
                                            <img src="foto/<?php echo $tampil->foto; ?>"
                                            alt="" width="100">
                                       </td>
                                        <!-- Kolom tombol aksi -->
                                        <td>

                                            <!-- Tombol Update -->
                                            <!-- Mengirim id_profile ke update_form_profile.php -->
                                            <a
                                                href="update_form_profile.php?id_profile=<?php echo $tampil->id_profile; ?>"
                                                class="btn btn-success btn-sm">
                                                UPDATE
                                            </a>

                                        </td>

                                    </tr>

                                <!-- Mengakhiri perulangan -->
                                <?php endwhile; ?>

                            </tbody>

                        </table>

                    </div>
                    <!-- End Table Responsive -->

                </div>
                <!-- End Container Fluid -->

            </div>
            <!-- End Main Content -->

            <!-- Footer -->
            <?php include "components/footer.php"; ?>
            <!-- End Footer -->

        </div>
        <!-- End Content Wrapper -->

    </div>
    <!-- End Page Wrapper -->

    <!-- Scroll to Top Button -->
    <?php include "partials/bottom.php"; ?>

</body>

</html>
