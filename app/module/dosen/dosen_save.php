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

		$sqlcount= "SELECT nik FROM dosen ORDER BY nik DESC";
        
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
    $nik	        = strip_tags($_POST['nik']);

    $nm_dosen 	    = strip_tags($_POST['nm_dosen']);

    $jabatan 	    = strip_tags($_POST['jabatan']);
    
    $username 		= strip_tags($_POST['username']);
    
    $password 		= strip_tags($_POST['password']);
    
    $encode         = md5($password);

    $status         = strip_tags($_POST['status']);
    
    /* Validasi Kode */
    $sqlCekNik  = "SELECT nik FROM dosen WHERE nik='$nik'";
    
    $exe_sqlNik = $konek->query($sqlCekNik);
   
    $cekNik	    = mysqli_num_rows($exe_sqlNik);

    /* SQL Query Simpan */
    $sqlDosen = "INSERT INTO 
            dosen(
                nik,
                nm_dosen,
                jabatan,
                username,
                password,
                status
            )VALUES(
                '$nik',
                '$nm_dosen',
                '$jabatan',
                '$username',
                '$encode',
                '$status'
            )";

    $sqlUser = "INSERT INTO 
            sys_user (
                nm_user,
                username,
                password,
                level,
                aktif,
                nik
            )VALUES(
                '$nm_dosen',
                '$username',
                '$encode',
                '$jabatan',
                'Yes',
                '$nik'
            )";
    
    if($cekNik > 0){
    
        $pesan 		= "Data Sudah Terdaftar";
    
        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);
    } else {

        $insertDosen = $konek->query($sqlDosen);  

        $insertUser  = $konek->query($sqlUser);         

        $pesan 		 = "Data Berhasil Disimpan";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);
    }

}