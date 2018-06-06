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

		$sqlcount= "SELECT no_pengajuan FROM pengajuan ORDER BY no_pengajuan DESC";
        
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
    $no_pengajuan   = autonum(4, "PJK".date('Y'));

    $nm_instansi 	= strip_tags($_POST['nm_instansi']);

    $alamat 	    = strip_tags($_POST['alamat']);
    
    $phone 			= strip_tags($_POST['phone']);

    $judul 			= strip_tags($_POST['judul']);
    
    $nim 		    = $_SESSION['nik'];
    

    /* Validasi Kode */
    $sqlCekNoPengajuan   = "SELECT no_pengajuan FROM pengajuan WHERE no_pengajuan='$no_pengajuan'";

    $exe_sqlNoPengajuan  = $konek->query($sqlCekNoPengajuan);

    $cekNoPengajuan	      = mysqli_num_rows($exe_sqlNoPengajuan);

    /* SQL Query Simpan */
    $sqlPengajuan = "INSERT INTO 
        pengajuan(
            no_pengajuan,
            judul,
            nm_instansi,
            alamat,
            phone,
            nim,
            status
        )VALUES(
            '$no_pengajuan',
            '$judul',
            '$nm_instansi',
            '$alamat',
            '$phone',
            '$nim',
            'PENGAJUAN'
        )";

    
    if($cekNoPengajuan> 0){
    
        $pesan    = "Data Sudah Terdaftar";
    
        $response = array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);
    } else {

        // $konek->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            
            $insertPengajuan = $konek->query($sqlPengajuan); 

        // $konek->commit();           

        $pesan 		= "Data Berhasil Disimpan";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);
    }

}