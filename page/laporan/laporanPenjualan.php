<?php
    session_start();
    include "../../koneksi.php";
    
    // echo '<pre>' . var_export($row, true) . '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="../../css/myLaporanCSS.css"/>
</head>
<body onload="window.print()">
<div id="laporan">

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px"><center><h2 style="margin-bottom:0px">Laporan Penjualan</h2></center><br/></td>
</tr>
</table>

<table align='center' width='900px;' border='1'>";
<thead>
    <tr>
        <th style="width:50px;">No</th>
        <th>ID Penjualan</th>
        <th>Karyawan</th>
        <th>Tanggal</th>
        <th>Total</th>
        <th>ID Barang</th>
        <th>Nama Barang</th>
        <th>Satuan</th>
        <th>Harga Jual</th>
        <th>Qty</th>
        <th>Sub</th>
    </tr>
</thead>
<tbody>
    <?php 
    $sql = "SELECT detail_penjualan.id_transaksi, tgl_transaksi, karyawan.nama, total, barang.id_barang, 
            barang.nama_brg, satuan, barang.harga, jml_barang
            FROM `transaksi_penjualan`
            INNER JOIN detail_penjualan ON detail_penjualan.id_transaksi = transaksi_penjualan.id_transaksi
            INNER JOIN karyawan ON karyawan.id_karyawan = transaksi_penjualan.id_karwayan
            INNER JOIN barang ON barang.id_barang = detail_penjualan.id_barang ORDER BY detail_penjualan.id_transaksi";
    $query = mysqli_query($conn, $sql) or die (mysqli_error());
    $tempid = "";
    $count = 1;
    while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $sub = 0;
        $idTransaksi = $data['id_transaksi'];
        $tglTransaksi = $data['tgl_transaksi'];
        $total = $data['total'];
        $nmkar = $data['nama'];
        $idbar = $data["id_barang"];
        $nabar = $data["nama_brg"];
        $satuan = $data["satuan"];
        $qty = $data["jml_barang"];
        $harga = $data["harga"];
        $sub = $qty * $harga;
        $total = $data["total"]
        ?>
        <tr>
            <?php
                if ($tempid != $idTransaksi) {
                    $tempid = $idTransaksi;?>
                    <td style="text-align:center;"><?php echo $count;?></td>
                    <td style="padding-left:5px;"><?php echo $idTransaksi;?></td>
                    <td style="text-align:center;"><?php echo $nmkar;?></td>
                    <td style="text-align:center;"><?php echo $tglTransaksi;?></td>
                    <td style="text-align:center;"><?php echo 'Rp'.number_format($total,0,",",".");?></td>
                    
                <?php $count++;}else { ?>
                   <td style="text-align:center;"></td>
                   <td style="padding-left:5px;"></td>
                   <td style="text-align:center;"></td>
                   <td style="text-align:center;"></td> 
                   <td style="text-align:center;"></td> 
                <?php }
            ?>
            <td style="text-align:center;"><?php echo $idbar;?></td>
            <td style="text-align:left;"><?php echo $nabar;?></td>
            <td style="text-align:center;"><?php echo $satuan;?></td>
            <td style="text-align:right;"><?php echo 'Rp'.number_format($harga,0,",",".");?></td>
            <td style="text-align:center;"><?php echo $qty;?></td>
            <td style="text-align:right;"><?php echo 'Rp'.number_format($sub,0,",",".");?></td>
        </tr>
    <?php
    }
    ?>
</tbody>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Palembang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right" style="padding-right:37px">Manager</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</div>
</body>
</html>