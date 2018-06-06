<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";
    $nim = $_SESSION['nik'];

    $sql	= "SELECT no_pengajuan, flaporan, tgl_upload FROM upload_doc WHERE nim='$nim'";
    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['no_pengajuan']  = $row['no_pengajuan'];

        $r['fupload']       = $row['fupload'];

        $r['tgl_upload']    = $row['tgl_upload'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}