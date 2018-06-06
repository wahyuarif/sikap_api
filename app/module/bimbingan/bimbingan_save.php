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

    $no_pengajuan 	= strip_tags($_POST['no_pengajuan']);

    $nim 		    = $_SESSION['nik'];
    

    /* Validasi Kode */
    $sqlCekKdBimbingan    = "SELECT kd_bimbingan FROM bimbingan WHERE kd_bimbingan='$kd_bimbingan'";

    $exe_sqlKdBimbingan   = $konek->query($sqlCekKdBimbingan);

    $cekKdBimbingan	      = mysqli_num_rows($exe_sqlKdBimbingan);

    /* SQL Query Simpan */
    $sqlBimbingan = "INSERT INTO 
        bimbingan(
            kd_bimbingan,
            tgl_bimbingan,
            no_pengajuan

        )VALUES(
            '$kd_bimbingan',
            '$tgl_bimbingan',
            '$no_pengajuan'
        )";
    
    if($cekKdBimbingan > 0){
    
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