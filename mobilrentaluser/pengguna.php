<?php
$admin 			= $_SESSION['username'];
$data_us		= mysql_query("SELECT * FROM tb_pelanggan  WHERE username  ='$admin'");
$nama 			= mysql_fetch_object($data_us);

?>