<?php
include "connection.php";
$select_contact = mysqli_query($koneksi, "SELECT * FROM contact ORDER BY id_contact DESC");
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
                        <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">Contact</h1>
                    </div>

                    <!-- Tombol Add -->
                    <a href="form_contact.php" class="btn btn-pink-add mb-3">
                        <i class="fas fa-plus fa-sm"></i> Add
                    </a>

                    <!-- Content Start -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-pink-custom">
                            <thead>
                                <tr>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Instagram</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($tampil = mysqli_fetch_object($select_contact)) : ?>
                                    <tr>
                                        <td><?php echo $tampil->no_telepon; ?></td>
                                        <td><?php echo $tampil->email; ?></td>
                                      <td>
    <a href="<?php echo $tampil->instagram; ?>" target="_blank">
        <i class="fab fa-instagram icon-instagram"></i>
    </a>
</td>
                                        <td>
                                            <a href="delete_contact.php?id_contact=<?php echo $tampil->id_contact; ?>" class="btn btn-pink-delete" onclick="return confirm('Confirm to delete?')">
                                                DELETE <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <a href="update_form_contact.php?id_contact=<?php echo $tampil->id_contact; ?>" class="btn btn-pink-update">
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