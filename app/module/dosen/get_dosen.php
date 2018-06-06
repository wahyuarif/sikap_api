<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";

    $sql	= "SELECT nik, nm_dosen, jabatan FROM dosen WHERE status='Aktif'";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['nik']       = $row['nik'];
        
        $r['nm_dosen']  = $row['nm_dosen'];

        $r['jabatan']   = $row['jabatan'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}