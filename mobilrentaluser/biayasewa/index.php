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
$sql 		= "SELECT tb_transaksi.id_transaksi, tb_mobil.id_mobil, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp as id_pelanggan, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) WHERE type_mobil LIKE '%$keyword%' or tgl_sewa LIKE '%$keyword%' ORDER BY id_transaksi";
			
$result = mysql_query($sql);
}else{
	//  jika tidak ada pencarian pakai ini
$userlogin=$_SESSION['username'];
$reload = "index.php?pagination=true";
$sql    = "SELECT tb_transaksi.id_transaksi, tb_mobil.id_mobil, tb_mobil.type_mobil, tb_mobil.harga, tb_pelanggan.no_ktp, tb_pelanggan.nama_lengkap, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa, tb_transaksi.jumlah_harga, tb_transaksi.denda, tb_transaksi.status_pembayaran, tb_transaksi.status_pengembalian 
				FROM tb_transaksi 
				INNER JOIN tb_mobil on (tb_mobil.id_mobil=tb_transaksi.id_mobil)
				INNER JOIN tb_pelanggan on (tb_pelanggan.id_pelanggan=tb_transaksi.id_pelanggan) where username = '$userlogin' ORDER BY id_transaksi"; 
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
    <title>Transaksi</title>

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
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					
					<div class="panel panel-success">
                        <div class="panel-heading">
						<button data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> PESAN MOBIL</button></div>
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
										<input type="text" name="keyword" class="form-control" placeholder="Search Nama Mobil / Tgl Sewa..." value="<?php echo $_REQUEST['keyword']; ?>">
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
                                            <th><center>Tgl Sewa<center></th>
                                            <th><center>Mobil<center></th>
                                            <th><center>NO KTP<center></th>
                                            <th><center>Nama Lengkap<center></th>
                                            <th><center>Harga<center></th>
                                            <th><center>Jumlah Harga<center></th>
                                            <th><center>Denda<center></th>
                                            <th><center>Total Harga<center></th>
                                            <th><center>Status Pembayaran<center></th>
                                            <th><center>Status Pengembalian<center></th>
											<th><center>Opsi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										while(($count<$rpp) && ($i<$tcount)) {
										mysql_data_seek($result,$i);
										$data = mysql_fetch_array($result);
									?>
										<tr>
											<td><center><?php echo ++$no_urut; ?></center></td>
											<td><?php echo $data['tgl_sewa'] ?></td>
											<td><?php echo $data['type_mobil'] ?></td>
											<td><?php echo $data['no_ktp'] ?></td>
											<td><?php echo $data['nama_lengkap'] ?></td>
											<td><?php echo 'Rp. '. number_format($data['harga']) ?></td>
											<td><?php echo 'Rp. '. number_format($data['jumlah_harga']) ?></td>
											<td><?php echo 'Rp. '. number_format($data['denda']) ?></td>
											<td><?php echo 'Rp. '. number_format($data['jumlah_harga'] + $data['denda']) ?></td>
											<td><?php if ($data['status_pembayaran'] == 1){ echo 'Dibayar'; } else { echo 'Belum' ;} ?></td>
											<td><?php if ($data['status_pengembalian'] == 1){ echo 'Dikembalikan'; } else { echo 'Belum' ;} ?></td>
											<td>
												<center>
												
												<a class="btn btn-sm btn-warning" href="edit.php?id_transaksi=<?php echo $data['id_transaksi'] ?>" title="Edit Data" ><span class="fa fa-edit"></span></a>
												<a class="btn btn-sm btn-danger" href="delete.php?action=hapus&id_transaksi=<?php echo $data['id_transaksi'] ?>" onClick="return confirm(' Data Yakin Mau dihapus ?');" title="Hapus Data" ><span class="fa fa-trash"></span></a>
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
					<h4 class="modal-title">Tambah Transaksi Baru</h4>
				</div>
				<div class="modal-body">
					<form action="tambah.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Jenis Mobil</label>
							<select class="form-control" name="id_mobil" required="required" id="id_mobil">
								<option value="">Silahkan Pilih</option>
								<?php 
								$mbl=mysql_query("select tb_mobil.id_mobil, tb_mobil.foto_mobil, tb_jenis.nama_jenis, tb_mobil.type_mobil, tb_mobil.merk, tb_mobil.no_polisi, tb_mobil.warna, tb_mobil.harga, tb_mobil.status from tb_jenis inner join tb_mobil on (tb_jenis.id_jenis = tb_mobil.id_jenis)");
								while($tm=mysql_fetch_array($mbl)){
									
								if ($tm['status'] == "1" or $tm['status'] == "0"  )
								{	
									?>	
									<option value="<?php echo $tm['id_mobil']; ?>"><?php echo $tm['type_mobil'] ?> | <?php echo $tm['merk'] ?> | <?php echo $tm['no_polisi'] ?></option>
									<?php 
								} }
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Harga</label>
							<input name="harga" id="harga" type="text" class="form-control" placeholder="Harga .." required readonly>
						</div>
						<div class="form-group">
							<label>No KTP</label>
							<select class="form-control" name="id_pelanggan" required="required" id="id_pelanggan">
								<option value="">Pilih Pelanggan</option>
								<?php 
								$pelanggan=mysql_query("select * from tb_pelanggan where username = '$userlogin'");
								while($plg=mysql_fetch_array($pelanggan)){
									
								if ($plg['status_peminjaman'] == "0" or $plg['status_peminjaman'] == "1" )
								{	
									?>	
									<option value="<?php echo $plg['id_pelanggan']; ?>"><?php echo $plg['no_ktp'] ?></option>
									<?php 
								} }
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input name="nama_lengkap" id="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap .." required readonly>
						</div>
						<div class="form-group">
							<label>Tanggal Sewa</label>
							<div class='input-group date' id='datetimepicker'>
								<input name="tanggal_sewa" type="text" class="form-control" placeholder="Nama Lengkap .." required/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
						<div class="form-group">
							<label>Tanggal Selesai Sewa</label>
							<div class='input-group date' id='datetimepicker1'>
								<input name="tanggal_selesai_sewa" type="text" class="form-control" placeholder="Nama Lengkap .." required/><span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
						<div class="form-group" hidden>
							<label>Denda</label>
							<input name="denda" type="text" class="form-control" placeholder="denda .." value="0" required>
						</div>
						<div class="form-group" hidden>
							<label>Status Pembayaran</label>
							<input name="status_pembayaran" type="text" class="form-control" placeholder="pembayaran .." value="0" required>
						</div>
						<div class="form-group" hidden>
							<label>Status Pengembalian</label>
							<input name="status_pengembalian" type="text" class="form-control" placeholder="pembayaran .." value="0" required>
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
