<?php
include "../koneksi.php";

session_start();

$nama=$_POST['nickname'];
$username=$_POST['username'];
$ktp= $_POST['no_ktp'];
$password = md5($_POST['password']);
$repassword= md5($_POST['repassword']);
$tgl = $_POST['tgl'];
$alamat=$_POST['alamat'];
$telepon=$_POST['telepon'];
$sumber = $_FILES['foto_pelanggan']['tmp_name'];
    $target = '../../gambar/';
    $nama_gambar = $_FILES['foto_pelanggan']['name'];


  // cek nilai variable
    if (empty($nama)) {
        header('location: index.php?error=' .base64_encode('Nama tidak boleh kosong'));
    }
    if (empty($username)) {
        header('location: index.php?error=' .base64_encode('Username tidak boleh kosong'));   
    }
    if (empty($ktp)) {
        header('location: index.php?error=' .base64_encode('KTP tidak boleh kosong'));
    }
    if (empty($password)) {
        header('location: index.php?error=' .base64_encode('Password tidak boleh kosong'));   
    }
        if (empty($repassword)) {
        header('location: index.php?error=' .base64_encode('REPassword tidak boleh kosong'));   
    }
        if (empty($tgl)) {
        header('location: index.php?error=' .base64_encode('tgl tidak boleh kosong'));   
    }
        if (empty($alamat)) {
        header('location: index.php?error=' .base64_encode('alamat tidak boleh kosong'));   
    }
        if (empty($telepon)) {
        header('location: index.php?error=' .base64_encode('telepon tidak boleh kosong'));   
    }

    // validasi apakah password dengan repassword sama
    if ($password != $repassword) { // jika tidak sama
        header('location: index.php?error=' .base64_encode('Password Berbeda'));   
    }

$pindah = move_uploaded_file($sumber, $target.$nama_gambar);
if($pindah){
    $query = "insert into tb_pelanggan values ('','$username','$password','$ktp','$nama_gambar','$nama','$tgl','$alamat','$telepon','')";
$hasil = mysql_query($query);
}

if($hasil)
{
	//header("location:index.php");
	//echo "<script>alert('Berhasil disimpan'); location.href='index.php';</script>";
	echo "Registrasi Berhasil";
}
else{
	echo "Penyimpanan gagal";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="text-center forget">
                    <p>Back To <a href="../index.php">Login</a></p>
                </div>

</body>
</html>
 