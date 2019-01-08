<?php
error_reporting(null);
session_start();
$root = '../';
$out = '../';
include "../koneksi.php";
include "../pengguna.php";
include "../set.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Edit Pelanggan</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/dist/css/template.css" rel="stylesheet">
	
	<!-- Custom CSS jquery ui -->
    <link href="../assets/dist/js/jquery-ui/jquery-ui.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php 
			include '../sidebar.php' ;
		?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pelanggan</h1>
					<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-users"></i><a href="index.php"> Pelanggan </a>
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Edit Pelanggan
                            </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					<?php 
						$id_pelanggan = mysql_real_escape_string($_GET['id_pelanggan']);
						$det = mysql_query("SELECT * FROM tb_pelanggan where id_pelanggan='$id_pelanggan'")or die(mysql_error());
						while($d = mysql_fetch_array($det)){
					?>
					<div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-users"></i>   Edit Pelanggan
						</div>
                        <div class="panel-body">
							<form action="update.php" method="post" enctype="multipart/form-data">
								<table class="table">
									<tr>
										<td></td>
										<td><input type="hidden" name="id_pelanggan" class="form-control" value="<?php echo $d['id_pelanggan'] ?>"></td>
									</tr>
									<tr>
										<td>Username</td>
										<td><input type="text" name="username" class="form-control" value="<?php echo $d['username'] ?>"></td>
									</tr>
									<tr>
										<td>Password</td>
										<td><input type="text" name="password" class="form-control" value=""></td>
									</tr>
									<tr>
										<td>No KTP</td>
										<td><input type="text" name="no_ktp" class="form-control" value="<?php echo $d['no_ktp'] ?>"></td>
									</tr>
									<tr>
										<td>Foto</td>
										<td>
											<img src="gambar/<?php echo $d['foto_pelanggan'] ?>" width="150px" height="120px" /></br>
											<input type="checkbox" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto<br>
											<input name="foto" type="file" class="form-control">
										</td>
									</tr>
									<tr>
										<td>Nama Lengkap</td>
										<td><input type="text" class="form-control" name="nama_lengkap" value="<?php echo $d['nama_lengkap'] ?>"></td>
									</tr>
									<tr>
										<td>Tanggal Lahir</td>
										<td><input type="text" class="form-control" name="tanggal_lahir" id="tgl_lahir" value="<?php echo $d['tanggal_lahir'] ?>"></td>
									</tr>
									<tr>
										<td>Alamat Tinggal</td>
										<td><input type="text" class="form-control" name="alamat_pelanggan" value="<?php echo $d['alamat_pelanggan'] ?>"></td>
									</tr>
									<tr>
										<td>No Telepon</td>
										<td><input type="text" class="form-control" name="no_telepon" value="<?php echo $d['no_telepon'] ?>"></td>
									</tr>
									<tr>
									<tr>
										<td></td>
										<td>
										<input type="submit" class="btn btn-info" value="Simpan">
										<a href="index.php" class="btn btn-danger">Batal</a>
										</td>
									</tr>
								</table>
							</form>
							<?php 
								}
							?>
                        </div>
                    </div>
				</div>
            </div>
            <!-- /.row -->
            </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
		
	
	<!-- jQuery -->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/template.js"></script>
	
    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/jquery-ui/jquery-ui.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>
	
	<script type="text/javascript">
        $(document).ready(function(){

            $('#tgl_lahir').datepicker({dateFormat: 'yy-mm-dd'});

        });
    </script>
	
	<script type="text/javascript">
    $(document).ready(function() {
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            $("#wrapper.toggled").find("#sidebar-wrapper").find(".collapse").collapse("hide");
        });
    });
    </script>
</body>

</html>
