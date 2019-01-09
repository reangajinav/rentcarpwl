<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_transaksi=$_POST['id_transaksi'];
$harga=$_POST['harga'];
$terlambat=$_POST['terlambat'];

$dt=mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_mobil='$id_mobil'");
$data=mysql_fetch_array($dt);
$a = 1;
$status = $data['status_pengembalian'] + $a;
$denda = $terlambat * $harga ;
mysql_query("update tb_transaksi set status_pengembalian='$status', denda='$denda' where id_transaksi='$id_transaksi'");

/* $dt2=mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.total_harga, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM mobilrental.tb_transaksi 
				INNER JOIN mobilrental.tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN mobilrental.tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_mobil='$id_mobil'");
$data2=mysql_fetch_array($dt2);
$a = 1;
$status=$data2['status'] + $a;
mysql_query("update tb_mobil set status='$status' where id_transaksi='$id_transaksi'"); */

$query = "insert into tb_pengembalian values ('','$id_transaksi','$harga','$terlambat')";
$hasil = mysql_query($query);

if($hasil)
{
	header("location:index.php");
	//echo "<script>alert('Berhasil disimpan'); location.href='index.php';</script>";
}
else{
	echo "Penyimpanan gagal";
}

?>