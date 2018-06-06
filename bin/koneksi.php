<?php  
$host  = "localhost";
$uname = "root";
$pass  = "";
$dbname= "db_kp";

$konek = mysqli_connect($host, $uname, $pass, $dbname);
if(mysqli_connect_errno()){
   echo "Koneksi Ke Server Gagal";
   exit();
  }

?>