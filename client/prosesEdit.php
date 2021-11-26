<?php

include("../koneksi.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_GET['simpan'])){

    // ambil data dari formulir
    $id = $_GET['id'];
    $nama = $_GET['nama'];
    $alamat = $_GET['alamat'];
    $no_hp = $_GET['no_hp'];
    $no_ktp = $_GET['no_ktp'];
    $status = $_GET['status'];
    $paket = $_GET['paket'];

    // buat query update
    $sql = "UPDATE client SET namaClient='$nama', alamat='$alamat', no_hp='$no_hp', no_ktp='$no_ktp', status='$status', paket='$paket' WHERE idClient=$id";
    $query = mysqli_query($koneksi, $sql);

    // apakah query update berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-siswa.php
        header('Location: index.php?pesan=success_update');
    } else {
        // kalau gagal tampilkan pesan
        echo "ERROR, data gagal diupdate". mysqli_error();
    }
}
?>