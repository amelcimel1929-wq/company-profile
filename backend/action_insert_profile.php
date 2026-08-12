<?php
// Memanggil koneksi database
include "connection.php";

// Mengecek apakah tombol submit ditekan
if (isset($_POST['submit'])) {

    // Mengambil data dari form
    $vabout = $_POST['about'];
    $vfoto = $_POST['foto'];
   

    // Query untuk menyimpan data ke database
    $query = mysqli_query($koneksi, "INSERT INTO profile
    (about, foto)
    VALUES
    ('$vabout', '$vfoto')");

    // Mengecek apakah berhasil
    if ($query) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location='tabel_profile.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan');
                window.history.back();
              </script>";

        echo mysqli_error($koneksi);
    }

} else {

    header("Location: form_profile.php");

}
?>