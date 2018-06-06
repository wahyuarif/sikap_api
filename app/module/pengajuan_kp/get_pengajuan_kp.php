<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";
    $nim = $_SESSION['nik'];

    $sql	= "SELECT no_pengajuan, nm_dosen, nm_instansi, alamat, judul, status FROM view_pengajuan WHERE nim='$nim' AND status!='REJECT' ";
    // status!='REJECT' ";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['no_pengajuan']  = $row['no_pengajuan'];

        $r['nm_dosen']      = $row['nm_dosen'];

        $r['nm_instansi']   = $row['nm_instansi'];

        $r['alamat']        = $row['alamat'];

        $r['judul']         = $row['judul'];

        $r['status']        = $row['status'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}