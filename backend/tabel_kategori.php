<?php
include "connection.php";
$select_kategori = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">kategori</h1>
                    </div>

                    <!-- Tombol Add -->
                    <a href="form_kategori.php" class="btn btn-pink-add mb-3">
                        <i class="fas fa-plus fa-sm"></i> Add
                    </a>

                    <!-- Content Start -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th scope="col">Model Baju</th>
                                    <th scope="col">kategori</th>
                                    <th scope="col">foto</th>
                                    <th scope="col">harga</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($tampil = mysqli_fetch_object($select_kategori)) : ?>
                                    <tr>
                                        <td><?php echo $tampil->nama_model_baju; ?></td>
                                        <td><?php echo $tampil->jenis_kategori; ?></td>
                                        <td>
                                            <img src="foto/<?php echo $tampil->foto; ?>" alt="" style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px;">
                                        </td>
                                        <td><?php echo $tampil->harga; ?></td>
                                        <td><?php echo $tampil->status; ?></td>
                                        <td>
                                            <a href="delete_kategori.php?id_kategori=<?php echo $tampil->id_kategori; ?>" class="btn btn-pink-delete" onclick="return confirm('Confirm to delete?')">
                                                DELETE <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="update_form_kategori.php?id_kategori=<?php echo $tampil->id_kategori; ?>" class="btn btn-pink-update">
                                                UPDATE <i class="fas fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Content End -->

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