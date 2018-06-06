<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $nik = $_SESSION['nik'];

    $sqlFind 	    = "SELECT * FROM view_pengajuan WHERE nim = '$nik'";
    
    $hasilFind	= $konek->query($sqlFind);

    $data['data'] = $hasilFind->fetch_assoc();
    
    echo json_encode($data['data']);

}