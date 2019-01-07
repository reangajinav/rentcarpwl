<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_transaksi = $_POST['id_transaksi'];
$id_mobil = $_POST['id_mobil'];
$harga = $_POST['harga'];
$id_pelanggan = $_POST['id_pelanggan'];
$nama_lengkap = $_POST['nama_lengkap'];
$tanggal_sewa = $_POST['tanggal_sewa'];
$tanggal_selesai_sewa = $_POST['tanggal_selesai_sewa'];

$dicekin = date_create($_POST['tanggal_sewa']);
 $dicekout = date_create($_POST['tanggal_selesai_sewa']);
 $interval = date_diff($dicekin, $dicekout);

$jumlah_harga = $harga * $interval->d;
$denda = $_POST['denda'];
$status_pembayaran = $_POST['status_pembayaran'];
$status_pengembalian = $_POST['status_pengembalian'];

/*$dt=mysql_query("SELECT tb_mobil.id_mobil, tb_mobil.foto_mobil, tb_jenis.nama_jenis, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from mobilrental.tb_jenis inner join mobilrental.tb_mobil on (tb_jenis.id_jenis = tb_mobil.id_jenis) where id_mobil='$id_mobil'");
$data=mysql_fetch_array($dt);
$a = 1;
$status = $data['status'];
	if( $status == 1 ) {
		$hasil_status = $status - $a;
	} else {
		$hasil_status = $status;
	}
mysql_query("update tb_mobil set status='$hasil_status' where id_mobil='$id_mobil'"); */

$query = "update tb_transaksi set id_mobil='$id_mobil', harga='$harga', id_pelanggan='$id_pelanggan', nama_lengkap='$nama_lengkap', tgl_sewa='$tanggal_sewa', tgl_selesaisewa='$tanggal_selesai_sewa', jumlah_harga='$jumlah_harga', denda='$denda', status_pembayaran='$status_pembayaran', status_pengembalian='$status_pengembalian' where id_transaksi='$id_transaksi'";
//var_dump($query); exit;
$hasil = mysql_query($query);
if($hasil)
{
	header ("location:index.php");
} else {
	echo "Penyimpanan Gagal";
}

?>