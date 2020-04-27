<?php
session_start();
include "../../koneksi.php";
include "fungsiTransaksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Penjualan</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

echo '<pre>' . var_export($_SESSION, true) . '</pre>';
$idTransaksi = getIDT($conn);

if(!empty($_SESSION["cartList"])) {
    $idkarpen = $_POST['idkarpen'];
    $totalpen = $_POST['totalpen'];
    $queryPenjualan = "INSERT INTO `transaksi_penjualan` (`id_transaksi`, `id_karwayan`, `tgl_transaksi`, `total`) 
                       VALUES ('$idTransaksi', '$idkarpen', current_timestamp(), '$totalpen');";
    // echo "<br>".$queryPenjualan;
    if ($conn->query($queryPenjualan) === TRUE) {
        $counter = 0;
        foreach ($_SESSION['cartList'] as $key => $value) {
            $idBarang = $_SESSION["cartList"][$key]['id_barang'];
            $kuantitasBarang = $_SESSION["cartList"][$key]['kuantitas'];
            $queryDetail = "INSERT INTO `detail_penjualan` (`id_transaksi`, `id_barang`, `jml_barang`) 
                            VALUES ('$idTransaksi', '$idBarang', '$kuantitasBarang')";
            $conn->query($queryDetail);
            $conn->query("UPDATE barang SET stok=stok-'$kuantitasBarang' WHERE id_barang='$idBarang'");
            $counter++;
            // echo "<br>".$queryDetail;
        }
        unset($_SESSION["cartList"]);
        $_SESSION['pesan'] = "Submit berhasil";
        header("location: ../../index.php?page=penjualan&id=$idTransaksi");
        // header("location: cetakPenjualan.php?id=$idTransaksi");
    }else {
        $_SESSION['error'] = "Submit gagal! ".$conn->error;
        header("location: ../../index.php?page=penjualan");
    }
}else {
    $_SESSION['pesan'] = "Daftar belanja kosong!";
    header("location: ../../index.php?page=penjualan");
}

?>

</body>
</html>