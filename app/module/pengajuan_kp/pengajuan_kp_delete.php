<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    $no_pengajuan	= $_POST['no_pengajuan'];

    /* SQL Query Update */
    $sqlPengajuan= "UPDATE pengajuan SET status='REJECT' WHERE no_pengajuan='$no_pengajuan' ";

    if($no_pengajuan!=""){

        $deletePengajuana = $konek->query($sqlPengajuan);    

        $pesan 		= "Data Berhasil Dihapus";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dihapus";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}