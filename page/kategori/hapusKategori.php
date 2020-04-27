<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Kategori</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$idkat = $_GET['idkat'];

//query update
$query = "DELETE FROM kategori where id_kategori='$idkat'";
// echo "<br>".$query;
if (mysqli_query($conn, $query)) {
    // $_SESSION['pesan'] = "Data kategori berhasil diedit";

    // echo "<script>
    //     alert('There are no fields to generate a report');
    //     window.location.href='../../index.php?page=kategori';
    //     </script>";

    // header("location: ../../index.php?page=kategori");
    
    echo "<script>
        Swal.fire({
            icon: 'info',
            title: 'Data kategori berhasil dihapus',
            showConfirmButton: false,
            timer: 1000
        })
        .then(function (result) {
        if (true) {
            window.location = '../../index.php?page=kategori';
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
            window.location = '../../index.php?page=kategori';
        }
    })
    </script>";
    // echo "<br>Error, data gagal ditambah<br>". mysqli_error($conn);
}
?>

</body>
</html>