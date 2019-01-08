<?php
include "../koneksi.php";
error_reporting(null);
session_start();

$id_pelanggan = $_POST['id_pelanggan'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$no_ktp = $_POST['no_ktp'];
$nama_lengkap = $_POST['nama_lengkap'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat_pelanggan = $_POST['alamat_pelanggan'];
$no_telepon = $_POST['no_telepon'];
$status_peminjaman = $_POST['status_peminjaman'];

// Cek apakah ingin mengubah fotonya atau tidak
if(isset($_POST['ubah_foto'])){ // Jika menceklis checkbox yang ada di form ubah, lakukan :
	// Ambil data foto yang dipilih dari form
	$sumber = $_FILES['foto']['name'];
	$nama_gambar = $_FILES['foto']['tmp_name'];
	
	// Rename nama fotonya dengan menambahkan tanggal upload
	$fotobaru = date('d-m-Y').$sumber;
	
	// Set path folder tempat menyimpan fotonya
	$path = "../../gambar/".$fotobaru;

	if(move_uploaded_file($nama_gambar, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		// Query untuk menampilkan data 
		$query = "SELECT tb_pelanggan.id_pelanggan, tb_pelanggan.username, tb_pelanggan.password, tb_pelanggan.no_ktp, tb_pelanggan.foto_pelanggan, tb_pelanggan.nama_lengkap, tb_pelanggan.tanggal_lahir, tb_pelanggan.alamat_pelanggan, tb_pelanggan.no_telepon, tb_pelanggan.status_peminjaman where id_pelanggan";
		$sql = mysql_query($query);
		$data = mysql_fetch_array($sql);

		// Cek apakah file gambar sebelumnya ada di folder gambar
		if(is_file("../../gambar/".$data['foto_pelanggan'])) // Jika gambar ada
			unlink("../../gambar/".$data['foto_pelanggan']); // Hapus file gambar sebelumnya yang ada di folder images
		
		// Proses ubah data ke Database
		$query = "update tb_pelanggan set username='$username', password='$password', no_ktp='$no_ktp', foto_pelanggan='$fotobaru', nama_lengkap='$nama_lengkap', tanggal_lahir='$tanggal_lahir', alamat_pelanggan='$alamat_pelanggan', no_telepon='$no_telepon', status_peminjaman='$status_peminjaman' where id_pelanggan='$id_pelanggan'";
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
	$query = "update tb_pelanggan set username='$username', password='$password', no_ktp='$no_ktp', nama_lengkap='$nama_lengkap', tanggal_lahir='$tanggal_lahir', alamat_pelanggan='$alamat_pelanggan', no_telepon='$no_telepon' , status_peminjaman='$status_peminjaman' where id_pelanggan='$id_pelanggan'";
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
}

?>