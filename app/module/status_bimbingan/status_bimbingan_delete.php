<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    $kd_bimbingan	= $_POST['kd_bimbingan'];

    /* SQL Query Update */
    $sqlBimbingan= "UPDATE bimbingan SET status='DITOLAK' WHERE kd_bimbingan='$kd_bimbingan' ";

    if($no_bimbingan!=""){

        $deleteBimbingana = $konek->query($sqlBimbingan);    

        $pesan 		= "Data Berhasil Dihapus";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dihapus";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}