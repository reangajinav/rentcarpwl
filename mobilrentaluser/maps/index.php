<?php

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
    <title>Maps</title>

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
                <div class="col-lg-8">
                    <h1 class="page-header">Maps</h1>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
        <div class="col-md-5">
          <div class="panel panel-primary">
     
                        <div class="panel-body">
              <div class="col-lg-8">
                <!--muncul jika ada pencarian (tombol reset pencarian)-->
              <head>
        <title>Google Map - Harviacode.com</title>
        <script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyBYTyY2QP4RTUvQpOkBso9Qs8wX3d1Swkg&callback=initMap"></script>
    </head>
    <body>
        <div id="map" style="width: 600px; height: 300px;"></div> 
 
        <script type="text/javascript">
              
//              menentukan koordinat titik tengah peta
              var myLatlng = new google.maps.LatLng(-7.7539771,110.3979802);
 
//              pengaturan zoom dan titik tengah peta
              var myOptions = {
                  zoom: 13,
                  center: myLatlng
              };
              
//              menampilkan output pada element
              var map = new google.maps.Map(document.getElementById("map"), myOptions);
              
//              menambahkan marker
              var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: map,
                   title:"OFFICE"
              });
        </script> 
    </body>
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

