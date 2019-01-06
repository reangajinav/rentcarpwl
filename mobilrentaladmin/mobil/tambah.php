<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$sumber = $_FILES['foto_mobil']['tmp_name'];
	$target = '../../gambar/mobil/';
	$nama_gambar = $_FILES['foto_mobil']['name'];
$nama_jenis = $_POST['nama_jenis'];
$type_mobil = $_POST['type_mobil'];
$merk = $_POST['merk'];
$no_polisi = $_POST['no_polisi'];
$warna = $_POST['warna'];
$harga = $_POST['harga'];
$status = $_POST['status'];

$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
if($pindah){
$query = "insert into tb_mobil values('','$nama_gambar','$nama_jenis','$type_mobil','$merk','$no_polisi','$warna','$harga','$status')";
//var_dump($query); exit;
$hasil = mysql_query($query);
}
if($hasil)
{
header("location:index.php");
}
else{
	echo "Penyimpanan gagal";
}
?>