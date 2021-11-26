<?php 
// Cek apakah sudah login?
session_start();
	if($_SESSION['status']!="adminLogin"){
		header("location:../login.php?pesan=belum_login");
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
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
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
                        $query = "SELECT * FROM client LEFT JOIN pembayaran ON client.idClient = pembayaran.idClient WHERE pembayaran.idClient IS NULL AND client.status = '1'";
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
                      <!-- Modal Edit Mahasiswa-->
              <div class="modal fade" id="myModal<?php echo $row['idClient']; ?>" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pembayaran</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="prosesBayar.php" method="get">
                        <?php
                        $id = $row['idClient']; 
                        $query_edit = mysqli_query($koneksi, "SELECT * FROM client, paket WHERE client.idClient='$id' AND client.paket = paket.idPaket");
                        while ($row1 = mysqli_fetch_array($query_edit)) {  
                        ?>
                        <input type="hidden" name="id" value="<?php echo $row1['idClient']; ?>">
                        <input type="hidden" name="petugas" value="<?php echo $_SESSION["namaAdmin"]; ?>">
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" value="<?php echo $row1['namaClient']; ?>">      
                            </div>
                            <div class="form-group">
                              <label>SSID</label>
                              <input type="text" name="ssid" class="form-control" value="<?php echo $row1['ssid']; ?>">      
                            </div>
                            <div class="form-group">
                              <label>SSID</label>
                              <input type="text" disabled name="paket" class="form-control" value="<?php echo $row1['namaPaket'] . " - " . rupiah($row1['harga']); ?>">      
                            </div>
                            <div class="form-group">
                              <label>Periode Pembayaran</label>
                              <input type="text" name="periodePembayaran" class="form-control" value="<?php echo $bulanIndonesia[date('m')]; ?>">      
                            </div>
                            <div class="form-group">
                              <label>Jumlah Bayar</label>
                              <input type="text" name="jumlahBayar" class="form-control" value="<?php echo $row1['harga'] ?>">      
                            </div>
                            <div class="form-group">
                              <label>Metode Pembayaran</label>
                              <select name="metodePembayaran" class="custom-select">
                                <option value="Cash">Cash</option>
                                <option value="BRI">BRI</option>
                                <option value="DANA">DANA</option>
                                <option value="GoPay">GoPay</option>
                              </select>      
                            </div>
                        <div class="modal-footer">  
                          <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        <?php 
                        }
                        ?>        
                      </form>
                  </div>
                </div>
              </div>
                  <!-- End of Modal -->
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
              <div class="card-footer">
            </div>
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
