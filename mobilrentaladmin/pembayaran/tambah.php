<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_transaksi=$_POST['id_transaksi'];
$tanggal_bayar=$_POST['tanggal_bayar'];
$pembayaran=$_POST['pembayaran'];
$no_rek=$_POST['no_rek'];
$nama_bank=$_POST['nama_bank'];
$atas_nama=$_POST['atas_nama'];

$dt=mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.total_harga, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_mobil='$id_mobil'");
$data=mysql_fetch_array($dt);
$a = 1;
$status=$data['status_pembayaran'] + $a;
mysql_query("update tb_transaksi set status_pembayaran='$status' where id_transaksi='$id_transaksi'");

$query = "insert into tb_pembayaran values ('','$id_transaksi','$tanggal_bayar','$pembayaran','$no_rek','$nama_bank','$atas_nama')";
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