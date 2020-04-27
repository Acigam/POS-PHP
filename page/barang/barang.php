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
<h1 class="h3 mb-2 text-gray-800">Barang</h1>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style="display:inline">Data Barang</h6>
    <a href="#" class="btn btn-success btn-icon-split" data-toggle='modal' data-target='#modalTambahBarang' style="float:right; padding:4px">Tambah Barang</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
            // query sql
            $sql = "SELECT `id_barang`,`nama_brg`,kategori.id_kategori,kategori.kategori,`stok`,`satuan`,`harga`
                    FROM `barang`
                    INNER JOIN `kategori` ON barang.id_kategori=kategori.id_kategori";
            $query = mysqli_query($conn, $sql) or die (mysqli_error());
            $counter = 1;
            while($data = mysqli_fetch_array($query)){
                
                $id = $data["id_barang"];
                $nama = $data["nama_brg"];
                $kategori = $data["kategori"];
                $idkategori = $data["id_kategori"];
                $stok = $data["stok"];
                $satuan = $data["satuan"];
                $harga = $data["harga"]; ?>
                
              <?php echo 
              "<tr>
                <td>$counter</td>
                <td>$id</td>
                <td>$nama</td>
                <td>$kategori</td>
                <td>$stok</td>
                <td>$satuan</td>
                <td>$harga</td>"?>
                <td>
                  <a href='#' class='btn btn-warning btn-icon-split' data-toggle='modal' data-target='#modalEditBarang<?php echo $id?>' style='padding:0 3px'>Edit</a>
                  <a href='#' class='btn btn-danger btn-icon-split'data-toggle='modal' data-target='#modalHapusBarang<?php echo $id?>' style='padding:0 3px'>Hapus</a>
                </td>
              </tr>

              <!-- The Modal Tambah -->
              <div class="modal fade" id="modalTambahBarang">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Barang</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/barang/tambahBarang.php" method="get">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                          <input name="nmbar" class="form-control" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                          <select name="katebar" class="form-control" title="Pilih Kategori" data-width="80%" required>
                            <option value="" disabled selected hidden>Pilih Kategori</option>
                          <?php
                          $sqlKategori = "SELECT *FROM `kategori`";
                          $queryKategori = mysqli_query($conn, $sqlKategori) or die (mysqli_error());
                          while($kat = mysqli_fetch_array($queryKategori)){
                              $id_kat = $kat["id_kategori"];
                              $nm_kat = $kat["kategori"];?>
                              <option value="<?php echo $id_kat;?>"><?php echo $nm_kat;?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                          <input name="stokbar" class="form-control" type="number" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                          <input name="satuanbar" class="form-control" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                          <input name="hargabar" class="form-control" type="number" required>
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
              <div class="modal fade" id="modalEditBarang<?php echo $id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Barang</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/barang/editBarang.php" method="get">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ID Barang</label>
                        <div class="col-sm-10">
                          <input name="idbar" class="form-control" value="<?php echo $id;?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                          <input name="nmbar" class="form-control" value="<?php echo $nama;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                          <select name="katebar" class="form-control" title="Pilih Kategori" data-width="80%" 
                          placeholder="Pilih Kategori" required>
                          <?php
                          $sqlKategori = "SELECT *FROM `kategori`";
                          $queryKategori = mysqli_query($conn, $sqlKategori) or die (mysqli_error());
                          while($kat = mysqli_fetch_array($queryKategori)){
                              $id_kat = $kat["id_kategori"];
                              $nm_kat = $kat["kategori"];
                              if($id_kat==$idkategori)
                                  echo "<option value='$id_kat' selected>$nm_kat</option>";
                              else
                                  echo "<option value='$id_kat'>$nm_kat</option>";
                          }?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                          <input name="stokbar" class="form-control" type="number" value="<?php echo $stok;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Satuan</label>
                        <div class="col-sm-10">
                          <input name="satuanbar" class="form-control" value="<?php echo $satuan;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                          <input name="hargabar" class="form-control" type="number" value="<?php echo $harga;?>" required>
                        </div>
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
              <div class="modal fade" id="modalHapusBarang<?php echo $id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Barang</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/barang/hapusBarang.php" method="get">
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <p>Yakin ingin menghapus data barang <?php echo $id ?>?</p>
                          <input name="idbar" class="form-control" type="hidden" value="<?php echo $id; ?>" required>
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

