<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    $nim	        = strip_tags($_POST['nim']);

    $nm_mhs 	    = strip_tags($_POST['nm_mhs']);

    $prodi 	        = strip_tags($_POST['prodi']);
    
    $no_hp 			= strip_tags($_POST['no_hp']);
    
    $username 		= strip_tags($_POST['username']);
    
    $password 		= strip_tags($_POST['password']);

    $encode        = md5($password);

    $status 		= strip_tags($_POST['status']);
    

    /* SQL Query Update */
    $sqlMahasiswa = "UPDATE mahasiswa SET

            nm_mhs='$nm_mhs',

            prodi='$prodi',
    
            no_hp='$no_hp',
    
            username='$username',
    
            password='$encode',

            status='$status'
    
        WHERE nim='$nim' ";

    if($nim!=""){

        $updateMahasiswa = $konek->query($sqlMahasiswa);    

        $pesan 		= "Data Berhasil Dirubah";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dirubah";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}