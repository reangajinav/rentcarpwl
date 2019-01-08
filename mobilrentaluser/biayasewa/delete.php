<?php 
include "../koneksi.php";

$id_transaksi=$_GET['id_transaksi'];

mysql_query("UPDATE tb_mobil,tb_transaksi SET status=1 WHERE tb_mobil.id_mobil=tb_transaksi.id_mobil AND tb_transaksi.id_transaksi='$id_transaksi'");

mysql_query("UPDATE tb_pelanggan,tb_transaksi SET status_peminjaman=0 WHERE tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan AND tb_transaksi.id_transaksi='$id_transaksi'");
		
$query = "Delete From tb_transaksi Where id_transaksi='$id_transaksi'";

$hasil = mysql_query($query);
	
	if($hasil){
	//var_dump($sql); exit;
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>

