<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_bayar = $_POST['id_bayar'];
$id_transaksi=$_POST['id_transaksi'];
$tanggal_bayar=$_POST['tanggal_bayar'];
$pembayaran=$_POST['pembayaran'];
$no_rek=$_POST['no_rek'];
$nama_bank=$_POST['nama_bank'];
$atas_nama=$_POST['atas_nama'];

$query = "update tb_pembayaran set id_transaksi='$id_transaksi', tgl_bayar='$tanggal_bayar', pembayaran='$pembayaran', no_rek='$no_rek', nama_bank='$nama_bank', atas_nama='$atas_nama' where id_bayar='$id_bayar'";
//var_dump($query); exit;
$hasil = mysql_query($query);
if($hasil)
{
	header ("location:index.php");
} else {
	echo "Penyimpanan Gagal";
}

?>