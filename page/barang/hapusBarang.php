<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Barang</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$idbar = $_GET['idbar'];

//query update
$query = "DELETE FROM barang where id_barang='$idbar'";
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
        icon: 'info',
        title: 'Data barang berhasil dihapus',
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