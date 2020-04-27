<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Karyawan</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$idkar = $_GET['idkar'];

//query update
$query = "DELETE FROM `karyawan` WHERE `karyawan`.`id_karyawan` = $idkar";
// echo "<br>".$query;
if (mysqli_query($conn, $query)) {
    // $_SESSION['pesan'] = "Data karyawan berhasil diedit";

    // echo "<script>
    //     alert('There are no fields to generate a report');
    //     window.location.href='../../index.php?page=karyawan';
    //     </script>";

    // header("location: ../../index.php?page=karyawan");
    
    echo "<script>
        Swal.fire({
            icon: 'info',
            title: 'Data karyawan berhasil dihapus',
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
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Penghapusan Gagal..',
            text: 'Cannot delete or update a parent row: a foreign key constraint fails'
        })
        .then(function (result) {
        if (true) {
            window.location = '../../index.php?page=karyawan';
        }
    })
    </script>";
    // echo "<br>Error, data gagal ditambah<br>". mysqli_error($conn);
}
?>

</body>
</html>