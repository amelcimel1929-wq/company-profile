<?php
include "connection.php";

if (isset($_POST['submit'])) {

    $vnama_produk  = $_POST['nama_produk'];
    $vharga = $_POST['harga'];

    // Handle upload file
    $vfoto = $_FILES['img']['name'];
    $tmp_name = $_FILES['img']['tmp_name'];
    $upload_path = "foto/" . $vfoto;

    if (move_uploaded_file($tmp_name, $upload_path)) {

        $query = mysqli_query($koneksi, "INSERT INTO bestseller
            (foto, nama_produk, harga)
            VALUES
            ('$vfoto', '$vnama_produk', '$vharga')");

        if ($query) {
            echo "<script>
                    alert('Data berhasil ditambahkan');
                    window.location='tabel_bestseller.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Data gagal ditambahkan');
                    window.history.back();
                  </script>";
            echo mysqli_error($koneksi);
        }

    } else {
        echo "<script>
                alert('Upload foto gagal');
                window.history.back();
              </script>";
    }

} else {
    header("Location: form_bestseller.php");
}
?>