<?php

include "connection.php";

session_start();

if (!isset($_SESSION['status'])) {
    header("Location:login.php");
    exit;
}

if (!isset($_SESSION['role'])) {
    header("Location:login.php");
    exit;
}

// URUTKAN SUPERADMIN DI ATAS (ORDER BY role DESC agar superadmin tampil paling awal)
$select_login = mysqli_query(
    $koneksi,
    "SELECT * FROM login ORDER BY role DESC, id_login ASC"
);

?>

<?php include "components/header.php"; ?>

<link href="css/custom-style.css" rel="stylesheet">

<body id="page-top">

<div id="wrapper">

    <?php include "components/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php include "components/topbar.php"; ?>

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-3">

                    <!-- Judul diubah menjadi Data Admin -->
                    <h1 class="h3 mb-0" style="color: #7d5260; font-weight: 500;">
                        Data Admin
                    </h1>

                    <!-- TOMBOL ADD HANYA UNTUK SUPERADMIN -->
                    <?php if ($_SESSION['role'] == "superadmin"): ?>
                        <a href="form_login.php" class="btn btn-primary">
                            ADD <i class="fas fa-plus"></i>
                        </a>
                    <?php endif; ?>

                </div>

                <div class="table-responsive">

                    <table class="table table-bordered table-pink-custom">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $no = 1;
                            while ($tampil = mysqli_fetch_object($select_login)):
                            ?>

                            <tr>

                                <td>
                                    <?php echo $no++; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($tampil->email); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($tampil->role); ?>
                                </td>

                                <td>

                                    <!-- ===================== -->
                                    <!-- SUPERADMIN -->
                                    <!-- ===================== -->
                                    <?php if ($_SESSION['role'] == "superadmin"): ?>

                                        <a href="update_form_login.php?id_login=<?php echo $tampil->id_login; ?>"
                                           class="btn btn-pink-update">
                                            EDIT <i class="fas fa-pen"></i>
                                        </a>

                                        <!-- HANYA TAMPILKAN TOMBOL DELETE JIKA BUKAN SUPERADMIN -->
                                        <?php if ($tampil->role != "superadmin"): ?>
                                            <a href="action_delete_login.php?id_login=<?php echo $tampil->id_login; ?>"
                                               class="btn btn-danger"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                                DELETE <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>

                                    <!-- ===================== -->
                                    <!-- ADMIN BIASA -->
                                    <!-- ===================== -->
                                    <?php elseif ($_SESSION['role'] == "admin"): ?>

                                        <?php if ($_SESSION['id_login'] == $tampil->id_login): ?>
                                            <a href="update_form_login.php?id_login=<?php echo $tampil->id_login; ?>"
                                               class="btn btn-pink-update">
                                                GANTI PASSWORD
                                            </a>
                                        <?php endif; ?>

                                    <?php endif; ?>

                                </td>

                            </tr>

                            <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <?php include "components/footer.php"; ?>

    </div>

</div>

<?php include "partials/bottom.php"; ?>

</body>

</html>