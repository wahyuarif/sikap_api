<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    $no_pengajuan   = $_POST['no_pengajuan'];

    $status         = strip_tags($_POST['status']);

    /* SQL Query Update */

    $sqlStatusPengajuan = "UPDATE pengajuan SET
            status          = '$status'
    
            WHERE no_pengajuan='$no_pengajuan' ";

    if($no_pengajuan!=""){

        $updateStatusPengajuan = $konek->query($sqlStatusPengajuan);    

        $pesan 		= "Data Berhasil Dirubah";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dirubah";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}