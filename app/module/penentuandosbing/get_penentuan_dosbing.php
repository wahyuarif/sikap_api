<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";

    $sql	= "SELECT no_pengajuan, judul, nm_instansi, nm_dosen, nm_dosen2, nim, nm_mhs, status FROM view_pengajuan";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['no_pengajuan']  = $row['no_pengajuan'];

        $r['judul']         = $row['judul'];

        $r['nm_instansi']   = $row['nm_instansi'];

        $r['nm_dosen']      = $row['nm_dosen'];

        $r['nm_dosen2']      = $row['nm_dosen2'];

        $r['nim']            = $row['nim'];

        $r['nm_mhs']        = $row['nm_mhs'];

        $r['status']        = $row['status'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}
