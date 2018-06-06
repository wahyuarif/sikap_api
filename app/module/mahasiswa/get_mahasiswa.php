<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";

    $sql	= "SELECT nim, nm_mhs, prodi, no_hp FROM mahasiswa WHERE status='Aktif'";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['nim'] = $row['nim']; 

        $r['nm_mhs'] = $row['nm_mhs'];

        $r['prodi'] = $row['prodi'];

        $r['no_hp'] = $row['no_hp'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}