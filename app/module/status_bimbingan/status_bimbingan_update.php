<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    // $no_pengajuan   = $_POST['no_pengajuan'];

    $kd_bimbingan= strip_tags($_POST['kd_bimbingan']);
    $bahasan     = strip_tags($_POST['bahasan']);


    /* SQL Query Update */
    $sqlStatusBimbingan = "UPDATE bimbingan SET
                        bahasan    ='$bahasan',
                        status     ='AKTIF'
                        WHERE kd_bimbingan='$kd_bimbingan' ";

    if($kd_bimbingan!=""){

        $updateStatusBimbingan = $konek->query($sqlStatusBimbingan);    

        $pesan 		= "Data Berhasil Dirubah";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dirubah";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}