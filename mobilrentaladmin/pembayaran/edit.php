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
						$id_bayar = mysql_real_escape_string($_GET['id_bayar']);
						$det = mysql_query("SELECT tb_pembayaran.id_bayar, tb_pembayaran.tgl_bayar, tb_transaksi.id_transaksi, tb_pembayaran.pembayaran, tb_pembayaran.no_rek, tb_pembayaran.nama_bank, tb_pembayaran.atas_nama from tb_transaksi inner join tb_pembayaran on (tb_transaksi.id_transaksi = tb_pembayaran.id_transaksi) where id_bayar='$id_bayar'")or die(mysql_error());
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
										<td><input type="hidden" name="id_bayar" value="<?php echo $d['id_bayar'] ?>"></td>
									</tr>
									<tr>
										<td>ID Transaksi</td>
										<td><input name="id_transaksi"  id="id_transaksi" type="text" class="form-control" placeholder="Transaksi .." required="required" value="<?php echo $d['id_transaksi']; ?>" readonly>
										</td>
									</tr>
									<tr>
										<td>Tanggal Bayar</td>
										<td><input name="tanggal_bayar"  id="tanggal_bayar" type="text" class="form-control" placeholder="Tanggal Bayar .." required="required" value="<?php echo $d['tgl_bayar']; ?>"></td>
									</tr>
									<tr>
										<td>Pembayaran</td>
										<td><select class="form-control" name="pembayaran" required="required" id="pembayaran" onchange="proses()">
											<option value=""> -- Silahkan Pilih -- </option>
												<option value="Cash" <?php if($d['pembayaran'] == 'Cash'){ echo 'selected'; } ?>> Cash </option>
												<option value="Transfer Bank" <?php if($d['pembayaran'] == 'Transfer Bank'){ echo 'selected'; } ?>> Transfer Bank </option>
										</td>
									</tr>
									<div id="transfer_bayar">
									<tr>
										<td>No Rekening</td>
										<td><input name="no_rek" id="no_rek" type="text" class="form-control" placeholder="No Rekening .." value="<?php echo $d['no_rek']; ?>" readonly></td>
									</tr>
									<tr>
										<td>Nama Bank</td>
										<td><input name="nama_bank"  id="nama_bank" type="text" class="form-control" placeholder="Nama Bank .." value="<?php echo $d['nama_bank']; ?>" readonly></td>
									</tr>
									<tr>
										<td>Atas Nama</td>
										<td><input name="atas_nama" id="atas_nama" type="text" class="form-control" placeholder="Atas Nama .." value="<?php echo $d['atas_nama']; ?>" readonly></td>
									</tr>
									<tr>
										<td></td>
										<td>
										<input type="submit" class="btn btn-info" value="Simpan">
										<a href="index.php" class="btn btn-danger">Batal</a>
										</td>
									</tr>
									</div>
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
        $(document).ready(function(){

            $('#tanggal_bayar').datepicker({dateFormat: 'yy-mm-dd'});

        });
    </script>

	<script type="text/javascript">
	function proses() {
		var pembayaran = { pembayaran: $('#pembayaran').val()};
		if (document.getElementById("pembayaran").value == "Cash"){
			$('#no_rek').val("").attr("readonly","readonly");
			$('#nama_bank').val("").attr("readonly","readonly");
			$('#atas_nama').val("").attr("readonly","readonly");
		}     
		else {
			$('#no_rek').val("").removeAttr("readonly");
			$('#nama_bank').val("").removeAttr("readonly");
			$('#atas_nama').val("").removeAttr("readonly");
		}
		
	}
	</script>

</body>

</html>
