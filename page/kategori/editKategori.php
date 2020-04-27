<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$idkat = $_GET['idkat'];
$nmkat = $_GET['nmkat'];

//query update
$query = "UPDATE `kategori` SET `kategori` = '$nmkat' WHERE `kategori`.`id_kategori` = $idkat;";

if (mysqli_query($conn, $query)) {
    // $_SESSION['pesan'] = "Data kategori berhasil diedit";

    // echo "<script>
    //     alert('There are no fields to generate a report');
    //     window.location.href='../../index.php?page=kategori';
    //     </script>";

    // header("location: ../../index.php?page=kategori");

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Data kategori berhasil diedit',
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
    echo "Error, data gagal diupdate". mysqli_error();
}
?>

</body>
</html>