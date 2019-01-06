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
	<title>Edit Mobil</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/dist/css/template.css" rel="stylesheet">

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
                    <h1 class="page-header">Mobil</h1>
					<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-arrow-circle-o-right"></i><a href="index.php"> Mobil </a>
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Edit Mobil
                            </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					<?php 
						$id_mobil = mysql_real_escape_string($_GET['id_mobil']);
						$det = mysql_query("SELECT tb_mobil.id_mobil, tb_mobil.foto_mobil, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from tb_mobil where id_mobil='$id_mobil'")or die(mysql_error());
						while($d = mysql_fetch_array($det)){
					?>
					<div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-car"></i>   Edit Mobil
						</div>
                        <div class="panel-body">
							<form action="update.php" method="post" enctype="multipart/form-data">
								<table class="table">
									<tr>
										<td></td>
										<td><input type="hidden" name="id_mobil" value="<?php echo $d['id_mobil'] ?>"></td>
									</tr>
									<tr>
										<td>Foto</td>
										<td>
											<img src="../../gambar/mobil/<?php echo $d['foto_mobil'] ?>" width="250px" height="120px" /></br>
											<input type="checkbox" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto<br>
											<input name="foto" type="file" class="form-control">
										</td>
									</tr>
									<tr>
										<td>Jenis Mobil</td>
										<td><select class="form-control" name="nama_jenis">
														<?php 
														$jbt=mysql_query("select * from tb_jenis");
														while($b=mysql_fetch_array($jbt)){
															?>	
															<option value="<?php echo $b['id_jenis']; ?>" <?php if ($d['nama_jenis'] == $b['nama_jenis']) echo "selected='selected'"; ?>><?php echo $b['nama_jenis'] ?></option>
															<?php 
														}
														?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Type Mobil</td>
										<td><input type="text" class="form-control" name="type_mobil" value="<?php echo $d['type_mobil'] ?>"></td>
									</tr>
									<tr>
										<td>Merk</td>
										<td><input type="text" class="form-control" name="merk" value="<?php echo $d['merk'] ?>"></td>
									</tr>
									<tr>
										<td>No Polisi</td>
										<td><input type="text" class="form-control" name="no_polisi" value="<?php echo $d['no_polisi'] ?>"></td>
									</tr>
									<tr>
										<td>Warna</td>
										<td><input type="text" class="form-control" name="warna" value="<?php echo $d['warna'] ?>"></td>
									</tr>
									<tr>
										<td>Harga</td>
										<td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga'] ?>"></td>
									</tr>
									<tr>
										<td>Status</td>
										<td><select class="form-control" name="status" required="required">
												<option value=""> -- Silahkan Pilih -- </option>
												<option value="1" <?php if($d['status'] == '1'){ echo 'selected'; } ?>> Tersedia </option>
												<option value="0" <?php if($d['status'] == '0'){ echo 'selected'; } ?>> Tidak Tersedia </option>
											</select></td>
									</tr>
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
	
	<!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>
	
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
