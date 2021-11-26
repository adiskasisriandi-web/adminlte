<?php 
// Cek apakah sudah login?
session_start();
	if($_SESSION['status']!="adminLogin"){
		header("location:login.php?pesan=belum_login");
	}
    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
     
    }

$bulanIndonesia = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
);
?>
<!DOCTYPE html>
<html lang="en">
<title>Billing PerawangNet | Pemasukan </title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $link; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $link; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $link; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $link; ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $link; ?>dist/css/adminlte.min.css">
<?php
include '../header.php';
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pemasukan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Pemasukan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Uang Masuk Periode <?php echo $bulanIndonesia[date('m')] . " " . date('Y'); ?> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table_pemasukan" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>SSID</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Metode</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                        $bulanSkrg = date('m');
                        $tahunSkrg = date('Y');
                        include '../koneksi.php';
                        $query = "SELECT client.idClient, client.namaClient, client.ssid, pembayaran.idClient, pembayaran.tanggalPembayaran, pembayaran.jumlah, pembayaran.metodePembayaran, pembayaran.petugas FROM client, pembayaran WHERE client.idClient = pembayaran.idClient AND month(tanggalPembayaran) = '$bulanSkrg' AND year(tanggalPembayaran) = '$tahunSkrg'";
                        $i = 1;
                        if ($data = $koneksi->query($query)) {
                            while ($row = $data->fetch_assoc()) {
                    ?>
                    <tr>
                    <td><?php echo $i; $i++; ?></td>
                    <td><?php echo $row["namaClient"]; ?></td>
                    <td><?php echo $row["ssid"]; ?></td>
                    <td><?php 
                        if($row["jumlah"] == NULL) { ?>
                            <a href="#" type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $row['idClient']; ?>">Belum Bayar!</a>
                        <?php } else {
                            echo rupiah($row["jumlah"]);
                        }
                    ?></td>
                    <td><?php echo $row["tanggalPembayaran"]; ?></td>
                    <td><?php echo $row["metodePembayaran"]; ?></td>
                    <td><?php echo $row["petugas"]; ?></td>
                    <td>
                        <div class="btn-group btn-group-xs act" role="group" aria-label="...">
                            <a class="btn btn-success far fa-edit" href="edit.php?id=<?php echo $row['idClient']; ?>" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                            <a class="btn btn-danger far fa-window-close" href="hapus.php?id=<?php echo $row['idClient']; ?>" onclick="return confirm('are you sure?')">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        </div>
                    </td>
                      </tr>
                      <?php }
                        }  ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>SSID</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Metode</th>
                    <th>Petugas</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            <?php
                $querySUM = "SELECT sum(jumlah) FROM pembayaran WHERE month(tanggalPembayaran) = '$bulanSkrg'";
                if ($dataSUM = $koneksi->query($querySUM)) {
                    while ($row1 = $dataSUM->fetch_assoc()) {
            ?>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" disabled>Total Pemasukan: <?php echo rupiah($row1['sum(jumlah)']); ?></button>
            </div>
            <?php } } ?>
            </div>
            <!-- /.card -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
$(function() {
   $("#table_pemasukan").DataTable({
       "responsive": true,
       "lengthChange": false,
       "autoWidth": false,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
   }).buttons().container().appendTo('#table_pemasukan_wrapper .col-md-6:eq(0)');
});
</script>
 <?php 
//  include '../footer.php';
//  include '../footerTable.php'; ?>
