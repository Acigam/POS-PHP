
<br><br><br><br>
<div class="col-lg-12" style="padding: 0">
    <div class="card mb-4 border-left-primary shadow" >
        <div class="card-body">
            <h3 style="color:black; text-align:center">Selamat Bekerja :a</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penjualan hari ini</div>
                <?php 
                $query = "SELECT id_transaksi FROM transaksi_penjualan WHERE DATE(tgl_transaksi)=CURDATE()";
                $result = mysqli_query($conn, $query); 
                $row = mysqli_num_rows($result);
                ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-check fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penjualan bulan ini</div>
                <?php 
                $query = "SELECT id_transaksi FROM transaksi_penjualan WHERE MONTH(tgl_transaksi)=MONTH(CURDATE())";
                $result = mysqli_query($conn, $query); 
                $row2 = mysqli_num_rows($result);
                ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row2 ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah data barang</div>
                <?php 
                $query = "SELECT * FROM barang";
                $result = mysqli_query($conn, $query); 
                $row3 = mysqli_num_rows($result);
                ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row3 ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-th fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Uang masuk hari ini</div>
                <?php 
                $query = "SELECT sum(total) FROM transaksi_penjualan";
                $result = mysqli_query($conn, $query); 
                $row4 = $result->fetch_assoc();
                ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo ("Rp".number_format($row4["sum(total)"],0,',','.')); ?></div>
            </div>
            <div class="col-auto">
                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
            </div>
        </div>
        </div>
    </div>
    
</div>
<br><br><br><br>