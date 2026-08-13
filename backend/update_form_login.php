<?php
include "connection.php";

$id_login = $_GET['id_login'];

$select_id = mysqli_query($koneksi, "SELECT * FROM login WHERE id_login='$id_login'");
$login = mysqli_fetch_object($select_id);

if (!$login) {
    echo "Data tidak ditemukan";
    exit;
}
?>

<?php include "components/header.php" ?>

<body id="page-top">

<div id="wrapper">

    <!-- Sidebar -->
    <?php include "components/sidebar.php" ?>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <!-- Topbar -->
            <?php include "components/topbar.php" ?>

            <div class="container-fluid">

                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Login</h1>
                </div>

                <!-- Form Update -->
                <form action="action_update_login.php" method="post">

                    <input type="hidden" name="id_login" value="<?php echo $login->id_login; ?>">

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?php echo $login->email; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="text"
                            class="form-control"
                            id="password"
                            name="password"
                            value="<?php echo $login->password; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>

                </form>

            </div>

        </div>

        <?php include "components/footer.php"; ?>

    </div>

</div>

<?php include "partials/bottom.php"; ?>

</body>
</html>