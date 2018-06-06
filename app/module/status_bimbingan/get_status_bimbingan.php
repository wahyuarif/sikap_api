<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";
    $nik    = $_SESSION['nik'];

    $sql	= "SELECT kd_bimbingan, bahasan, tgl_bimbingan, no_pengajuan, nim, nm_mhs FROM view_bimbingan WHERE nik='$nik' AND status is null ";
    // $sql	= "SELECT kd_bimbingan, bahasan, tgl_bimbingan, no_pengajuan, nim, nm_mhs FROM view_bimbingan WHERE nik='$nik'";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['kd_bimbingan']  = $row['kd_bimbingan'];

        $r['bahasan']       = $row['bahasan'];

        $r['tgl_bimbingan'] = $row['tgl_bimbingan'];
        
        $r['no_pengajuan'] = $row['no_pengajuan'];

        $r['nim'] = $row['nim'];

        $r['nm_mhs'] = $row['nm_mhs'];

        // $r['status'] = $row['status'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}