<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_mobil = $_POST['id_mobil'];
$nama_jenis = $_POST['nama_jenis'];
$type_mobil = $_POST['type_mobil'];
$merk = $_POST['merk'];
$no_polisi = $_POST['no_polisi'];
$warna = $_POST['warna'];
$harga = $_POST['harga'];
$status = $_POST['status'];

// Cek apakah ingin mengubah fotonya atau tidak
if(isset($_POST['ubah_foto'])){ // Jika menceklis checkbox yang ada di form ubah, lakukan :
	// Ambil data foto yang dipilih dari form
	$sumber = $_FILES['foto']['name'];
	$nama_gambar = $_FILES['foto']['tmp_name'];
	
	// Rename nama fotonya dengan menambahkan tanggal upload
	$fotobaru = date('d-m-Y').$sumber;
	
	// Set path folder tempat menyimpan fotonya
	$path = "../../gambar/mobil/".$fotobaru;

	if(move_uploaded_file($nama_gambar, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		// Query untuk menampilkan data 
		$query = "SELECT tb_mobil.id_mobil, tb_mobil.foto_mobil, tb_jenis.nama_jenis, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from tb_jenis inner join tb_mobil on (tb_jenis.id_jenis = tb_mobil.id_jenis) where id_mobil";
		$sql = mysql_query($query);
		$data = mysql_fetch_array($sql);

		// Cek apakah file gambar sebelumnya ada di folder gambar
		if(is_file("../../gambar/mobil/".$data['foto_mobil'])) // Jika gambar ada
			unlink("../../gambar/mobil/".$data['foto_mobil']); // Hapus file gambar sebelumnya yang ada di folder images
		
		// Proses ubah data ke Database
		$query = "update tb_mobil set foto_mobil='$fotobaru', id_jenis='$nama_jenis', type_mobil='$type_mobil', merk='$merk', no_polisi='$no_polisi', warna='$warna', harga='$harga', status='$status' where id_mobil='$id_mobil'";
		//var_dump($query); exit;
		$sql = mysql_query($query); // Eksekusi/ Jalankan query dari variabel $query

		if($sql){ // Cek jika proses simpan ke database sukses atau tidak
			// Jika Sukses, Lakukan :
			header("location: index.php"); // Redirect ke halaman index.php
		}else{
			// Jika Gagal, Lakukan :
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
		}
	}else{
		// Jika gambar gagal diupload, Lakukan :
		echo   "<script> alert('Maaf, Gambar gagal untuk diupload'); 
				location = 'index.php'; 
				</script>";
	}
}else{ // Jika tidak menceklis checkbox yang ada di form ubah, lakukan :
	// Proses ubah data ke Database
	$query = "update tb_mobil set id_jenis='$nama_jenis', type_mobil='$type_mobil', merk='$merk', no_polisi='$no_polisi', warna='$warna', harga='$harga', status='$status' where id_mobil='$id_mobil'";
	//var_dump($query); exit;
	$sql = mysql_query($query); // Eksekusi/ Jalankan query dari variabel $query
	
	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		header("location: index.php"); // Redirect ke halaman index.php
	}else{
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database2.";
		echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
}

?>