<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    // $no_pengajuan   = $_POST['no_pengajuan'];

    $tgl_bimbingan   = $_POST['tgl_bimbingan'];

    $nik            = strip_tags($_POST['nik']);    
    

    /* SQL Query Update */
    $sqlBimbingan = "UPDATE bimbingan SET
            nik             = '$nik',
            status          ='DISETUJUI'
    
            WHERE no_pengajuan='$no_pengajuan' ";

    if($no_pengajuan!=""){

        $updateBimbingan = $konek->query($sqlBimbingan);    

        $pesan 		= "Data Berhasil Dirubah";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dirubah";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}