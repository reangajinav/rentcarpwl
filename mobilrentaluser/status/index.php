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
$sql 		= "SELECT tb_mobil.foto_mobil, tb_mobil.type_mobil, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa from tb_mobil inner join tb_transaksi on tb_mobil.id_mobil = tb_transaksi.id_mobil left join tb_pengembalian on tb_transaksi.id_transaksi = tb_pengembalian.id_transaksi WHERE tb_pengembalian.id_transaksi is null AND type_mobil LIKE '%$keyword%' ORDER BY tgl_sewa asc";
			
$result = mysql_query($sql);
}else{
	//  jika tidak ada pencarian pakai ini
$reload = "index.php?pagination=true";
$sql    = "SELECT tb_mobil.foto_mobil, tb_mobil.type_mobil, tb_transaksi.tgl_sewa, tb_transaksi.tgl_selesaisewa from tb_mobil inner join tb_transaksi on tb_mobil.id_mobil = tb_transaksi.id_mobil left join tb_pengembalian on tb_transaksi.id_transaksi = tb_pengembalian.id_transaksi WHERE tb_pengembalian.id_transaksi is null ORDER BY tgl_sewa asc"; 
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
    <title>Status Peminjaman</title>

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
                    <h1 class="page-header">Status Ketersediaan</h1>
					
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<div class="col-md-12">
					
					<div class="panel panel-success">
                        <div class="panel-heading">
						<center></h3>Status<center><h3>
						</div>
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
										<input type="text" name="keyword" class="form-control" placeholder="Search Type Mobil..." value="<?php echo $_REQUEST['keyword']; ?>">
										<span class="input-group-btn">
											<button class="btn btn-success" type="submit">Cari
											</button>
										</span>
									</div>
								</form>
							</div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th style="width:250px"><center>Foto Mobil</center></th>
                                            <th><center>Type Mobil<center></th>
                                            <th><center>Tanggal Sewa<center></th>
                                            <th><center>Tanggal Selesai Sewa</center></th>
                                            <th><center>Status</center></th>
                                            											
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
											<td align="center"><img src="../../gambar/mobil/<?php echo $data['foto_mobil'] ?>" width="200px" height="150px"/></td>
											<td><?php echo $data['type_mobil'] ?></td>
											<td><?php echo $data['tgl_sewa'] ?></td>
											<td><?php echo $data['tgl_selesaisewa'] ?></td>
											<td>Di Pinjam</td>
																						
										</tr>
									<?php
										$i++;	
										$count++;	
										}
									?>
                                    </tbody>
                                </table>
                                <h3 style="color: red"> NOTE : JIKA TERJADI PEMESANAN PADA MOBIL DAN TANGGAL YANG SAMA MAKA PEMESANAN AKAN DI CANCEL OLEH ADMIN!!!</h3>
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
