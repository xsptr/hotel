<?php
error_reporting(0);
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
session_start();
if (empty($_SESSION[username]) AND empty($_SESSION[password])){
  echo "<SCRIPT language=Javascript>
  alert('Untuk mengakses halaman ini anda harus login terlebih dahulu')
  </script>";
  echo "<meta http-equiv='refresh' content='0; url=../index.php'/>";
}
else{
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>APLIKASI PEMESANAN KAMAR HOTEL</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bootstrap/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.minn.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/skin-blue-light.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">

    <!-- Boostrap Sub Menu -->
    <link rel="stylesheet" href="../dist/css/bootstrap-submenu.min.css">

    <link href="../dist/slider/js-image-slider.css" rel="stylesheet" type="text/css" />
    <script src="../dist/slider/js-image-slider.js" type="text/javascript"></script>

    <!-- Google Maps API -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>

    <script>
        // fungsi initialize untuk mempersiapkan peta
        function initialize() {
        var propertiPeta = {
            center:new google.maps.LatLng(-7.310027,108.231748),
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        
        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        // membuat marker
        var marker=new google.maps.Marker({
          position: new google.maps.LatLng(-7.310027,108.231748),
          map: peta
        });
        }

        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue-light layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="#" class="navbar-brand"><b>NADZIRA HOTEL</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                
                <li><a class="fa fa-home" href="?pg=dashboard"> Beranda</a></li>
                <li class="dropdown">
                <a class="fa fa-database" href="#" class="dropdown-toggle" data-toggle="dropdown"> Data Master <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li><a class="fa fa-circle" href="?pg=trk&act=view"> Data Kamar Hotel</a></li>
                <li><a class="fa fa-circle" href="?pg=pytr&act=view"> Data Pelanggan</a></li>
				<li><a class="fa fa-circle" href="?pg=adm&act=view"> Data Admin</a></li>
                </ul>
                </li>

                <li class="dropdown">
                <a class="fa fa-shopping-cart" href="#" class="dropdown-toggle" data-toggle="dropdown"> Transaksi <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                <li><a class="fa fa-circle" href="?pg=trs&act=view"> Sewa Kamar</a></li>
                </ul>
                </li>

                <li><a href="?pg=about"> About</a></li>

                <li><a href="?pg=contact"> Kontak Kami</a></li>
              </ul>
              
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- User Account Menu -->
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="../dist/img/avatar5.png" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php echo "$_SESSION[username]" ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="../dist/img/avatar5.png" class="img-circle" alt="User Image">
                        <p>
                         <?php echo strtoupper($_SESSION[username]);
                         ?>
                          
                        </p>
                      </li>
                      
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-right">
                          <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-custom-menu -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>

          <!-- Main content -->
          <?php include "content.php"; ?>
          <!-- /.content -->


      <footer class="main-footer">
        <div class="container">
          <div class="pull-right hidden-xs">
            <b></b>
          </div>
          <strong>Copyright &copy; 2020 <a href="#">APLIKASI PEMESANAN KAMAR HOTEL</a></strong>
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../dist/js/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- daterangepicker -->
    <script src="../dist/js/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
     <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js"></script>
    <!-- Donut Chart -->
    <script src="../plugins/chartjs/Chart.Doughnut.js"></script>

    <!-- Fileinput.js -->
    <script src="../bootstrap/js/photo_adm.js"></script>

    <!-- Select2 -->
    <script src="../plugins/select2/select2.full.min.js"></script>

    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true
        });
      });
    </script>
    
    <!-- page script Select2 Elements -->
    <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
         });
    </script>
    
    <!-- page script Submenu -->
    <script src="../dist/js/bootstrap-submenu.min.js"></script>

    <!-- page script Dropdown Submenu -->
    <script type="text/javascript">
    $(document).ready(function() {

    $( ".dropdown-submenu" ).click(function(event) {
        // stop bootstrap.js to hide the parents
        event.stopPropagation();
        // hide the open children
        $( this ).find(".dropdown-submenu").removeClass('open');
        // add 'open' class to all parents with class 'dropdown-submenu'
        $( this ).parents(".dropdown-submenu").addClass('open');
        // this is also open (or was)
        $( this ).toggleClass('open');
      });
  });
    </script>

    <!-- page script datepicker -->
    <script>
    $(document).ready(function(){
      var date_input=$('input[id="date"]'); //our date input has the name "date"
      var container=$('.content form').length>0 ? $('.content form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>


  </body>
</html>

<?php
}
?>