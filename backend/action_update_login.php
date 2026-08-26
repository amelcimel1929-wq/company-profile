<?php

include "connection.php";

session_start();

if (!isset($_SESSION['status'])) {

    header("Location:login.php");
    exit;
}


$id_login = $_POST['id_login'];

$password = $_POST['password'];


// =================================
// SUPERADMIN
// BISA UBAH EMAIL DAN PASSWORD
// =================================

if ($_SESSION['role'] == "superadmin") {


    $email = $_POST['email'];


    $update = mysqli_query(

        $koneksi,

        "UPDATE login SET

        email='$email',

        password='$password'

        WHERE id_login='$id_login'"

    );


    header("Location:tabel_login.php");

    exit;

}



// =================================
// ADMIN
// HANYA BISA UBAH PASSWORD SENDIRI
// =================================

elseif ($_SESSION['role'] == "admin") {


    // CEK ID LOGIN

    if ($_SESSION['id_login'] != $id_login) {

        echo "Anda tidak memiliki akses.";

        exit;
    }


    $update = mysqli_query(

        $koneksi,

        "UPDATE login SET

        password='$password'

        WHERE id_login='$id_login'"

    );


    header("Location:tabel_login.php");

    exit;

}

?>