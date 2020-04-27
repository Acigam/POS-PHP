<?php
session_start();
include "../../koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<?php

$nmkar = $_GET['nmkar'];
$almtkar = $_GET['almtkar'];
$jkkar = $_GET['jkkar'];
$telpkar = $_GET['telpkar'];

//query update
$query = "INSERT INTO `karyawan` (`id_karyawan`, `nama`, `alamat`, `jenis_kelamin`, `no_telp`) 
          VALUES (NULL, '$nmkar', '$almtkar', '$jkkar', '$telpkar')";
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
        icon: 'success',
        title: 'Data karyawan berhasil ditambah',
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
    echo "Error, data gagal ditambah". mysqli_error();
}
?>

</body>
</html>