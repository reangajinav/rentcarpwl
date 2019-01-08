<?php 
error_reporting(null);
session_start();
include "../koneksi.php";
include "../pengguna.php";
include "../set.php";

$id_pelanggan=$_POST['id_pelanggan'];
$hasil = mysql_query("select * from tb_pelanggan where id_pelanggan='$id_pelanggan'");
$result = mysql_fetch_array($hasil);
echo json_encode($result);
?>