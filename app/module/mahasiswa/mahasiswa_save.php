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

		$sqlcount= "SELECT nim FROM mahasiswa ORDER BY nim DESC";
        
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
    $nik	        = strip_tags($_POST['nim']);

    $nm_mhs 	    = strip_tags($_POST['nm_mhs']);

    $prodi 	        = strip_tags($_POST['prodi']);
    
    $no_hp 			= strip_tags($_POST['no_hp']);
    
    $username 		= strip_tags($_POST['username']);
    
    $password 		= strip_tags($_POST['password']);

    $encode        = md5($password);

    $status 	   = strip_tags($_POST['status']);

    /* Validasi Kode */
    $sqlCekNim    = "SELECT nim FROM mahasiswa WHERE nim='$nik'";

    $exe_sqlNim   = $konek->query($sqlCekNim);

    $cekNim	      = mysqli_num_rows($exe_sqlNim);

    /* SQL Query Simpan */
    $sqlMahasiswa = "INSERT INTO 
        mahasiswa(
            nim,
            nm_mhs,
            prodi,
            no_hp,
            username,
            password,
            status
        )VALUES(
            '$nik',
            '$nm_mhs',
            '$prodi',
            '$no_hp',
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
                '$nm_mhs',
                '$username',
                '$encode',
                'Mahasiswa',
                'Yes',
                '$nik'
            )";
    
    if($cekNim > 0){
    
        $pesan    = "Data Sudah Terdaftar";
    
        $response = array('pesan'=>$pesan, 'data'=>$_POST);
    
        echo json_encode($response);
    } else {

        // $konek->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
            
            $insertMahasiswa = $konek->query($sqlMahasiswa); 
    
            $insertUser      = $konek->query($sqlUser);

        // $konek->commit();           

        $pesan 		= "Data Berhasil Disimpan";

        $response 	= array('pesan'=>$pesan, 'data'=>$_POST);

        echo json_encode($response);
    }

}