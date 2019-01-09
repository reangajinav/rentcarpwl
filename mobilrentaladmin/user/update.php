<?php
include "../koneksi.php";

$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "update tb_user set username='$username', password='$password' where id_user='$id_user' ";
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