<?php
include "../koneksi.php";

$username=$_POST['username'];
$password = md5($_POST['password']);

$query = "insert into tb_user values ('','$username','$password')";
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