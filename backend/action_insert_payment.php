<?php
require "connection.php";

$id_order       = $_POST['id_order'];
$payment_method = $_POST['payment_method'];
$payment_status = "belum_bayar"; // menunggu konfirmasi admin
$payment_date   = date('Y-m-d H:i:s');
$proof_image    = $_FILES['proof_image']['name'];

move_uploaded_file($_FILES['proof_image']['tmp_name'], "bukti_bayar/" . $proof_image);

mysqli_query($koneksi, "
    INSERT INTO payments (id_order, payment_method, payment_status, proof_image, payment_date)
    VALUES ('$id_order', '$payment_method', '$payment_status', '$proof_image', '$payment_date')
");

header("Location: ../terima_kasih.php?order=$id_order");
exit;
?>