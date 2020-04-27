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
    <title>Laporan Data dan Stok Barang</title>
    <link rel="stylesheet" href="../../css/myLaporanCSS.css"/>
</head>
<body onload="window.print()">
<div id="laporan">

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px"><center><h2 style="margin-bottom:0px">Laporan Data dan Stok Barang</h2></center><br/></td>
</tr>
</table>

<table border="1" align="center" style="width:900px;margin-bottom:20px;">
<?php 
    $que = mysqli_query($conn, 'SELECT * FROM `kategori` WHERE 1');
    while ($rowKat = mysqli_fetch_array($que, MYSQLI_ASSOC)){
        $idkat = $rowKat['id_kategori'];
        $nmkat = $rowKat['kategori'];
        $sql = "SELECT `id_barang`,`nama_brg`,`stok`,`satuan`,`harga` FROM `barang`
                INNER JOIN kategori ON kategori.id_kategori = barang.id_kategori
                WHERE barang.id_kategori = '$idkat'";
        $query = mysqli_query($conn, $sql) or die (mysqli_error());
        echo "</table><br>";
        echo "<table align='center' width='900px;' border='1'>";
        echo "<tr><td colspan='6'><b>Kategori: $nmkat</b></td> </tr>";
        echo "<tr style='background-color:#ccc;'>
            <td width='4%' align='center'>No</td>
            <td width='10%' align='center'>ID Barang</td>
            <td width='40%' align='center'>Nama Barang</td>
            <td width='10%' align='center'>Satuan</td>
            <td width='20%' align='center'>Harga Jual</td>
            <td width='30%' align='center'>Stok</td>
            
            </tr>";
        $count = 1;
        while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)){
            $id_barang = $data['id_barang'];
            $nama_brg = $data['nama_brg'];
            $stok = $data['stok'];
            $satuan = $data['satuan'];
            $harga = $data['harga'];
            echo "<tr style='background-color:#fff;'>
            <td width='4%' align='center'>$count</td>
            <td width='10%' align='center'>$id_barang</td>
            <td width='40%' align='center'>$nama_brg</td>
            <td width='10%' align='center'>$satuan</td>
            <td width='20%' align='center'>$harga</td>
            <td width='30%' align='center'>$stok</td>
            </tr>";
            $count++;
        }
    }
?>
</table>

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