<?php
error_reporting(null);
session_start();
$root = '../';
$out = '../';
include "../koneksi.php";
include "../pengguna.php";
include "../set.php";

// mengatur vaiabel reload dan sql 

$userlogin = $_SESSION['username'];
$sqlfoto= "SELECT * from tb_pelanggan WHERE username = '$userlogin'";
$res= mysql_query($sqlfoto);



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
                        <center></h3>PROFILE<center><h3>
                        </div>
                        <div class="panel-body">

							<div>
								<form method="post" action="index.php">
						
								</form>
							</div>
							<br><br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th><center>No</center></th>
                                            <th style="width:250px"><center>Foto</center></th>
                                            <th><center>Username<center></th>
                                            <th><center>Nama Lengkap<center></th>
                                            <th><center>No KTP<center></th>
                                            <th><center>Tanggal Lahir<center></th>
                                            <th><center>Alamat<center></th>	
                                            <th><center>No Telepon<center></th>
                                            <th><center>Status Peminjaman<center></th>
											<th><center>Opsi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										$data = mysql_fetch_array($result);
										$data2 = mysql_fetch_array($res);
									?>
										<tr>
											<td><center><?php echo ++$no_urut; ?></center></td>
											<td align="center"><img src="../../gambar/<?php echo $data2['foto_pelanggan'] ?>" width="200px" height="150px"/></td>
											<td align="center"><?php echo $data2['username'] ?></td>
											<td align="center"><?php echo $data2['nama_lengkap'] ?></td>
											<td align="center"><?php echo $data2['no_ktp'] ?></td>
											<td align="center"><?php echo $data2['tanggal_lahir'] ?></td>
											<td align="center"><?php echo $data2['alamat_pelanggan'] ?></td>
											<td align="center"><?php echo $data2['no_telepon'] ?></td>
											<td align="center"><?php if ($data2['status_peminjaman'] == 1){ echo 'Approve'; } else { echo 'No record' ;} ?></td>
											<td>
												<center>
												<a class="btn btn-sm btn-warning" href="edit.php?id_pelanggan=<?php echo $data2['id_pelanggan'] ?>" title="Edit Data" ><span class="fa fa-edit"></span></a>
												</center>
											</td>
										</tr>
									
                                    </tbody>
                                </table>
	
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
		
	<!-- Custom Theme JavaScript -->
    <script src="../assets/dist/js/jquery-ui/jquery-ui.js"></script>
	

</body>

</html>
