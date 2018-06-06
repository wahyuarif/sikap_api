<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $nik = $_SESSION['nik'];

    // $sqlFind        = "SELECT pengajuan.*, dosen.*, mahasiswa.* FROM pengajuan left join dosen on pengajuan.nik=dosen.nik left join mahasiswa on pengajuan.nim=mahasiswa.nim WHERE pengajuan.nim = '$nik'";
    
    $sqlFind        = "SELECT pengajuan.*, dosen.*, mahasiswa.* FROM pengajuan left join dosen on pengajuan.nik=dosen.nik left join mahasiswa on pengajuan.nim=mahasiswa.nim WHERE pengajuan.nim = '$nik'";

    $wadek = $konek->query("select dosen.nm_dosen, dosen.jabatan from dosen where jabatan like '%wakil dekan%'")->fetch_object();
    
    $hasilFind  = $konek->query($sqlFind);

    $data['data'] = $hasilFind->fetch_assoc();

    $data['data']['wadek'] = array(
    	'nm_dosen' => $wadek->nm_dosen,
    	'jabatan'  => $wadek->jabatan
    );
    
    echo json_encode($data['data']);

}