<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    $nik	    = $_POST['nik'];

    $nm_dosen 	= strip_tags($_POST['nm_dosen']);

    $jabatan 	= strip_tags($_POST['jabatan']);
    
    $username 	= strip_tags($_POST['username']);
    
    $password 	= strip_tags($_POST['password']);

    

    /* SQL Query Update */
    $sqlDosen = "UPDATE dosen SET

            nm_dosen='$nm_dosen',

            jabatan='$jabatan',
    
            username='$username',
    
            password='$password'
    
        WHERE nik='$nik' ";

    if($nik!=""){

        $updateDosen = $konek->query($sqlDosen);    

        $pesan 		= "Data Berhasil Dirubah";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dirubah";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}