<?php
error_reporting(null);
session_start();
include "../koneksi.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="../assets/dist/css/template.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

  <body>

  	  <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                    <h3 class="panel-title"><center><b>REGISTER</b><center></h3>
                    </div>    
    <?php
    /* handle error */
    if (isset($_GET['error'])) : ?>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong>Warning!</strong> <?=base64_decode($_GET['error']);?>
        </div>
    <?php endif;?>
    <div class="panel-body">

            <form action="tambah.php" class="inner-login" method="post" enctype="multipart/form-data">
                <fieldset>
                <div class="form-group">
                    <input type="text" class="form-control" pattern=".{5,}" required="required" name="nickname" placeholder="Nama">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" pattern=".{5,}" required="required" name="username" placeholder="username">
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="no_ktp" placeholder="nomor ktp">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="required">
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="repassword" placeholder="Re-Password"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required="required">
                </div>

                <div class="form-group">
                    <input type="date" class="form-control" name="tgl" placeholder="tanggal lahir" required="required">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="alamat" placeholder="alamat" required="required">
                </div>

                <div class="form-group">
                    <input type="number" class="form-control" name="telepon" placeholder="telepon" required="required">
                </div>

                <div class="form-group">
                    <label>Foto</label>
                     <input type="file" name="foto_pelanggan" id="gambar" class="form-control" required>
                 </div>

                <input type="submit" class="btn btn-lg btn-primary btn-block" value="REGISTER" />
                
                <div class="text-center forget">
                    <p>Back To <a href="../index.php">Login</a></p>
                </div>
            </fieldset>
            </form>

        </div>
    </div>
    </div>
</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  </body>
</html>