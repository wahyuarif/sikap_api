<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $no_pengajuan = $_POST['no_pengajuan'];
    $nim          = $_SESSION['nik'];

    $sql	= "SELECT nm_mhs, nim, prodi, alamat, judul FROM view_pengajuan WHERE no_pengajuan = '$no_pengajuan' ";
    
    $hasil	= $konek->query($sql);

    while($row = $hasil->fetch_assoc()){

        $data ="
                <tr>

                    <td>". $row['judul'] ."</td>

                </tr>
            ";

        echo $data;
    }

}