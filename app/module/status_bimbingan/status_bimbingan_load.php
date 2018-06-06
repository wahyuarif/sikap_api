<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $kd_bimbingan = $_GET['kd_bimbingan'];

    $sqlFind 	    = "SELECT * FROM view_bimbingan WHERE kd_bimbingan = '$kd_bimbingan'";
    
    $hasilFind	= $konek->query($sqlFind);

    $data['data'] = $hasilFind->fetch_assoc();
    
    echo json_encode($data['data']);

}