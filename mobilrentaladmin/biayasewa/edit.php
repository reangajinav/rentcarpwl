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
	<title>Edit Transaksi</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

	<!-- Custom CSS jquery ui -->
    <link href="../assets/dist/js/jquery-ui/jquery-ui.css" rel="stylesheet">
	
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
                    <h1 class="page-header">Transaksi</h1>
					<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-arrow-circle-o-right"></i><a href="index.php"> Transaksi </a>
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Edit Transaksi
                            </li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					<?php 
						$id_transaksi = mysql_real_escape_string($_GET['id_transaksi']);
						$det = mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.id_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
											FROM tb_transaksi 
											INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
											INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where id_transaksi='$id_transaksi'")or die(mysql_error());
						while($d = mysql_fetch_array($det)){
					?>
					<div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-car"></i>   Edit Transaksi
						</div>
                        <div class="panel-body">
							<form action="update.php" method="post" enctype="multipart/form-data">
								<table class="table">
									<tr>
										<td></td>
										<td><input type="hidden" name="id_transaksi" value="<?php echo $d['id_transaksi'] ?>"></td>
									</tr>
									<tr>
										<td>ID Mobil</td>
										<td><input type="text" class="form-control" name="id_mobil" id="id_mobil" value="<?php echo $d['id_mobil'] ?>" readonly>
										</td>
									</tr>
									<tr>
										<td>Harga</td>
										<td><input type="text" class="form-control" name="harga" id="harga" value="<?php echo $d['harga'] ?>" readonly></td>
									</tr>
									<tr>
										<td>No KTP</td>
										<td><select class="form-control" name="id_pelanggan" required="required" id="id_pelanggan" readonly>
												<?php 
												$pelanggan=mysql_query("select * from tb_pelanggan");
												while($plg=mysql_fetch_array($pelanggan)){
														
													
												?>  
													<option value="<?php echo $plg['id_pelanggan']; ?>" <?php if ($d['no_ktp'] == $plg['no_ktp']) echo "selected='selected'";?> ><?php echo $plg['no_ktp']; ?></option>
													<?php
												}	
												
												?>
											</select>
										</td>
									</tr>
									<tr>
										<td>Nama Lengkap (Saat Ini : <?php echo $d['nama_lengkap'] ?>)</td>
										<td><input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?php echo $d['nama_lengkap'] ?>" readonly></td>
									</tr>
									<tr>
										<td>Tanggal Sewa </td>
										<td><div class='input-group date' id='datetimepicker' value="<?php echo $d['tanggal_sewa'] ?>">
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input name="tanggal_sewa" type="text" class="form-control" placeholder="Tanggal Sewa .." required value="<?php echo $d['tgl_sewa'] ?>"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>Tanggal Selesai Sewa</td>
										<td><div class='input-group date' id='datetimepicker1'>
												<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span><input name="tanggal_selesai_sewa" type="text" class="form-control" placeholder="Tanggal Selesai Sewa .." required value="<?php echo $d['tgl_selesaisewa'] ?>"/>
											</div>
										</td>
									</tr>
									<tr hidden>
										<td>Denda</td>
										<td><input type="text" class="form-control" name="denda" value="<?php echo $d['denda'] ?>"></td>
									</tr>
									<tr>
										<td>Status Pembayaran</td>
										<td><select class="form-control" name="status_pembayaran" required="required">
												<option value=""> -- Silahkan Pilih -- </option>
												<option value="1" <?php if($d['status_pembayaran'] == '1'){ echo 'selected'; } ?>> Sudah Bayar </option>
												<option value="0" <?php if($d['status_pembayaran'] == '0'){ echo 'selected'; } ?>> Belum Bayar </option>
											</select></td>
									</tr>
									<tr>
										<td>Status Pengembalian</td>
										<td><select class="form-control" name="status_pengembalian" required="required">
												<option value=""> -- Silahkan Pilih -- </option>
												<option value="1" <?php if($d['status_pengembalian'] == '1'){ echo 'selected'; } ?>> Sudah DIkembalikan </option>
												<option value="0" <?php if($d['status_pengembalian'] == '0'){ echo 'selected'; } ?>> Tracking </option>
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
	
    <!-- jQuery -->
    <script src="../assets/vendor/jquery/moment.min.js"></script>

    <!-- Bootstrap Datetimepicker JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/template.js"></script>
	
	<!-- Metis Menu Plugin JavaScript -->
    <script src="../assets/vendor/metisMenu/metisMenu.min.js"></script>
		
	<!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/jquery-ui/jquery-ui.js"></script>
	
	<script type="text/javascript">
    $(document).ready(function() {
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            $("#wrapper.toggled").find("#sidebar-wrapper").find(".collapse").collapse("hide");
        });
    });
    </script>
	
	<script type="text/javascript">
	$('#id_mobil').change(function () {
		var id_mobil = { id_mobil: $('#id_mobil').val()};
		var url = 'get_mobil.php';
		$.post(url, id_mobil, function(data) {
			var result = JSON.parse(data);
			if (id_mobil != '') {
				$('#harga').val(result.harga);
			} else {
				$('#harga').val('');
			}	
		});
	});
	</script>
	
	<script type="text/javascript">
	$('#id_pelanggan').change(function () {
		var id_pelanggan = { id_pelanggan: $('#id_pelanggan').val()};
		var url = 'get_pelanggan.php';
		$.post(url, id_pelanggan, function(data) {
			var result = JSON.parse(data);
			if (id_pelanggan != '') {
				$('#nama_lengkap').val(result.nama_lengkap);
			} else {
				$('#nama_lengkap').val('');
			}
		});
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
	
	<script type="text/javascript">
	$(function () {
    $('#datetimepicker').datetimepicker();
	$('#datetimepicker1').datetimepicker();
	});
	</script>

</body>

</html>
