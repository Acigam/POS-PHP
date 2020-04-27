<?php 
include 'fungsiTransaksi.php';
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["kuantitas"])) {
			$que = "SELECT * FROM barang WHERE id_barang='" . $_POST["idbar"] . "'";
			$result = mysqli_query($conn,$que);
			while($row=mysqli_fetch_assoc($result)) {
				$resultset[] = $row;
			};
			$productByCode = $resultset;
			
			$itemArray = array($productByCode[0]["id_barang"]=>array('id_barang'=>$productByCode[0]["id_barang"], 
			'nama_brg'=>$productByCode[0]["nama_brg"], 'satuan'=>$productByCode[0]["satuan"], 'kuantitas'=>$_POST["kuantitas"],
			'harga'=>$productByCode[0]["harga"]));
			
			if(!empty($_SESSION["cartList"])) {
				if(in_array($productByCode[0]["id_barang"],array_keys($_SESSION["cartList"]))) {
					foreach($_SESSION["cartList"] as $k => $v) {
							if($productByCode[0]["id_barang"] == $k) {
								if(empty($_SESSION["cartList"][$k]["kuantitas"])) {
									$_SESSION["cartList"][$k]["kuantitas"] = 0;
								}
								$_SESSION["cartList"][$k]["kuantitas"] += $_POST["kuantitas"];
								if ($_SESSION["cartList"][$k]["kuantitas"] > $resultset[0]["stok"]) {
									$_SESSION["cartList"][$k]["kuantitas"] = $resultset[0]["stok"];
									$_SESSION["error"] = "Qty melebihi stok, qty dijadikan max stok.";
								}
							}
					}
				} else {
					$_SESSION["cartList"] = array_merge($_SESSION["cartList"],$itemArray);
				}
			} else {
				$_SESSION["cartList"] = $itemArray;
			}
		}
		// echo '<pre>' . var_export($_SESSION, true) . '</pre>';
	break;

	case "remove":
		if(!empty($_SESSION["cartList"])) {
			foreach($_SESSION["cartList"] as $k => $v) {
					if($_GET["id_barang"] == $k)
						unset($_SESSION["cartList"][$k]);				
					if(empty($_SESSION["cartList"]))
						unset($_SESSION["cartList"]);
			}
		}
	break;
  case "empty":
		unset($_SESSION["cartList"]);
	break;	
}
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-900" style="display:inline-block; margin-bottom:20px">Transaksi&nbsp</h1>
	Penjualan&nbsp
	<?php
    if (isset($_SESSION["error"])) {
        echo "<a style='color:red'>Message: ".$_SESSION['error']."</a>" ;
        unset($_SESSION["error"]);
    }
    if (isset($_SESSION["pesan"])) {
      echo "<a style='color:green'>Message: ".$_SESSION['pesan']."</a>" ;
      unset($_SESSION["pesan"]);
    }
    if (isset($_GET["id"])) {
      $idaa = $_GET["id"];
      echo "<form action='page/penjualan/cetakPenjualan.php' style='display:inline' target='_blank'>
              <input type='text' name='id' value='$idaa' hidden>
              <button type='submit' class='btn btn-success btn-icon-split' style='padding:0 5px;'>
                Cetak Nota
              </button>
            </form>";
      
    }
  ?>
  <br>

	<div class="row">
		<div class="col-xl-4 col-md-4 mb-4">
			<div class="card border-left-info shadow h-100">
				
				<div class="card" style="padding: 0.5rem 1.5rem; border:none">
					<div class="form-group row">
						<label class="col-sm-4 col-form-label" style="color:black">Date</label>
						<div class="col-sm-8">
							<label class="col-sm-8 col-form-label" style="color:black"><?php echo date("Y/m/d");?></label>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-4 col-form-label" style="color:black">Kasir*</label>
						<div class="col-sm-8">
							<form action="page/penjualan/insertPenjualan.php" id="insertPenjualan" method="post">
							<select name="idkarpen" class="form-control" data-width="80%" required>
								<option value="" disabled selected hidden>ID Karyawan</option>
							<?php
							$sql = "SELECT * FROM karyawan";
							$query = mysqli_query($conn, $sql) or die (mysqli_error());
							while($data = mysqli_fetch_array($query)){
									$id = $data["id_karyawan"];
									$nama = $data["nama"];?>
									<option value="<?php echo $id;?>"><?php echo $id." - ".$nama;?></option>
              <?php } 
              $_SESSION['kasir']="";
              ?>
							</select>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-5 col-md-5 mb-4">
			<div class="card border-left-info shadow h-100">
				
				<div class="card" style="padding: 0.5rem 1.5rem; border:none">
					<form action="?page=penjualan&action=add" method="post">
						<div class="form-group row">
							<label class="col-sm-3 col-form-label" style="color:black">ID Barang</label>
							<div class="col-sm-8">
								<input name="idbar" class="form-control" id="ID_barang" required>
							</div>
							<div class="col-sm-1" style="padding-left: 0.1rem">
								<a href="#" class="btn btn-secondary btn-icon-split" data-toggle='modal' data-target='#modalCariBarang'
									style="padding:10px 10px"><i class="fas fa-search"></i>
								</a>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-3 col-form-label" style="color:black">Kuantitas</label>
							<div class="col-sm-3">
									<input name="kuantitas" class="form-control" type="number" min="1" id="QTY_barang" required>
							</div>
							<div class="col-sm-6" style="display: flex; align-items: center; justify-content: flex-end; padding-right: 0.1rem">
								<!-- Submit Button Tambah Barang ke List -->
								<button type="submit" class="btn btn-primary btn-icon-split" style="padding:6px 10px;">
									<i class="fas fa-shopping-cart" style="margin:auto"></i>
									&nbspTambah
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-5 mb-4">
			<div class="card border-left-info shadow h-100">
				<div class="card" style="padding: 0 1.5rem; border:none">
					<div class="row" style="text-align:center; padding: 0.8rem 1rem;">
						<a style="text-align:center;margin-left: auto; margin-right: auto;">ID Transaksi</a>
					</div>
					<div class="row">
						<a style="font-weight: bold; font-size:25px; color:black; text-align:center;margin-left: auto; margin-right: auto;"><?php echo getIDT($conn); ?></a>
					</div>
				</div>
			</div>
		</div>
  
		<?php
		if(isset($_SESSION["cartList"])){
				$total_quantity = 0;
				$total_price = 0;
		?>
    <!-- Table -->
		<div class="card shadow mb-2 col-xl-12">
		<div class="card-body" style="padding: .75rem 0 0 0">
		<div class="table-responsive">
			<table class="table table-bordered"  width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>ID Barang</th>
						<th>Nama Barang</th>
						<th>Satuan</th>
						<th>Qty</th>
						<th>Harga</th>
						<th>Sub Total</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php
					$counter = 1;
					foreach ($_SESSION["cartList"] as $item){
							$item_price = $item["kuantitas"]*$item["harga"];
					?>
							<tr>
							<td><?php echo $counter++ ?></td>
							<td><?php echo $item["id_barang"]; ?></td>
							<td><?php echo $item["nama_brg"]; ?></td>
							<td style="text-align:center"><?php echo $item["satuan"]; ?></td>
							<td style="text-align:right;"><?php echo $item["kuantitas"]; ?></td>
							<td style="text-align:right;"><?php echo number_format($item["harga"],0,",","."); ?></td>
							<td style="text-align:right;"><?php echo number_format($item_price,0,",","."); ?></td>
							<td style="text-align:center"><a style="color: rgb(255,0,0);" href="?page=penjualan&action=remove&id_barang=<?php echo $item["id_barang"]; ?>"><i class="fas fa-times"></i></a></td>
							</tr>
							<?php
							$total_quantity += $item["kuantitas"];
							$total_price += ($item["harga"]*$item["kuantitas"]);
					}
					?>
							</tr>
							<td colspan="4" align="right">Total:</td>
							<td style="text-align:right;"><?php echo $total_quantity; ?></td>
							<td style="text-align:right;" colspan="2"><strong><?php echo "Rp".number_format($total_price,2,",","."); ?></strong></td>
              <input type="hidden" name="totalpen" form="insertPenjualan" value="<?php echo $total_price; ?>">
							<td></td>
							</tr>
							</tbody>
							</table>		
		<?php
		} else {
		?>
		<div class="card shadow mb-2 col-xl-12">
			<div class="card-body" style="padding: .75rem 0 0 0">
				<div class="table-responsive">
					<table class="table table-bordered"  width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>#</th>
								<th>ID Barang</th>
								<th>Nama Barang</th>
								<th>Satuan</th>
								<th>Qty</th>
								<th>Harga</th>
								<th>Sub Total</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							</tr>
							<td colspan="4" align="right">Total:</td>
							<td style="text-align:right;">0</td>
							<td style="text-align:right;" colspan="2"><strong>Rp0,00</strong></td>
							<td></td>
							</tr>
							</tbody>
							</table>
							<?php 
							}
							?>
							</div>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	<!-- </form> -->

	<!-- The Modal Cari -->
	<div class="modal fade" id="modalCariBarang">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
			
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Data Barang</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				
				<!-- Modal body -->
				<div class="modal-body">
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
												<a href='#' class='btn btn-info btn-icon-split' data-dismiss="modal" type="button" 
													 onclick="pilihID('<?php echo $id; ?>','<?php echo $stok; ?>')" style='padding:0 12px'>Pilih</a>
											</td>
										</tr>
								<?php
									$counter++;
									}
								?>
							</tbody>
						</table>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-sm-12" style="display: flex; justify-content: flex-end;">
		<a class="btn btn-danger btn-icon-split" style="padding:6px 10px;" href="?page=penjualan&action=empty">
		<i class="fas fa-trash"style="margin:auto"></i>&nbspEmpty</a>
			<!-- Submit Button Transaksi -->
			<button form="insertPenjualan" type="submit" class="btn btn-success btn-icon-split" style="padding:6px 10px; margin-left:10px">
				<i class="fas fa-paper-plane" style="margin:auto"></i>
				&nbspSubmit
			</button>
	</div>
  <br><br>





</div>
<script>
	document.getElementById("ID_barang").addEventListener("input", qtyMax);
	function qtyMax(){
		var elem = document.getElementById("ID_barang");
		<?php 
		$sql = "SELECT `stok`FROM `barang` WHERE  ";	
		?>
		var qtyEL = document.getElementById("QTY_barang");
		qtyEL.setAttribut("max", pilihID(elem.value,));
	}
</script>
<script>
	function pilihID(id, stok) // no ';' here
	{		
			var elem = document.getElementById("ID_barang");
			elem.value = id;
			var qtyEL = document.getElementById("QTY_barang");
			qtyEL.setAttribute("max", stok);
	}
</script>
