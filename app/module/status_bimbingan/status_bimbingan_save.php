<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    /*
	* Auto Number Untuk Code Buku 
	*/
	function autonum($lebar=0, $awalan=''){
        include "../../../bin/koneksi.php";

		$sqlcount= "SELECT kd_bimbingan FROM bimbingan ORDER BY kd_bimbingan DESC";
        
        $hasil= $konek->query($sqlcount);
        
        $jumlahrecord = mysqli_num_rows($hasil);

		if($jumlahrecord == 0)
			$nomor=1;
		else {
			$nomor = $jumlahrecord+1;
		}

		if($lebar>0)
			$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
		else
			$angka = $awalan.$nomor;
		return $angka;
    }
    
    /** Variabel From Post */
    $kd_bimbingan   = autonum(4, "PBKP".date('Y'));

    $tgl_bimbingan 	= strip_tags($_POST['tgl_bimbingan']);

    $bahasan 	    = strip_tags($_POST['bahasan']);
    
    $no_pengajuan   = strip_tags($_POST['no_pengajuan']);

    // $status 	   = strip_tags($_POST['status']);

    /* Validasi Kode */
    $sqlCekNoPengajuan    = "SELECT no_pengajuan FROM pengajuan WHERE no_pengajuan='$no_pengajuan'";

    $exe_sqlNoPengajuan   = $konek->query($sqlCekNoPengajuan);

    $cekNoPengajuan	      = mysqli_num_rows($exe_sqlNoPengajuan);

    /* SQL Query Simpan */
    $sqlBimbingan = "INSERT INTO 
        bimbingan(
            kd_bimbingan,
            bahasan,
            tgl_bimbingan,
            no_pengajuan

        )VALUES(
            '$kd_bimbingan',
            '$bahasan',
            '$tgl_bimbingan',
            '$no_pengajuan'
        )";
    
    if($cekNoPengajuan > 0){
    
        $pesan    = "Data Sudah Terdaftar";
    
        $response = array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);
    } else {

        // $konek->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            
            $insertBimbingan = $konek->query($sqlBimbingan); 

        // $konek->commit();           

        $pesan 		= "Data Berhasil Disimpan";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);
    }

}