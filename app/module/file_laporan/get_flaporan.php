<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";

    $sql	= "SELECT no_pengajuan, nim, nm_mhs, prodi, judul FROM view_laporan_kp";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();


    while($row 	= $hasil->fetch_assoc()){

        $r['no_pengajuan'] = $row['no_pengajuan']; 
        
        $r['nim']          = $row['nim']; 

        $r['nm_mhs']       = $row['nm_mhs'];

        $r['prodi']        = $row['prodi'];

        $r['judul']        = $row['judul'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}
