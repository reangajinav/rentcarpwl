<?php 
$host = "localhost";
$username = "id8270336_root";
$password = "root1234";
$database = "id8270336_mobilrental";
$koneksi  = mysql_connect($host, $username, $password);
$pilihdatabase = mysql_select_db($database, $koneksi);
if ($pilihdatabase) echo "";
else echo "";

?>