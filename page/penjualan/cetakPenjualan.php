<?php
    session_start();
    include "../../koneksi.php";
    $id = $_GET["id"];
    $result1 = mysqli_query($conn,"SELECT * FROM transaksi_penjualan 
                            INNER JOIN karyawan ON karyawan.id_karyawan = transaksi_penjualan.id_karwayan
                            WHERE id_transaksi='$id' LIMIT 1");
    $row = mysqli_fetch_assoc($result1);
    // echo '<pre>' . var_export($row, true) . '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faktur Nota</title>
    <link rel="stylesheet" href="../../css/myLaporanCSS.css"/>
</head>
<body onload="window.print()" style="width: 300px">
    <table style="width:300px;border:none;font-size:10px">
        <tr>
            <th style="text-align:left;">No Faktur Nota</th>
            <th style="text-align:left;">: <?php echo $row['id_transaksi'];?></th>
            <th style="text-align:left;">Kasir</th>
            <th style="text-align:left;">: <?php echo $row['nama'];?></th>
        </tr>
        <tr>
            <th style="text-align:left;">Tanggal</th>
            <th style="text-align:left;">: <?php echo $row['tgl_transaksi'];?></th>
            
        </tr>
    </table><br>
    <table style="width:300px; text-align:center">
    <thead>
        <tr>
            <th>Nama Barang</th>
            <th>Satuan</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>SubTotal</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $sql = "SELECT detail_penjualan.id_transaksi, karyawan.nama, total, barang.nama_brg, satuan, barang.harga, jml_barang
            FROM `transaksi_penjualan`
            INNER JOIN detail_penjualan ON detail_penjualan.id_transaksi = transaksi_penjualan.id_transaksi
            INNER JOIN karyawan ON karyawan.id_karyawan = transaksi_penjualan.id_karwayan
            INNER JOIN barang ON barang.id_barang = detail_penjualan.id_barang
            WHERE detail_penjualan.id_transaksi = '$id'";
    $query = mysqli_query($conn, $sql) or die (mysqli_error());

    while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $sub = 0;
        $nabar = $data["nama_brg"];
        $satuan = $data["satuan"];
        $qty = $data["jml_barang"];
        $harga = $data["harga"];
        $sub = $qty * $harga;
        $total = $data["total"]
    ?>
        <tr>
            <td style="text-align:left;"><?php echo $nabar;?></td>
            <td style="text-align:center;"><?php echo $satuan;?></td>
            <td style="text-align:center;"><?php echo $qty;?></td>
            <td style="text-align:right;"><?php echo number_format($harga,0,',','.');?></td>
            <td style="text-align:right;"><?php echo number_format($sub,0,',','.');?></td>
        </tr>
    <?php }?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" style="text-align:right;"><b>Total</b></td>
            <td style="text-align:right;"><b><?php echo 'Rp'.number_format($total,2,",",".");?></b></td>
        </tr>
    </tfoot>
    </table><br>
    <table style="width:300px;border:none;">
        <tr style="text-align:center;">
            <td>~Terima Kasih~</td>
            <td>Hormat Kami</td>
        </tr>
    </table>
    <div style="text-align:right; margin:40px 15px 0 0">
        (.....................................)
    </div>
</body>
</html>