<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_mobil = $_POST['id_mobil'];
$harga = $_POST['harga'];
$id_pelanggan = $_POST['id_pelanggan'];
$nama_lengkap = $_POST['nama_lengkap'];
$tanggal_sewa = $_POST['tanggal_sewa'];
$tanggal_selesai_sewa = $_POST['tanggal_selesai_sewa'];

$cek=mysql_query("SELECT tb_mobil.type_mobil, tb_transaksi.tgl_sewa from tb_mobil inner join tb_transaksi on (tb_mobil.id_mobil=tb_transaksi.id_mobil)");
$datacek = mysql_fetch_array($cek);


 $dicekin = date_create($_POST['tanggal_sewa']);
 $dicekout = date_create($_POST['tanggal_selesai_sewa']);
 $interval = date_diff($dicekin, $dicekout);

//$datetime1 = new DateTime($tanggal_selesai_sewa);
//$datetime2 = new DateTime($tanggal_sewa);
//$difference = $datetime1->diff($datetime2);
  
$jumlah_harga = $harga * $interval->d;
$denda = $_POST['denda'];
$status_pembayaran = $_POST['status_pembayaran'];
$status_pengembalian = $_POST['status_pengembalian'];

$dt=mysql_query("SELECT tb_mobil.id_mobil, tb_mobil.foto_mobil, tb_jenis.nama_jenis, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from tb_jenis inner join tb_mobil on (tb_jenis.id_jenis = tb_mobil.id_jenis) where id_mobil='$id_mobil'");
$data=mysql_fetch_array($dt);
$a = 0;
$status=$data['status'];
$hasil_status = $status - $a;
mysql_query("update tb_mobil set status='$hasil_status' where id_mobil='$id_mobil'");

$dt2=mysql_query("SELECT * FROM tb_pelanggan where id_pelanggan='$id_pelanggan'");
$data2=mysql_fetch_array($dt2);
$b = 0;
$status_peminjaman=$data2['status_peminjaman'];
$hasil_status2 = $status_peminjaman + $b;
mysql_query("update tb_pelanggan set status_peminjaman='$hasil_status2' where id_pelanggan='$id_pelanggan'");

$query = "insert into tb_transaksi values ('','$id_mobil','$harga','$id_pelanggan','$nama_lengkap','$tanggal_sewa','$tanggal_selesai_sewa','$jumlah_harga','$denda','$status_pembayaran','$status_pengembalian')";
//var_dump($query); exit;
$hasil = mysql_query($query);

if($hasil AND $tanggal_sewa != $datacek['tgl_sewa'])
{
	header("location:index.php");
}
elseif ($tanggal_sewa == $datacek['tgl_sewa']) {

	echo "Mobil Sudah dipinjam pada tanggal tersebut";
}
else{
	echo "Penyimpanan gagal";
}


?>