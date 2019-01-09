<?php 
include "../koneksi.php";

$id_bayar=$_GET['id_bayar'];

mysql_query("UPDATE tb_transaksi,tb_pembayaran SET status_pembayaran=0 WHERE tb_transaksi.id_transaksi=tb_pembayaran.id_transaksi AND tb_pembayaran.id_bayar='$id_bayar'");
		
$query = "Delete From tb_pembayaran Where id_bayar='$id_bayar'";

$hasil = mysql_query($query);
	
	if($hasil){
	//var_dump($sql); exit;
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>

