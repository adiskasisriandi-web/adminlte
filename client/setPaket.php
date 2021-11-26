<?php 
// Cek apakah sudah login?
session_start();
	if($_SESSION['status']!="adminLogin"){
		header("location:login.php?pesan=belum_login");
	}

$id = $_GET['id'];

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
            <h1 class="m-0">Edit Paket Pelanggan</h1>
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
                <h3 class="card-title">Edit Paket Pelanggan</h3>
              </div>
              <form action="prosesEditPaket.php" method="POST">
              <!-- /.card-header -->
              <?php
                        include '../koneksi.php';
                        $query = "SELECT client.idClient, client.namaClient, client.ssid, client.paket, idPaket, namaPaket, client.alamat, client.no_hp FROM client INNER JOIN paket ON client.paket = paket.idPaket WHERE client.idClient = $id";
                        $i = 1;
                        if ($data = $koneksi->query($query)) {
                            while ($row = $data->fetch_assoc()) {
                    ?>
              <div class="card-body">
                <div class="row">
                    <div class="col col-md-6 form-group">
                        <label>Nama Client</label>
                        <input type="hidden" class="form-control" value='<?php echo $row["idClient"]; ?>' name="idClient">
                        <input type="text" disabled class="form-control" id="nama"  value='<?php echo $row["namaClient"]; ?>' name="nama" placeholder="Masukkan Nama">
                    </div>
                    <div class="col col-md-6 form-group">
                        <label>SSID Client</label>
                        <input type="text" disabled class="form-control" value='<?php echo $row["ssid"]; ?>' id="ssid" name="ssid" placeholder="Masukkan Alamat">
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-6 form-group">
                        <label>Paket Berlangganan</label>
                        <div class="input-group">
                       <select name="paket" id="paket" class="form-control">
                          <option value="">-- Pilih Paket --</option>
                        <?php 
                            $query1 = "SELECT idPaket, namaPaket, harga FROM paket WHERE status = 1";
                            if ($data1 = $koneksi->query($query1)) {
                                while ($row1 = $data1->fetch_assoc()) {
                        ?>
                          <option value="<?php echo $row1['idPaket']; ?>"><?php echo $row1['namaPaket'] . " - " . rupiah($row1['harga']); ?></option>
                        <?php } } ?>
                       </select>
                    </div>
                    </div>
                </div>
              </div>
              <?php
                            }
                        }
              ?>
              <div class="card-footer">
            <button type="submit" class="btn btn-primary">Edit Paket</button>
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
 include '../footerTable.php'; 
 ?>
