<?php

include "connection.php";

session_start();

if (!isset($_SESSION['status'])) {

    header("Location:login.php");
    exit;
}


// HANYA SUPERADMIN

if ($_SESSION['role'] != "superadmin") {

    echo "Anda tidak memiliki akses.";
    exit;
}


$id_login = $_GET['id_login'];


// CEK ROLE DATA YANG MAU DIHAPUS

$select = mysqli_query(

    $koneksi,

    "SELECT * FROM login WHERE id_login='$id_login'"

);


$data = mysqli_fetch_assoc($select);


// CUSTOMER TIDAK BOLEH DIHAPUS

if ($data['role'] == "customer") {

    echo "Customer tidak boleh dihapus.";

    exit;
}


// HAPUS

$delete = mysqli_query(

    $koneksi,

    "DELETE FROM login WHERE id_login='$id_login'"

);


header("Location:tabel_login.php");

?>