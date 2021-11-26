<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$idClient = $_POST['idClient'];
$paket = $_POST['paket'];

// menginput data ke database
mysqli_query($koneksi,"UPDATE client SET paket = $paket WHERE client.idClient = $idClient");
 
// mengalihkan halaman kembali ke index.php
header("location:index.php");
 
?>