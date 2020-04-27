<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$idbar = $_GET['idbar'];
$nmbar = $_GET['nmbar'];
$katebar = $_GET['katebar'];
$stokbar = $_GET['stokbar'];
$satuanbar = $_GET['satuanbar'];
$hargabar = $_GET['hargabar'];

//query update
$query = "UPDATE `barang` 
          SET `id_kategori` = '$katebar', `nama_brg` = '$nmbar', `stok` = '$stokbar', `satuan` = '$satuanbar',
           `harga` = '$hargabar'  WHERE `barang`.`id_barang` = '$idbar';";
echo $query;
if (mysqli_query($conn, $query)) {
    // $_SESSION['pesan'] = "Data barang berhasil diedit";

    // echo "<script>
    //     alert('There are no fields to generate a report');
    //     window.location.href='../../index.php?page=barang';
    //     </script>";

    // header("location: ../../index.php?page=barang");

//     echo "<script>
//     Swal.fire({
//         icon: 'success',
//         title: 'Data barang berhasil diedit',
//         showConfirmButton: false,
//         timer: 1000
//     })
//     .then(function (result) {
//     if (true) {
//         window.location = '../../index.php?page=barang';
//     }
//     })
// </script>";
}
else{
    echo "Error, data gagal diupdate". mysqli_error();
}
?>

</body>
</html>