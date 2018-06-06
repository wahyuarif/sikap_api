<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $no_donasi = $_POST['no_donasi'];

    $sql    = "SELECT * FROM view_donasi WHERE no_donasi='$no_donasi'";
    
    $hasil  = $konek->query($sql);

    while($row = $hasil->fetch_assoc()){

        $data ="
                <tr>

                    <td>". $row['program'] ."</td>

                    <td>&nbsp;</td>

                    <td id='jml_donasi'>". number_format($row['jml_donasi'], 0, ',', '.') ."</td>

                </tr>
            ";

        echo $data;
    }

}