<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$q = "SELECT MAX(RIGHT(id_barang,5)) AS id_max FROM barang";
$result = $conn->query($q);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $tmp = ((int)$row['id_max'])+1;
        $kd = sprintf("%05s", $tmp);
    }
}
else{
    $kd = "00001";
}
$idbar = "BR".$kd;

$nmbar = $_GET['nmbar'];
$katebar = $_GET['katebar'];
$stokbar = $_GET['stokbar'];
$satuanbar = $_GET['satuanbar'];
$hargabar = $_GET['hargabar'];

//query update
$query = "INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_brg`, `stok`, `satuan`, `harga`) 
          VALUES ('$idbar', '$katebar', '$nmbar', '$stokbar', '$satuanbar', '$hargabar')";
// echo "<br>".$query;
if (mysqli_query($conn, $query)) {
    // $_SESSION['pesan'] = "Data barang berhasil diedit";

    // echo "<script>
    //     alert('There are no fields to generate a report');
    //     window.location.href='../../index.php?page=barang';
    //     </script>";

    // header("location: ../../index.php?page=barang");
    
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data barang berhasil ditambah',
        showConfirmButton: false,
        timer: 1000
    })
    .then(function (result) {
    if (true) {
        window.location = '../../index.php?page=barang';
    }
    })
</script>";
}
else{
    echo "Error, data gagal ditambah". mysqli_error();
}
?>

</body>
</html>