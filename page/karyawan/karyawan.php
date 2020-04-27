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
<h1 class="h3 mb-2 text-gray-800">Karyawan</h1>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary" style="display:inline">Data Karyawan</h6>
    <a href="#" class="btn btn-success btn-icon-split" data-toggle='modal' data-target='#modalTambahKaryawan' style="float:right; padding:4px">Tambah Karyawan</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Karyawan</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
            // query sql
            $sql = "SELECT * FROM karyawan";
            $query = mysqli_query($conn, $sql) or die (mysqli_error());
            $counter = 1;
            while($data = mysqli_fetch_array($query)){
                
                $id = $data["id_karyawan"];
                $nama = $data["nama"]; 
                $alamat = $data["alamat"]; 
                $jk = $data["jenis_kelamin"]; 
                $telp = $data["no_telp"]; ?>
                
              <?php echo 
              "<tr>
                <td>$counter</td>
                <td>$nama</td>
                <td>$alamat</td>
                <td>$jk</td>
                <td>$telp</td>"?>
                <td>
                  <a href='#' class='btn btn-warning btn-icon-split' data-toggle='modal' data-target='#modalEditKaryawan<?php echo $id?>' style='padding:0 3px'>Edit</a>
                  <a href='#' class='btn btn-danger btn-icon-split'data-toggle='modal' data-target='#modalHapusKaryawan<?php echo $id?>' style='padding:0 3px'>Hapus</a>
                </td>
              </tr>

              <!-- The Modal Tambah -->
              <div class="modal fade" id="modalTambahKaryawan">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Karyawan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/karyawan/tambahKaryawan.php" method="get">
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input name="nmkar" class="form-control" placeholder="" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <input name="almtkar" class="form-control" placeholder="" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="custom-control custom-radio custom-control-solid col-sm-1" style="padding-left:2.5rem; margin: auto 0;">
                            <input class="custom-control-input" id="customRadioSolidT<?php echo $id?>" type="radio" name="jkkar" value="L">
                            <label class="custom-control-label" for="customRadioSolidT<?php echo $id?>">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-solid col-sm-1" style="padding-left:2.5rem; margin: auto 0;">
                            <input class="custom-control-input" id="customRadioSolidT<?php echo $id.".2"?>" type="radio" name="jkkar" value="P">
                            <label class="custom-control-label" for="customRadioSolidT<?php echo $id.".2"?>">P</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                          <input name="telpkar" class="form-control" placeholder="" required>
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
              <div class="modal fade" id="modalEditKaryawan<?php echo $id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Karyawan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/karyawan/editKaryawan.php" method="get">
                      <div class="form-group row">
                        <input type ="hidden" name="idkar" class="form-control hidden" value="<?php echo $id;?>" readonly>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input name="nmkar" class="form-control" value="<?php echo $nama;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <input name="almtkar" class="form-control" value="<?php echo $alamat;?>" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="custom-control custom-radio custom-control-solid col-sm-1" style="padding-left:2.5rem; margin: auto 0;">
                            <input class="custom-control-input" id="customRadioSolidE<?php echo $id?>" type="radio" name="jkkar" value="L" <?php if (isset($jk) && $jk=="L") echo "checked";?>>
                            <label class="custom-control-label" for="customRadioSolidE<?php echo $id?>">L</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-solid col-sm-1" style="padding-left:2.5rem; margin: auto 0;">
                            <input class="custom-control-input" id="customRadioSolidE<?php echo $id.".2"?>" type="radio" name="jkkar" value="P" <?php if (isset($jk) && $jk=="P") echo "checked";?>>
                            <label class="custom-control-label" for="customRadioSolidE<?php echo $id.".2"?>">P</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Telepon</label>
                        <div class="col-sm-10">
                          <input name="telpkar" class="form-control" value="<?php echo $telp;?>" required>
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
              <div class="modal fade" id="modalHapusKaryawan<?php echo $id?>">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus Karyawan</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    <form role="form" action="page/karyawan/hapusKaryawan.php" method="get">
                      <div class="form-group row">
                        <div class="col-sm-10">
                          <p>Jika ada data karyawan pada penjualan maka akan menjadi NULL!</p>
                          <p>Yakin ingin menghapus data karyawan <?php echo $nama ?>?</p>
                          <input type ="hidden" name="idkar" class="form-control hidden" value="<?php echo $id;?>" readonly>
                          <input name="nmkar" class="form-control" type="hidden" value="<?php echo $nama; ?>" required>
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

