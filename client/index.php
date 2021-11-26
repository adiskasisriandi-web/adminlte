<?php 
$link = "http://perawang.my.id/billing/";

// Cek apakah sudah login?
session_start();
	if($_SESSION['status']!="adminLogin"){
		header("location:../login.php?pesan=belum_login");
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
              <div class="row">
                <div class="col col-auto">
                  <button type="button" onclick="location.href='tambah.php'" class="btn btn-block btn-primary">Tambah Data</button>
                </div>
              </div> </br>
                <table id="table_client" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>SSID</th>
                    <th>Layanan</th>
                    <th>Alamat</th>
                    <th>WA</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        include '../koneksi.php';
                        $query = "SELECT client.idClient, client.namaClient, client.ssid, client.paket, namaPaket, client.alamat, client.no_hp FROM client INNER JOIN paket ON client.paket = paket.idPaket WHERE client.status = '1'";
                        $i = 1;
                        if ($data = $koneksi->query($query)) {
                            
                            while ($row = $data->fetch_assoc()) {
                    ?>
                    <tr>
                    <td><?php echo $i; $i++; ?></td>
                    <td><?php echo $row["namaClient"]; ?></td>
                    <td><?php echo $row["ssid"]; ?></td>
                    <td><?php 
                        if($row["paket"] == 0) {
                            echo '<a href="setPaket.php?id=' . $row["idClient"] . '" class="btn btn-block btn-warning btn-sm">Set Paket</a>';
                        } else {
                            echo $row["namaPaket"];
                        }
                    ?></td>
                    <td><?php echo $row["alamat"]; ?></td>
                    <td><?php echo $row["no_hp"]; ?></td>
                    <td>
                        <div class="btn-group btn-group-xs act" role="group" aria-label="...">
                            <?php // Button Edit // ?>
                            <a href="#" type="button" class="btn btn-success far fa-edit" data-toggle="modal" data-target="#myModal<?php echo $row['idClient']; ?>"></a>
                            <!-- <button class="btn btn-success far fa-edit" onclick="location.href='edit.php?id=<?php echo $row['idClient']; ?>'" data-toggle="modal" data-target="#myModal">
                              <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </button> -->
                            <?php // End of Button Edit
                                  // Button Hapus // ?>
                            <button class="btn btn-danger far fa-window-close" onclick="location.href='hapus.php?id=<?php echo $row['idClient']; ?>'" onclick="return confirm('are you sure?')">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <?php // End of Button Hapus // ?>
                        </div>
                    </td>
                      </tr>
                  <!-- Modal -->
 <!-- Modal Edit Mahasiswa-->
 <div class="modal fade" id="myModal<?php echo $row['idClient']; ?>" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Client</h4>
                  </div>
                  <div class="modal-body">
                    <form role="form" action="prosesEdit.php" method="get">
                        <?php
                        $id = $row['idClient']; 
                        $query_edit = mysqli_query($koneksi, "SELECT * FROM client WHERE idClient='$id'");
                        while ($row1 = mysqli_fetch_array($query_edit)) {  
                        ?>
                        <input type="hidden" name="id" value="<?php echo $row1['idClient']; ?>">
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="nama" class="form-control" value="<?php echo $row1['namaClient']; ?>">      
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <input type="text" name="alamat" class="form-control" value="<?php echo $row1['alamat']; ?>">      
                          </div>
                            <div class="form-group">
                              <label>No HP</label>
                              <input type="text" name="no_hp" class="form-control" value="<?php echo $row1['no_hp']; ?>">      
                            </div>
                            <div class="form-group">
                              <label>No KTP</label>
                              <input type="text" name="no_ktp" class="form-control" value="<?php echo $row1['no_ktp']; ?>">      
                            </div>
                            <div class="form-group">
                              <label>Paket Berlangganan</label>
                                <select name="paket" id="paket" class="form-control">
                                    <option value="<?php echo $row1['idPaket']; ?>"><?php echo $row['namaPaket']; ?></option>
                                    <option disabled>--- Pilih Paket ---</option>
                                    <?php
                                      $queryShowPaket = mysqli_query($koneksi, "SELECT * FROM paket WHERE status = '1'");
                                      while ($showPaket = mysqli_fetch_array($queryShowPaket)) {  
                                    ?>
                                      <option value="<?php echo $showPaket['idPaket']; ?>"><?php echo $showPaket['namaPaket'] . " - " . rupiah($showPaket['harga']) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                              <label>Status</label>
                                <div class="input-group">
                                  <select name="status" id="status" class="form-control">
                                      <?php
                                        if($row1['status'] == 1) { 
                                            echo '<option value="1">Aktif</option>';
                                        }
                                        ?>
                                      <option value="">-- Pilih Status --</option>
                                      <option value="1">Aktif</option>
                                      <option value="2">Tidak Aktif</option>
                                  </select>
                                </div>
                            </div>
                        <div class="modal-footer">  
                          <button type="submit" name="simpan" class="btn btn-success">Update</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                        <?php 
                        }
                        ?>        
                      </form>
                  </div>
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
                    <th>Layanan</th>
                    <th>Alamat</th>
                    <th>WA</th>
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
   $("#table_client").DataTable({
       "responsive": true,
       "lengthChange": false,
       "autoWidth": false,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
   }).buttons().container().appendTo('#table_client_wrapper .col-md-6:eq(0)');
});
</script>
 <?php 
//  include '../footer.php';
//  include '../footerTable.php'; ?>
