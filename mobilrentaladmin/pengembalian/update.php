<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_pengembalian = $_POST['id_pengembalian'];
$id_transaksi=$_POST['id_transaksi'];
$harga=$_POST['harga'];
$terlambat=$_POST['terlambat'];

$dt=mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_transaksi='$id_transaksi'");
$data=mysql_fetch_array($dt);
$denda = $terlambat * $harga ;
mysql_query("update tb_transaksi set denda='$denda' where id_transaksi='$id_transaksi'");

$query = "update tb_pengembalian  set id_transaksi='$id_transaksi', harga='$harga', terlambat='$terlambat' where id_pengembalian='$id_pengembalian'";
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