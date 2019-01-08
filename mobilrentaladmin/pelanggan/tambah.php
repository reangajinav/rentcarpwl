<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$no_ktp = $_POST['no_ktp'];
$sumber = $_FILES['foto_pelanggan']['tmp_name'];
	$target = 'gambar/';
	$nama_gambar = $_FILES['foto_pelanggan']['name'];
$nama_lengkap = $_POST['nama_lengkap'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat_pelanggan = $_POST['alamat_pelanggan'];
$no_telepon = $_POST['no_telepon'];
$status_peminjaman = $_POST['status_peminjaman'];

$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
if($pindah){
$query = "insert into tb_pelanggan values('','$no_ktp','$nama_gambar','$nama_lengkap','$tanggal_lahir','$alamat_pelanggan','$no_telepon','$status_peminjaman')";
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