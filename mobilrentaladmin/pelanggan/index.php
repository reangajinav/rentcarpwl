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
$sql 		= "SELECT * FROM tb_pelanggan WHERE nama_lengkap LIKE '%$keyword%' ORDER BY id_pelanggan";
			
$result = mysql_query($sql);
}else{
	//  jika tidak ada pencarian pakai ini
$reload = "index.php?pagination=true";
$sql    = "SELECT * FROM tb_pelanggan WHERE nama_lengkap LIKE '%$keyword%' ORDER BY id_pelanggan"; 
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
    <title>Pelanggan</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
						<button data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span> Tambah Data Pelanggan</button></div>
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
										<input type="text" name="keyword" class="form-control" placeholder="Search Nama Pelanggan..." value="<?php echo $_REQUEST['keyword']; ?>">
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
                                            <th style="width:250px"><center>Foto</center></th>
                                            <th><center>Nama Lengkap<center></th>
                                            <th><center>No Telepon<center></th>
                                            <th><center>Status Peminjaman<center></th>
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
											<td align="center"><img src="../../gambar/<?php echo $data['foto_pelanggan'] ?>" width="200px" height="150px"/></td>
											<td><?php echo $data['nama_lengkap'] ?></td>
											<td><?php echo $data['no_telepon'] ?></td>
											<td><?php if ($data['status_peminjaman'] == 1){ echo 'Approve'; } else { echo 'Pandding' ;} ?></td>
											<td>
												<center>
												<a class="btn btn-sm btn-info" href="laporan.php?id_pelanggan=<?php echo $data['id_pelanggan'] ?>" target="_blank" title="Print Data" ><span class="fa fa-print"></span></a>
												<a class="btn btn-sm btn-warning" href="edit.php?id_pelanggan=<?php echo $data['id_pelanggan'] ?>" title="Edit Data" ><span class="fa fa-edit"></span></a>
												<a class="btn btn-sm btn-danger" href="delete.php?action=hapus&id_pelanggan=<?php echo $data['id_pelanggan'] ?>" onClick="return confirm(' Data Yakin Mau dihapus ?');" title="Hapus Data" ><span class="fa fa-trash"></span></a>
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
					<h4 class="modal-title">Tambah Pelanggan Baru</h4>
				</div>
				<div class="modal-body">
					<form action="tambah.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>No KTP</label>
							<input name="no_ktp" type="text" class="form-control" placeholder="No KTP .." required>
						</div>
						<div class="form-group">
							<label>Foto</label>
							<input name="foto_pelanggan" id="gambar" type="file" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input name="nama_lengkap" type="text" class="form-control" placeholder="Nama Lengkap .." required>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input name="tanggal_lahir" id="tgl_lahir" type="text" class="form-control" placeholder="Tanggal Lahir .." required>
						</div>
						<div class="form-group">
							<label>Alamat Pelanggan</label>
							<input name="alamat_pelanggan" type="text" class="form-control" placeholder="Alamat Pelanggan .." required>
						</div>
						<div class="form-group">
							<label>No Telepon</label>
							<input name="no_telepon" type="text" class="form-control" placeholder="No Telepon .." required>
						</div>
						<div class="form-group" hidden>
							<label>Status Peminjaman</label>
							<input name="status_peminjaman" type="text" class="form-control" value="0" required>
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

            $('#tgl_lahir').datepicker({dateFormat: 'yy-mm-dd'});

        });
    </script>

</body>

</html>
