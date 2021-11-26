<?php

include("../koneksi.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_GET['simpan'])){

    // ambil data dari formulir
    $id = $_GET['id'];
    $jumlahBayar = $_GET['jumlahBayar'];
    $petugas = $_GET['petugas'];
    $metodePembayaran = $_GET['metodePembayaran'];

    // buat query update
    $sql = "INSERT INTO pembayaran(idClient, jumlah, metodePembayaran, petugas) VALUES
            ('$id', '$jumlahBayar', '$metodePembayaran', '$user')";
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