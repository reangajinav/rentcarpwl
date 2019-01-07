<?php 
error_reporting(null);
session_start();
include "../koneksi.php";
include "../pengguna.php";
include "../set.php";

$id_transaksi=$_POST['id_transaksi'];
$hasil = mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_transaksi='$id_transaksi'");
$result = mysql_fetch_array($hasil);
echo json_encode($result);
?>