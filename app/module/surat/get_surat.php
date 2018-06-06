<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {
    include "../../../bin/koneksi.php";

    $nim = $_SESSION['nik'];

    $sql    = "SELECT nim,nm_mhs, prodi FROM mahasiswa WHERE nim='$nim' ";

    $hasil	= $konek->query($sql);

    $response = array();

    $response["data"] = array();

    while($row 	= $hasil->fetch_assoc()){

        $r['nim'] = $row['nim']; 

        $r['nm_mhs'] = $row['nm_mhs'];

        $r['prodi'] = $row['prodi'];

        array_push($response["data"], $r);
    }

    echo json_encode($response);
}