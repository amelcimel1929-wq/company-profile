<?php
session_start();
include "connection.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'superadmin') {
    echo "<script>alert('Akses Ditolak!'); window.location='tabel_login.php';</script>";
    exit();
}

include "components/header.php";
?>

<body id="page-top">
<div id="wrapper">
    <?php include "components/sidebar.php"; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include "components/topbar.php"; ?>
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Tambah Admin Baru</h1>
                
                <form action="action_insert_admin.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Admin</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Admin</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Admin</button>
                    <a href="tabel_login.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
        <?php include "components/footer.php"; ?>
    </div>
</div>
<?php include "partials/bottom.php"; ?>
</body>
</html>