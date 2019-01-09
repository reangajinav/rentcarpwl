<?php 
include "../koneksi.php";

$id_pengembalian=$_GET['id_pengembalian'];

mysql_query("UPDATE tb_transaksi,tb_pengembalian SET status_pengembalian=0 WHERE tb_transaksi.id_transaksi=tb_pengembalian.id_transaksi AND tb_pengembalian.id_pengembalian='$id_pengembalian'");
		
$query = "Delete From tb_pengembalian Where id_pengembalian='$id_pengembalian'";

$hasil = mysql_query($query);
	
	if($hasil){
	//var_dump($sql); exit;
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>

