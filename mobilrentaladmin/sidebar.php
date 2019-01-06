<?php 
error_reporting(null);
session_start();
include 'koneksi.php';
include 'pengguna.php';
?>


		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $root; ?>dashboard/index.php"><b>RENTAL MOBIL YOGYAKARTA</b></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
				<?php 
				if ($_SESSION['username']) : ?>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $nama->username?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li class="divider"></li>
                        <li><a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
					
                    <!-- /.dropdown-user -->
				<?php endif; ?>	
                </li>
                <!-- /.dropdown -->
            </ul>
            
            <div class="navbar sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<li>
							<center><img src="<?php echo $root; ?>/assets/gambar/mobil.jpg" class="img-responsive" width="100%"><span class="masked"> </span></center>
						</li>
						<li>
                            <a href="<?php echo $root; ?>dashboard/index.php"><i class="fa fa-dashboard fa-fw"></i><span class="masked"> Dashboard </span></a>
                        </li>
                        <li>
                            <a href="<?php echo $root; ?>user/index.php"><i class="fa fa-user fa-fw"></i><span class="masked"> User </span></a>
                        </li>
                        <li>
                            <a href="<?php echo $root; ?>mobil/index.php"><i class="fa fa-car fa-fw"></i><span class="masked"> Mobil </span></a>
                        </li>
                        <li>
                            <a href="<?php echo $root; ?>status/index.php"><i class="fa fa-car fa-fw"></i><span class="masked"> Status </span></a>
                        </li>
						<li>
                            <a href="<?php echo $root; ?>pelanggan/index.php"><i class="fa fa-users fa-fw"></i><span class="masked"> Pelanggan </span></a>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-file fa-fw"></i> Transaksi <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo $root; ?>biayasewa/index.php">Transaksi</a>
                                </li>
                                <li>
                                    <a href="<?php echo $root; ?>pembayaran/index.php">Pembayaraan</a>
                                </li>
                                <li>
                                    <a href="<?php echo $root; ?>pengembalian/index.php">Pengembalian</a>
                                </li>
                            </ul> 
                        </li> 
                        
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
			
		</nav>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">×</span>
					</button>
				  </div>
				  <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				  <div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="<?php echo $out; ?>logout.php">Logout</a>
				  </div>
				</div>
			  </div>
			</div>