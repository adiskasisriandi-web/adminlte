<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$kegunaan = $_GET['kegunaan'];
$deskripsi = $_GET['deskripsi'];
$jumlah = $_GET['jumlah'];
$metodePembayaran = $_GET['metodePembayaran'];
$petugas = $_GET['petugas'];

$jumlahInteger = preg_replace("/[^0-9]/", "", $jumlah);;
// echo $kegunaan . $deskripsi . $jumlah . $metodePembayaran . $petugas;

// menginput data ke database
mysqli_query($koneksi,"insert into pengeluaran(kegunaan, deskripsi, jumlah, metodePembayaran, petugas) 
            values(
                '$kegunaan',
                '$deskripsi',
                '$jumlahInteger',
                '$metodePembayaran',
                '$petugas')");
 
// mengalihkan halaman kembali ke index.php
header("location:index.php");
 
?>