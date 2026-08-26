<?php

include "connection.php";

session_start();

if (!isset($_SESSION['status'])) {

    header("Location:login.php");
    exit;
}


$id_login = $_GET['id_login'];


$select_id = mysqli_query(

    $koneksi,

    "SELECT * FROM login WHERE id_login='$id_login'"

);


$login = mysqli_fetch_object($select_id);


if (!$login) {

    echo "Data tidak ditemukan";
    exit;
}


// ADMIN HANYA BOLEH EDIT DIRINYA SENDIRI

if (

    $_SESSION['role'] == "admin"

    &&

    $_SESSION['id_login'] != $login->id_login

) {

    echo "Admin hanya bisa mengubah password sendiri.";

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

                    Update User

                </h1>


                <form action="action_update_login.php" method="post">


                    <input
                        type="hidden"
                        name="id_login"
                        value="<?php echo $login->id_login; ?>">


                    <!-- EMAIL -->

                    <div class="mb-3">

                        <label>Email</label>


                        <?php if ($_SESSION['role'] == "superadmin"): ?>


                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?php echo $login->email; ?>"
                                required>


                        <?php else: ?>


                            <!-- ADMIN HANYA BISA MELIHAT EMAIL -->

                            <input
                                type="email"
                                class="form-control"
                                value="<?php echo $login->email; ?>"
                                readonly>


                        <?php endif; ?>


                    </div>


                    <!-- PASSWORD -->

                    <div class="mb-3">

                        <label>Password Baru</label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

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