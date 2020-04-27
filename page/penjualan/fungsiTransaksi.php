<?php

function getIDT($conn){
    $q = "SELECT MAX(RIGHT(id_transaksi,3)) AS id_max FROM transaksi_penjualan WHERE DATE(tgl_transaksi)=CURDATE()";
    $result = $conn->query($q);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $tmp = ((int)$row['id_max'])+1;
            $kd = sprintf("%03s", $tmp);
        }//123456789012 TK200413001
    }
    else{
        $kd = "001";
    }
    return "TK".date('ymd').$kd;
}
?>