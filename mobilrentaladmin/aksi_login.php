<?php
   error_reporting(null);
   session_start(); //mulai session, krena kita akan menggunakan session pd file php ini
   include 'koneksi.php'; 
	
	
	$id_user = $_POST['id_user'];
	$username = $_POST['username'];
	$password = ($_POST['password']);
	
	$query = mysql_query("select * from tb_user where username='$username' and password='$password'");
	$hasil = mysql_fetch_array($query);
	

	if($hasil){ 
	$_SESSION['id_user']	= $hasil['id_user'];
    $_SESSION['username'] 	= $hasil['username'];
	$_SESSION['password']  	= $hasil['password'];
    header("location:dashboard/index.php"); 
	}
	else
	{ 
    header ('location:index.php?pesan=gagal')or die(mysql_error());
	}
?>