<?php
// Memanggil file koneksi database
include "connection.php";

// Mengambil semua data dari tabel profile
$select_profile = mysqli_query($koneksi, "SELECT * FROM profile");
?>

<?php include "components/header.php"; ?>

<!-- PEMANGGILAN CSS KUSTOM -->
<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "components/sidebar.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "components/topbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">
                            Profile
                        </h1>
                    </div>

                    <!-- Tombol Add -->
                    <a href="form_profile.php" class="btn btn-pink-add mb-3">
                        <i class="fas fa-plus fa-sm"></i> Add
                    </a>

                    <!-- Membuat tabel profile -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th scope="col">about</th>
                                    <th scope="col">foto</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($tampil = mysqli_fetch_object($select_profile)) : ?>
                                    <tr>
                                        <td>
                                            <?php echo $tampil->about; ?>
                                        </td>
                                        <td>
                                            <!-- Lebar 120px, tinggi otomatis -->
<img src="foto/<?php echo $tampil->foto; ?>" alt="" style="width: 120px; height: auto; border-radius: 6px;">
                                        </td>
                                        <td>
                                            <a href="update_form_profile.php?id_profile=<?php echo $tampil->id_profile; ?>" class="btn btn-pink-update">
                                                UPDATE <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <!-- Footer -->
            <?php include "components/footer.php"; ?>

        </div>

    </div>

    <!-- Scroll to Top Button -->
    <?php include "partials/bottom.php"; ?>

</body>
</html>