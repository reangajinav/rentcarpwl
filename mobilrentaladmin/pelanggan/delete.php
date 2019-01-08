<?php 
include "../koneksi.php";

$id_pelanggan=$_GET['id_pelanggan'];

$query = "Delete From tb_pelanggan Where id_pelanggan='$id_pelanggan'";

$hasil = mysql_query($query);
	
	if($hasil){
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>