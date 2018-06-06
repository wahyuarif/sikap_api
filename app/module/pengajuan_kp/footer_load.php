<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    // $nik 			= $_SESSION['nim'];
    $no_pengajuan = $_POST['no_pengajuan'];

    $sqlFind 		= "SELECT nm_mhs, judul FROM view_pengajuan WHERE no_pengajuan = '$no_pengajuan'";
    
    $hasilFind		= $konek->query($sqlFind);

    $data['data'] 	= $hasilFind->fetch_assoc();
    
    echo json_encode($data['data']);

}