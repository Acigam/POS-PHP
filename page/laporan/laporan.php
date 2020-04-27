<?php
    // var_dump($_SESSION);
    // if (isset($_SESSION["pesan"])) {
    //   echo $_SESSION["pesan"];
    //   unset($_SESSION["pesan"]);
    // }
    if ($_SESSION["username"] != "admin") {
      header("Location: index.php");
      exit;
    }
?>
<!-- Begin Page Content -->
<div class="container">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800" style="visibility: hidden">Laporan</h1>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style="display:inline">Data Laporan</h6>
  </div>
  <div class="card-body row" id="laporanContainer">
    <div class="col-sm-4">
        <a href="page/laporan/laporanBarang.php" target="_blank" class="btn btn-primary btn-icon-split">Laporan Data dan Stok Barang</a>
    </div>
    <div class="col-sm-4">
        <a href="page/laporan/laporanPenjualan.php" target="_blank" class="btn btn-success btn-icon-split">Laporan Penjualan</a>
    </div>
    <div class="col-sm-4">
        <a href="#" data-toggle='modal' data-target='#lapJualPerTanggal' class="btn btn-info btn-icon-split">Laporan Penjualan per Tanggal</a>
    </div>
    <div class="col-sm-4">
        <a href="#" data-toggle='modal' data-target='#lapJualPerBulan' class="btn btn-warning btn-icon-split">Laporan Penjualan per Bulan</a>
    </div>
  </div>
</div>
<br><br><br><br><br>
</div>
<!-- /.container-fluid -->

<!-- The Modal Penjualan per Tanggal -->
<div class="modal fade" id="lapJualPerTanggal">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pilih Tanggal</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
      <form class="form-horizontal" method="post" action="page/laporan/laporanPenjualanPerTgl.php" target="_blank">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tanggal</label>
          <div class="col-sm-10">
            <div class='input-group date' id='datepicker' style="width:300px;">
                <input type='date' name="tgl" class="form-control" value="" placeholder="Tanggal..." required/>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Cetak</button>
      </div>

      </form>
    </div>
  </div>
</div>

<!-- The Modal Penjualan per Tanggal -->
<div class="modal fade" id="lapJualPerBulan">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Pilih Bulan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
      <form class="form-horizontal" method="post" action="page/laporan/laporanPenjualanPerBln.php" target="_blank">
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Bulan</label>
          <div class="col-sm-10">
            <select name="bulan" class="form-control" title="Bulan" data-width="80%" required>
              <option value="" disabled selected hidden>Pilih Bulan</option>
              <?php
              $sql = "SELECT DISTINCT DATE_FORMAT(tgl_transaksi,'%M %Y') AS date FROM `transaksi_penjualan`";
              $query = mysqli_query($conn, $sql) or die (mysqli_error());
              while($data = mysqli_fetch_array($query)){
                  $bulan = $data["date"];?>
                  <option value="<?php echo $bulan;?>"><?php echo $bulan;?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Cetak</button>
      </div>

      </form>
    </div>
  </div>
</div>