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
?>
<!DOCTYPE html>
<html lang="en">
<title>Billing PerawangNet | Client </title>
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
            <h1 class="m-0">Pelanggan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
              <li class="breadcrumb-item active">Pelanggan</li>
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
                <h3 class="card-title">Daftar Pelanggan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        include '../koneksi.php';
                        $query = "SELECT * FROM paket WHERE status = 1";
                        $i = 1;
                        if ($data = $koneksi->query($query)) {
                            
                            while ($row = $data->fetch_assoc()) {
                    ?>
                    <td><?php echo $i; $i++; ?></td>
                    <td><?php echo $row["namaPaket"]; ?></td>
                    <td><?php echo rupiah($row["harga"]); ?></td>
                    <td><?php 
                        if($row["status"] == 1) {
                            echo '<button type="button" class="btn btn-block bg-gradient-success btn-flat">Aktif</button>';
                        } else {
                            echo '<button type="button" class="btn btn-block bg-gradient-danger btn-flat">Non Aktif</button>';
                        }
                    ?></td>
                    <td>Aksi</td>
                  </tbody>
                  <?php }
                        }  ?>
                  <tfoot>
                  <tr>
                  <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
 <?php 
//  include '../footer.php';
 include '../footerTable.php'; ?>
