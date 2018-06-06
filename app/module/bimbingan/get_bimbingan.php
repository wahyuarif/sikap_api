<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";

    $nim = $_SESSION['nik'];

    $sql	= "SELECT kd_bimbingan, bahasan, tgl_bimbingan, no_pengajuan FROM view_bimbingan WHERE nim='$nim'";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['kd_bimbingan']  = $row['kd_bimbingan'];

        $r['bahasan']       = $row['bahasan'];

        $r['tgl_bimbingan'] = $row['tgl_bimbingan'];
        
        $r['no_pengajuan'] = $row['no_pengajuan'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}