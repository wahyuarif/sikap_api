<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $nik 			= $_SESSION['nik'];

    $no_surat   	= $_GET['no_surat'];

    $sqlFind 		= "SELECT * FROM mahasiswa WHERE nim = '$nik'";
    
    $hasilFind		= $konek->query($sqlFind);

    $data['data'] 	= $hasilFind->fetch_assoc();
    
    echo json_encode($data['data']);

}