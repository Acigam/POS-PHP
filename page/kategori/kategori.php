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
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Kategori</h1>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style="display:inline">Data Kategori</h6>
    <a href="#" class="btn btn-success btn-icon-split" data-toggle='modal' data-target='#modalTambahKategori' style="float:right; padding:4px">Tambah Kategori</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTableKategori" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Kategori</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
            // query sql
            $sql = "SELECT * FROM kategori";
            $query = mysqli_query($conn, $sql) or die (mysqli_error());
            $counter = 1;
            while($data = mysqli_fetch_array($query)){
                
                $id = $data["id_kategori"];
                $kategori = $data["kategori"]; ?>
                
              <?php echo 
              "<tr>
                <td>$counter</td>
                <td>$kategori</td>"?>
                <td>
                  <a href='#' class='btn btn-warning btn-icon-split' data-toggle='modal' data-target='#modalEditKategori<?php echo $id?>' style='padding:0 3px'>Edit</a>
                  <a href='#' class='btn btn-danger btn-icon-split'data-toggle='modal' data-target='#modalHapusKategori<?php echo $id?>' style='padding:0 3px'>Hapus</a>
                </td>
              </tr>

              <!-- The Modal Tambah -->
              <div class="modal fade" id="modalTambahKategori">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Kategori</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/kategori/tambahKategori.php" method="get">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                          <input name="nmkat" class="form-control" placeholder="Masukkan nama kategori" required>
                        </div>
                      </div>
                      </div>
                    
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- The Modal Edit -->
              <div class="modal fade" id="modalEditKategori<?php echo $id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Kategori</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/kategori/editKategori.php" method="get">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                          <input name="nmkat" class="form-control" value="<?php echo $kategori;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <input type ="hidden" name="idkat" class="form-control hidden" value="<?php echo $id;?>" readonly>
                      </div>
                    </div>
                    
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Update</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- The Modal Hapus -->
              <div class="modal fade" id="modalHapusKategori<?php echo $id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Kategori</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/kategori/hapusKategori.php" method="get">
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <p>Pastikan tidak ada barang dengan kategori ini agar dapat dihapus!</p>
                          <p>Yakin ingin menghapus data kategori <?php echo $kategori ?>?</p>
                          <input type ="hidden" name="idkat" class="form-control hidden" value="<?php echo $id;?>" readonly>
                          <input name="nmkat" class="form-control" type="hidden" value="<?php echo $kategori; ?>" required>
                        </div>
                      </div>
                    
                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <?php
                $counter++;
            }
        ?>
          <!-- <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
            <td>$320,800</td>
          </tr>-->
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<!-- /.container-fluid -->

