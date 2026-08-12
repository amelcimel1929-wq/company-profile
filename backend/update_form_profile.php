<!-- we are dr file tabel_profile -->
<!-- next: copy the data from form_profile -->

<?php
include "connection.php";

// menyimpan sementara id_profile dari tombol UPDATE tabel_profile.php
// $_GET['id_profile']; yg menerima id_profile dr tombol UPDATE
// tabel_profile.php

$id_profile = $_GET['id_profile'];

// menampilkan data profile yg didapat atau dikirim dari tombol UPDATE
// tabel_profile.php di atas
$select_id = mysqli_query($koneksi, "SELECT * FROM profile WHERE id_profile='$id_profile'");

// fungsi untuk menampilkan isi tabel menggunakan mysqli_fetch_object
// (--)

// selanjutnya menuju form bawah dengan menggunakan value
// inputan setiap data
$profile = mysqli_fetch_object($select_id);

// di bawah ini adalah isi asli dr form_profile
?>

<?php include "components/header.php" ?>

<body id="page-top">

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">

        <?php include "components/topbar.php" ?>

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">update</h1>
                </div>

                <form action="action_update_profile.php"
                      method="post">
                    <div class="mb-3">
                            <label class="form-label">Foto</label><br>
                            <img src="foto/<?php echo $profile->foto; ?>" width="150"><br><br>
                            <label for="foto" class="form-label">Ganti Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                    </div>

                    <div class="mb-3">
                        <label for="about" class="form-label">
                            about
                        </label>

                        <!-- khusus TEXTAREA letak php nya echo
                             $profile->deskripsi di antara tag
                             penutup dan pembuka -->

                        <textarea name="about" id="about"
                        cols="30" class="form-control"
                        rows="10"><?php echo $profile->about ?></textarea>

                  
                       <input type="hidden" value="<?php echo $profile->id_profile ?>"
                       name="id_profile">
                       <button type="submit" class="btn btn-primary">
                         Submit
                       </button>

                </form>
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