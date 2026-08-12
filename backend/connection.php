<?php
$servername = getenv('DB_HOST') ?: "Localhost";
$username = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASSWORD') ?: "";
$database = getenv('DB_NAME') ?: "company-profile";
// warna biru adalah variable ($) yg isinya bebas namun hrs sesuai utk pemanggilannya, spt di bawah ini.
$koneksi =mysqli_connect($servername, $username, $password, $database);