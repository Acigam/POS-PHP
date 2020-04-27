<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$idkar = $_GET['idkar'];
$nmkar = $_GET['nmkar'];
$almtkar = $_GET['almtkar'];
$jkkar = $_GET['jkkar'];
$telpkar = $_GET['telpkar'];

//query update
$query = "UPDATE `karyawan` 
          SET `nama` = '$nmkar', `alamat` = '$almtkar', `jenis_kelamin` = '$jkkar', `no_telp` = '$telpkar' 
          WHERE `karyawan`.`id_karyawan` = $idkar;";

if (mysqli_query($conn, $query)) {
    // $_SESSION['pesan'] = "Data karyawan berhasil diedit";

    // echo "<script>
    //     alert('There are no fields to generate a report');
    //     window.location.href='../../index.php?page=karyawan';
    //     </script>";

    // header("location: ../../index.php?page=karyawan");

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data karyawan berhasil diedit',
        showConfirmButton: false,
        timer: 1000
    })
    .then(function (result) {
    if (true) {
        window.location = '../../index.php?page=karyawan';
    }
    })
</script>";
}
else{
    echo "Error, data gagal diupdate". mysqli_error();
}
?>

</body>
</html>