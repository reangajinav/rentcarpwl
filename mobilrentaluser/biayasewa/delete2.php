<?php 
include "../koneksi.php";

$id_transaksi=$_GET['id_transaksi'];

//echo exit;

$query = "Delete From tb_transaksi Where id_transaksi='$id_transaksi'";

$hasil = mysql_query($query);
$data1 = "SELECT id_mobil from tb_transaksi where id_transaksi='$id_transaksi'"
	
	if($hasil){
		$dt=mysql_query("SELECT tb_mobil.id_mobil as id_mobil, tb_mobil.foto_mobil, tb_jenis.nama_jenis, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from tb_jenis inner join tb_mobil on (tb_jenis.id_jenis = tb_mobil.id_jenis) where id_mobil='$data1'");
		$data=mysql_fetch_array($dt);
		var_dump($hasil); exit;
		$a = 0;
		$id_mobil = $data['id_mobil'];
		$status = $data['status'];
		if( $status == 0 ) {
				$hasil_status = $status - $a;
			} else {
				$hasil_status = $a;
			}
		$sql=mysql_query("update tb_mobil set status='$hasil_status' where id_mobil='$id_mobil'");
		//var_dump($sql); exit;
		
		$dt2=mysql_query("SELECT * FROM tb_pelanggan where id_pelanggan='$hasil'");
		$data2=mysql_fetch_array($dt2);
		$id_pelanggan = $data2['id_pelanggan'];
		$status2 = $data2['status_peminjaman'];
		if( $status2 == 0 ) {
				$hasil_status2 = $status2 + 0;
			} else {
				$hasil_status2 = 0;
			}
		$sql2=mysql_query("update tb_pelanggan set status_peminjaman='$hasil_status2' where id_pelanggan='$id_pelanggan'");
		header("location:index.php");
	}
	else{
		echo "Hapus Data Gagal";
	}
?>
