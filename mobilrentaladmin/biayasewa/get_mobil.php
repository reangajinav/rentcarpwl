<?php 
error_reporting(null);
session_start();
include "../koneksi.php";
include "../pengguna.php";
include "../set.php";

$id_mobil=$_POST['id_mobil'];
$hasil = mysql_query("SELECT tb_mobil.foto_mobil, tb_jenis.nama_jenis, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from tb_jenis inner join tb_mobil on (tb_jenis.id_jenis = tb_mobil.id_jenis) where id_mobil='$id_mobil'");
$result = mysql_fetch_array($hasil);
echo json_encode($result);
?>