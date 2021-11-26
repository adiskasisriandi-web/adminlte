<?php 
// koneksi database
include '../koneksi.php';
 
// menangkap data yang di kirim dari form
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp = $_POST['no_hp'];
$tanggalPemasangan = $_POST['tanggalPemasangan'];
$newTanggal = date("Y-m-d", strtotime($tanggalPemasangan));
$status = $_POST['status'];
$ssid = $_POST['ssid'];

if($status == 'Aktif') {
    $tandaStatus = 1;
}

$no_ktp = $_POST['no_ktp'];

// menginput data ke database
mysqli_query($koneksi,"insert into client(namaClient, alamat, no_hp, no_ktp, tanggalPemasangan, status, ssid) 
            values(
                '$nama',
                '$alamat',
                '$no_hp',
                '$no_ktp',
                '$newTanggal',
                '$tandaStatus',
                '$ssid')");
 
// mengalihkan halaman kembali ke index.php
header("location:index.php");
 
?>