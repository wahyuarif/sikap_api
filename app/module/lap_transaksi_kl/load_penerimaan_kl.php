<?php
session_start();

if(!$_SESSION){

    $pesan = "Your Access Not Authorized";

    echo json_encode($pesan);

} else {    

    include "../../../bin/koneksi.php";

    $kode_petugas   = $_SESSION['kode_petugas'];

    $dari_tgl       = $_POST['dari_tgl'];

    $sampai_tgl     = $_POST['sampai_tgl'];

    if($kode_petugas==''){

        $sql	= "SELECT 
            kategori,
            
            no_donasi,
            
            nama_donatur,
            
            tgl_donasi,
            
            program,

            createdby,

            status,
        
            SUM(jml_donasi) AS jml_donasi 

        FROM view_penerimaan_kl
        
        WHERE tgl_donasi BETWEEN '$dari_tgl' AND '$sampai_tgl'
        
        GROUP BY kategori, no_donasi WITH ROLLUP";

    } else {

        $sql	= "SELECT 
            kategori,
            
            no_donasi,
            
            nama_donatur,
            
            tgl_donasi,
            
            program,

            createdby,

            status,
        
            SUM(jml_donasi) AS jml_donasi 

        FROM view_penerimaan_kl
        
        WHERE tgl_donasi BETWEEN '$dari_tgl' AND '$sampai_tgl' AND createdby='$kode_petugas'
        
        GROUP BY kategori, no_donasi WITH ROLLUP";

    }

    $sqlPetugas = "SELECT createdby, nama_petugas FROM view_penerimaan_kl WHERE createdby='$kode_petugas'";
    
    $hasil	        = $konek->query($sql);

    $hasilPetugas   = $konek->query($sqlPetugas);

    $baris          = $hasilPetugas->fetch_assoc();

    $data   = "

                <h4><b>Laporan Penerimaan Petugas</b></h4>

                <hr style='border:1px solid;'>

                <table cellspacing='15' cellpadding='15'>
                    
                    <tr>
                        <td width='150'><b>KODE PETUGAS</b></td>
                        <td width=25><b>:</b></td>
                        <td>".$kode_petugas."</td>
                    </tr>
                    <tr>
                        <td><b>PETUGAS</b></td>
                        <td><b>:</b></td>
                        <td>".$baris['nama_petugas']."</td>
                    </tr>

                </table>
            
                <hr style='border:1px solid;'>

                <table class='table'>

                    <tr>
                    
                        <td><b>Kategori</b></td>

                        <td><b>No Donasi</b></td>

                        <td><b>Muzaki</b></td>

                        <td><b>Tanggal</b></td>

                        <td><b>Program</b></td>

                        <td  align='right'><b>Jumlah</td>

                    </tr>

            ";

    while($row = $hasil->fetch_assoc()){

        $class = '';

        if($row['kategori']=='' OR $row['kategori']==NULL){

            $class = ' class="total"';

            $data .="
                <tr ". $class .">
                    <td colspan='5' align='right'><b>TOTAL: </b></td>

                    <td id='jml_donasi' align='right'><b>". number_format($row['jml_donasi'], 0, ',', '.') ."</b></td>

                </tr>
            ";

        }elseif($row['no_donasi']=='' OR $row['no_donasi']==NULL){

            $class = ' class="subtotal"';

            $data .="
                <tr ". $class .">
                    <td colspan='5' align='right'><b>SUB TOTAL: </b></td>

                    <td id='jml_donasi' align='right'><b>". number_format($row['jml_donasi'], 0, ',', '.') ."</b></td>

                </tr>
            ";

        }else{

            $class = ' class="normal"';

            $data .="
                <tr ". $class .">
                    
                    <td>". $row['kategori'] ."</td>

                    <td>". $row['no_donasi'] ."</td>

                    <td>". $row['nama_donatur'] ."</td>

                    <td>". $row['tgl_donasi'] ."</td>

                    <td>". $row['program'] ."</td>

                    <td  align='right' id='jml_donasi'>". number_format($row['jml_donasi'], 0, ',', '.') ."</td>

                </tr>
            ";

        }

    }

    $data .= "</table>";

    echo $data;

}