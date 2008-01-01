<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

  
    /** Variabel From Post */
    $no_pengajuan   = $_POST['no_pengajuan'];

    $nik            = strip_tags($_POST['nik']);  

    $nik2           = strip_tags($_POST['nik2']);
    

    /* SQL Query Update */
    $sqlDosbing = "UPDATE pengajuan SET
            nik             = '$nik',
            status          ='DISETUJUI'
    
            WHERE no_pengajuan='$no_pengajuan' ";

    if($no_pengajuan!=""){

        $updateDosbing = $konek->query($sqlDosbing);

        $selectDosbing = "SELECT id_pengajuan FROM pengajuan WHERE no_pengajuan = '$no_pengajuan'";
        
        $updateDosbing     = $konek->query($selectDosbing);
        while($row  = $updateDosbing->fetch_assoc()){
            $r['id_pengajuan'] = $row['id_pengajuan'];
            $sqlDosbing2 = "INSERT INTO pengajuan_dtl(id_pengajuan, nik)VALUES('$r[id_pengajuan]', '$nik2')" ;
            $updateDosbing = $konek->query($sqlDosbing2);
            break;
        }

        $pesan 		= "Data Berhasil Dirubah";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);

    } else {

        $pesan 		= "Data Gagal Dirubah";
        
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);

    }

}