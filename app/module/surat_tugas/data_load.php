<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $no_pengajuan = $_GET['no_pengajuan'];

    $nik = $_SESSION['nik'];

    $sqlFind    = "SELECT * FROM view_pengajuan WHERE no_pengajuan = '$no_pengajuan'";
    
    $hasilFind  = $konek->query($sqlFind);
    // wakil dekan
    $wadek		= $konek->query("SELECT dosen.nm_dosen, dosen.jabatan FROM dosen WHERE jabatan LIKE '%wakil dekan%'")->fetch_object();

    $data['data'] = $hasilFind->fetch_assoc();

    $data['data']['wadek'] = array(
	
		'nm_dosen' => $wadek->nm_dosen
    );
    
    
    echo json_encode($data['data']);

}