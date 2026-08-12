<!-- ini adalah langkah ketiga setelah dari file action_insert_bestseller.php -->
<!-- disini adalah langkah untuk menampilkan data dr database ke tampilan versi web  -->
 <!-- pertama tama panggil koneksi database -->
<?php

include "connection.php";
// kedua buat perintah sql/query ke database untuk menampilkan data
$select_flash_sale = mysqli_query(
    $koneksi,
    "SELECT * FROM flash_sale ORDER BY id_flash_sale DESC"
);
// ketiga, buat perulangan di dalam <tbody> di bawah ini

?>

<?php include "components/header.php" ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "components/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "components/topbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">

                        <h1 class="h3 mb-0 text-gray-800">
                            flash sale
                        </h1>

                    </div>
                    <!--ke empat, tambahkan tombol tambah untuk mengarahkan ke file form_flash_sale.php-->
                    <a href="form_flash_sale.php" class="btn btn-info mb-2">
                        Add
                    </a>


                    <!-- Content Start -->

                    <table class="table table-striped table-bordered">

                        <thead>

                            <tr>

                                <th>nama_produk</th>
                                <th>jenis</th>
                                <th>Harga_awal</th>
                                <th>Harga_akhir</th>
                                <th>foto</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                             <?php while ($tampil = mysqli_fetch_object($select_flash_sale)) : ?>
                                <tr>
                                     <td><?php echo $tampil->nama_produk; ?></td>
                                     <td><?php echo $tampil->jenis; ?></td>
                                     <td><?php echo $tampil->harga_awal; ?></td>
                                     <td><?php echo $tampil->harga_akhir; ?></td>
                                     <td>
                                         <img src="foto/<?php echo $tampil->foto; ?>" alt="" width="100">
                                     </td>
                                    <td>
                                        <a href="delete_flash_sale.php?id_flash_sale=<?php echo $tampil->id_flash_sale; ?>"
                                             class="btn btn-danger btn-sm"
                                             onclick="return confirm('Confirm to delete?')">
                                             DELETE
                                        </a>
                                        <a href="update_form_flash_sale.php?id_flash_sale=<?php echo $tampil->id_flash_sale; ?>"
                                          class="btn btn-success btn-sm">
                                          UPDATE
                                        </a>
                                    </td>
                                </tr>
                             <?php endwhile; ?>
                        </tbody>

                    </table>

                    <!-- Content End -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->

            <?php include "components/footer.php" ?>

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->

    <?php include "partials/bottom.php" ?>

</body>

</html>
