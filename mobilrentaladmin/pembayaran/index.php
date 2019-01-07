<?php
error_reporting(null);
session_start();
$root = '../';
$out = '../';
include "../koneksi.php";
include "../pengguna.php";
include "../pagination.php";
include "../set.php";

// mengatur vaiabel reload dan sql 
if (isset($_REQUEST['keyword']) && $_REQUEST['keyword']<>""){
// jika ada kata kunci pencarian (artinya form pencarian disubmit dan tidak kosong)
	// pakai ini
$keyword	= $_REQUEST['keyword'];
$reload		= "index.php?pagination=true&keyword=$keyword";
$sql 		= "SELECT tb_pembayaran.id_bayar, tb_pembayaran.tgl_bayar, tb_transaksi.id_transaksi, tb_transaksi.nama_lengkap, tb_pembayaran.pembayaran, tb_pembayaran.no_rek, tb_pembayaran.nama_bank, tb_pembayaran.atas_nama from tb_transaksi inner join tb_pembayaran on (tb_transaksi.id_transaksi = tb_pembayaran.id_transaksi) WHERE nama_lengkap LIKE '%$keyword%' ORDER BY id_bayar";
			
$result = mysql_query($sql);
}else{
	//  jika tidak ada pencarian pakai ini
$reload = "index.php?pagination=true";
$sql    = "SELECT tb_pembayaran.id_bayar, tb_pembayaran.tgl_bayar, tb_transaksi.id_transaksi, tb_transaksi.nama_lengkap, tb_pembayaran.pembayaran, tb_pembayaran.no_rek, tb_pembayaran.nama_bank, tb_pembayaran.atas_nama from tb_transaksi inner join tb_pembayaran on (tb_transaksi.id_transaksi = tb_pembayaran.id_transaksi) ORDER BY id_bayar"; 
$result = mysql_query($sql);
}
//pagination
$rpp 		= 5; // jumlah record per halaman
$page 		= intval($_GET["page"]);
if($page<=0) $page = 1;  
$tcount 	= mysql_num_rows($result);
$tpages 	= ($tcount) ? ceil($tcount/$rpp) : 1; // total pages, last page number
$count		= 0;
$i 			= ($page-1)*$rpp;
$no_urut	= ($page-1)*$rpp;


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pembayaran</title>

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
                    <h1 class="page-header">Pelanggan</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">

					<div class="panel panel-success">
                        <div class="panel-heading">
						<button data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Tambah Data Pembayaran</button></div>
                        <div class="panel-body">
							<div class="col-lg-8">
								<!--muncul jika ada pencarian (tombol reset pencarian)-->
								<?php
								if($_REQUEST['keyword']<>""){
								?>
									<a class="btn btn-default btn-outline" href="index.php"> Kembali </a>
								<?php
								}
								?>
							</div>
							<div>
								<form method="post" action="index.php">
									<div class="form-group input-group">
										<input type="text" name="keyword" class="form-control" placeholder="Search Nama..." value="<?php echo $_REQUEST['keyword']; ?>">
										<span class="input-group-btn">
											<button class="btn btn-success" type="submit">Cari
											</button>
										</span>
									</div>
								</form>
							</div>
							<br><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th><center>Tgl Bayar<center></th>
                                            <th><center>ID Transaksi<center></th>
                                            <th><center>Nama Lengkap<center></th>
                                            <th><center>Pembayaran<center></th>
                                            <th><center>Opsi<center></th>
                                    </thead>
                                    <tbody>
									<?php
										while(($count<$rpp) && ($i<$tcount)) {
										mysql_data_seek($result,$i);
										$data = mysql_fetch_array($result);
									?>
										<tr>
											<td><center><?php echo ++$no_urut; ?></center></td>
											<td><?php echo $data['tgl_bayar'] ?></td>
											<td align="center"><?php echo $data['id_transaksi']?></td>
											<td align="center"><?php echo $data['nama_lengkap'] ?></td>
											<td><?php echo $data['pembayaran'] ?></td>
											<td>
												<center>
												<a class="btn btn-sm btn-warning" href="edit.php?id_bayar=<?php echo $data['id_bayar'] ?>" title="Edit Data" ><span class="fa fa-edit"></span></a>
												<a class="btn btn-sm btn-danger" href="delete.php?action=hapus&id_bayar=<?php echo $data['id_bayar'] ?>" onClick="return confirm(' Data Yakin Mau dihapus ?');" title="Hapus Data" ><span class="fa fa-trash"></span></a>
												</center>
											</td>
										</tr>
									<?php
										$i++;	
										$count++;	
										}
									?>
                                    </tbody>
                                </table>
								<center>		
									<div><?php echo paginate_one($reload, $page, $tpages); ?></div>		
								</center>	
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
				</div>
            </div>
            <!-- /.row -->
            <div class="row">
                
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<!-- modal input -->
	<div id="myModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Tambah Pembayaran Baru</h4>
				</div>
				<div class="modal-body">
					<form action="tambah.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>ID Transaksi</label>
							<select class="form-control" name="id_transaksi" required="required">
								<option value="">Silahkan Pilih</option>
								<?php 
								$trs=mysql_query("SELECT tb_transaksi.id_transaksi, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
													FROM tb_transaksi 
													INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
													INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan)");
								while($tf=mysql_fetch_array($trs)){
									
								if ($tf['status_pembayaran'] == "0" )
								{	
									?>	
									<option value="<?php echo $tf['id_transaksi']; ?>"><?php echo $tf['tgl_sewa'] ?> | <?php echo $tf['nama_lengkap'] ?> | <?php echo 'Rp. '. number_format($tf['jumlah_harga']) ?></option>
									<?php 
								} }
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Tanggal Bayar</label>
							<input name="tanggal_bayar"  id="tanggal_bayar" type="text" class="form-control" placeholder="Tanggal Bayar .." required="required">
						</div>
						<div class="form-group">
							<label>Pembayaran</label>
							<select class="form-control" name="pembayaran" required="required" id="pembayaran" onchange="proses()">
								<option value=""> -- Silahkan Pilih -- </option>
								<option value="Cash">Cash</option>
								<option value="Transfer Bank">Transfer Bank</option>
							</select>
						</div>
						<div id="transfer_bayar">
						<div class="form-group" id="no_rek">
							<label>No Rekening</label>
							<input name="no_rek" type="text" class="form-control" placeholder="No Rekening ..">
						</div>
						<div class="form-group" id="nama_bank">
							<label>Nama Bank</label>
							<input name="nama_bank" type="text" class="form-control" placeholder="Nama Bank ..">
						</div>
						<div class="form-group" id="atas_nama">
							<label>Atas Nama</label>
							<input name="atas_nama" type="text" class="form-control" placeholder="Atas Nama ..">
						</div>
						</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
					</form>
			</div>
		</div>
	</div>

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
			$('#no_rek').val("").hide("#transfer_bayar");
			$('#nama_bank').val("").hide("#transfer_bayar");
			$('#atas_nama').val("").hide("#transfer_bayar");
		}     
		else {
			$('#no_rek').val("").show("#transfer_bayar");
			$('#nama_bank').val("").show("#transfer_bayar");
			$('#atas_nama').val("").show("#transfer_bayar");
		}
		
	}
	</script>
</body>

</html>
