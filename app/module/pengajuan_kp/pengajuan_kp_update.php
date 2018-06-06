<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    // $no_pengajuan = strip_tags($_POST['no_pengajuan']);

    // $judul 	     = strip_tags($_POST['judul']);

    $nm_instansi = strip_tags($_POST['nm_instansi']);
    
    $alamat 	 = strip_tags($_POST['alamat']);
    
    $jml_pegawai = strip_tags($_POST['jml_pegawai']);
    
    // $nik 		 = strip_tags($_POST['nik']);

    // $nim 		 = strip_tags($_POST['nim']);

    $status 	 = strip_tags($_POST['status']);
    

    /* SQL Query Update */
    $sqlMahasiswa = "UPDATE pengajuan SET


            nm_instansi='$nm_instansi',
    
            alamat='$alamat',
    
            jml_pegawai='$jml_pegawai',
    

            status='$status'
    
        WHERE no_pengajuan='$no_pengajuan' ";

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