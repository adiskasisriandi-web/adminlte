<?php 
// Cek apakah sudah login?
session_start();
	if($_SESSION['status']!="adminLogin"){
		header("location:login.php?pesan=belum_login");
	}
?>
<!DOCTYPE html>
<html lang="en">
<title>Billing PerawangNet | Dashboard </title>
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
            <h1 class="m-0">Tambah Pelanggan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Tambah Pelanggan</li>
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
                <h3 class="card-title">Tambah Pelanggan</h3>
              </div>
              <form action="prosesTambah.php" method="POST">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col col-md-6 form-group">
                        <label>Nama Client</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="col col-md-6 form-group">
                        <label>Alamat Client</label>
                        <input type="text" class="form-control"  id="alamat" name="alamat" placeholder="Masukkan Alamat">
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6 form-group">
                        <label>No HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor HP">
                    </div>
                    <div class="col col-md-6 form-group">
                        <label>Tanggal Pemasangan</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="tanggalPemasangan" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col col-md-6 form-group">
                        <label>No KTP</label>
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp" placeholder="Masukkan Nomor KTP">
                    </div>
                    <div class="col col-md-6 form-group">
                        <label>Status</label>
                        <div class="input-group">
                       <select name="status" id="status" class="form-control">
                          <option value="">-- Pilih Status --</option>
                          <option value="Aktif">Aktif</option>
                          <option value="Tidak Aktif">Tidak Aktif</option>
                       </select>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6 form-group">
                        <label>SSID WiFi</label>
                        <input type="text" class="form-control" id="ssid" name="ssid" placeholder="Masukkan SSID WiFi">
                    </div>
                </div>
              </div>
              <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tambah</button>
         </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<!-- jQuery -->
<script src="<?php echo $link; ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $link; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo $link; ?>plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo $link; ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo $link; ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo $link; ?>plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="<?php echo $link; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo $link; ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo $link; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo $link; ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo $link; ?>plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="<?php echo $link; ?>plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $link; ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php echo $link; ?>dist/js/demo.js"></script> -->
<!-- Page specific script -->
  <script>
      //Date picker
    $('#reservationdate').datetimepicker({
        format: 'YYYY/MM/DD',
        placeholder: 'YYYY/MM/DD'
    });
    </script>

 <?php 
 include '../footer.php';
//  include '../footerTable.php'; ?>
