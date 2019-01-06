<?php 
include "../koneksi.php";

$id_mobil=$_GET['id_mobil'];

$query = "Delete From tb_mobil Where id_mobil='$id_mobil'";

$hasil = mysql_query($query);
	
	if($hasil){
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>