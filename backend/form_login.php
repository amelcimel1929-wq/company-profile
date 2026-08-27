<?php
include "connection.php";

session_start();

// CEK SUDAH LOGIN ATAU BELUM
if (!isset($_SESSION['status'])) {
    header("Location:login.php");
    exit;
}

// HANYA SUPERADMIN
if ($_SESSION['role'] != "superadmin") {
    echo "Anda tidak memiliki akses.";
    exit;
}
?>

<?php include "components/header.php"; ?>

<body id="page-top">

<div id="wrapper">

    <?php include "components/sidebar.php"; ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <?php include "components/topbar.php"; ?>

            <div class="container-fluid">

                <h1 class="h3 mb-4 text-gray-800">
                    Tambah User
                </h1>

                <form action="action_insert_login.php" method="post">

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="Masukkan email user">
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
                    </div>

                    <div class="mb-3">
                        <label>Role</label>
                        <!-- Tampilan input terkunci untuk user -->
                        <input type="text" class="form-control" value="Admin" readonly>
                        <!-- Nilai 'admin' dikirimkan ke backend -->
                        <input type="hidden" name="role" value="admin">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        SIMPAN
                    </button>

                    <a href="tabel_login.php" class="btn btn-secondary">
                        KEMBALI
                    </a>

                </form>

            </div>

        </div>

        <?php include "components/footer.php"; ?>

    </div>

</div>

</body>

</html>