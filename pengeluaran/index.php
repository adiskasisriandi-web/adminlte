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
<title>Billing PerawangNet | Pengeluaran </title>
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
            <h1 class="m-0">Pengeluaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Pengeluaran</li>
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
                <h3 class="card-title">Daftar Uang Keluar Periode <?php echo $bulanIndonesia[date('m')] . " " . date('Y'); ?> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Date Range Picker -->
                <a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Pengeluaran</a>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pengeluaran</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="tambahPengeluaran.php" method="get">
                        <input type="hidden" name="petugas" value="<?php echo $_SESSION["namaAdmin"]; ?>">
                            <div class="form-group">
                                <label>Kegunaan</label>
                                <select name="kegunaan" class="form-control">
                                    <option value="Biaya Metro-E">Biaya Metro-E</option>
                                    <option value="Pembelian Alat">Pembelian Alat</option>
                                    <option value="Pembayaran Indihome">Pembayaran Indihome</option>
                                    <option value="Dan lain-lain">Dan lain-lain</option>
                                </select>      
                            </div>
                            <div class="form-group">
                              <label>Deskripsi</label>
                              <input type="text" name="deskripsi" class="form-control">      
                            </div>
                            <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" name="jumlah" class="form-control" id='dengan-rupiah'>      
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
                      </form>
                  </div>
                </div>
              </div>
            </div>
                  <!-- End of Modal -->
                </br>
                <!-- End of Date Range Picker -->
                <table id="table_pengeluaran" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Kegunaan</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Metode Pembayaran</th>
                    <th>Petugas</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                        $bulanSkrg = date('m');
                        $tahunSkrg = date('Y');
                        include '../koneksi.php';
                        $query = "SELECT * FROM `pengeluaran` WHERE month(created_at) = '$bulanSkrg' AND year(created_at) = '$tahunSkrg'";
                        $i = 1;
                        if ($data = $koneksi->query($query)) {
                            
                            while ($row = $data->fetch_assoc()) {
                    ?>
                    <tr>
                    <td><?php echo $i; $i++; ?></td>
                    <td><?php echo $row["kegunaan"]; ?></td>
                    <td><?php echo $row["deskripsi"]; ?></td>
                    <td><?php echo rupiah($row["jumlah"]); ?></td>
                    <td><?php echo $row["metodePembayaran"]; ?></td>
                    <td><?php echo $row["petugas"]; ?></td>
                    <td><?php echo $row["created_at"]; ?></td>
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
                      <?php } } ?>
                  </tbody>
                  
                  <tfoot>
                  <tr>
                  <th width="5%">No</th>
                    <th>Kegunaan</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Metode Pembayaran</th>
                    <th>Petugas</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            <?php
                $querySUM = "SELECT sum(jumlah) FROM pengeluaran WHERE month(created_at) = '$bulanSkrg' AND year(created_at) = '$tahunSkrg'";
                if ($dataSUM = $koneksi->query($querySUM)) {
                    while ($row1 = $dataSUM->fetch_assoc()) {
            ?>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" disabled>Total Pengeluaran: <?php echo rupiah($row1['sum(jumlah)']); ?></button>
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
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="../plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
  <script>

$(function () {
    $("#table_pengeluaran").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#table_pengeluaran_wrapper .col-md-6:eq(0)');
  });

/* Dengan Rupiah */
var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    
    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>