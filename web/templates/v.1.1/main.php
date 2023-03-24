<?php
	//session_start(); 
	if($_SESSION['user']=='' and $_SESSION['tipe']=='')
	{
	  header('location:index.php');
	}
	else
	{
		$sql_identitas = "SELECT idk_namaperusahaan, idk_logogambar, idk_logotext FROM master_identitasperusahaan";
		$result_identitas = customQuery($sql_identitas);
		$row_identitas = mysql_fetch_array($result_identitas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<link rel="icon" type="image/png" sizes="16x16" href="picperusahan/<?php echo $row_identitas["idk_logogambar"];?>">
	<title><?php echo $row_identitas["idk_namaperusahaan"]; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link href="plugins/bower_components/jqueryui/jquery-ui.min.css" rel="stylesheet">
	<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- NEW -->
    <link href="plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
	<link href="plugins/bower_components/lobipanel/dist/css/lobipanel.min.css" rel="stylesheet">
	<!-- Table CSS -->
	<link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />   
    <!-- Menu CSS -->
    <link href="plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
	<!-- Popup CSS -->
    <link href="plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">    
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/megna.css" id="theme" rel="stylesheet">
	<!--alerts CSS -->
    <link href="plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">	
	
	<script src="http://www.w3schools.com/lib/w3data.js"></script>
	
	<!-- jQuery -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="plugins/bower_components/jqueryui/jquery-ui.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
	
	<?=$data['css']?>
</head>
<body>

	 <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
	    <div id="wrapper">
        <!-- Top Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header"> <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
                <div class="top-left-part"><a class="logo" href="./"><b><img width="40" src="picperusahan/<?php echo $row_identitas['idk_logogambar']; ?>" alt="home" /></b><span class="hidden-xs"><strong><?php echo $row_identitas["idk_namaperusahaan"]?></strong></span></a></div>
              
                <ul class="nav navbar-top-links navbar-right pull-right">      
                    <!-- /.dropdown -->
                    <li class="dropdown">
						<?php 
							if(($_SESSION['tipe']=='admin')){
								if(file_exists(picadmin.$_SESSION['img'])){
									$pic=picadminload.$_SESSION['img'];
								}else{
									$pic='img/avatars/unknown.png';
								}
								echo '
									<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="img/avatars/unknown.png" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">'.$_SESSION['nama'].'</b> </a>
									<ul class="dropdown-menu dropdown-user animated flipInY">
										<li><a href="?rt='.$_SESSION['tipe'].'&ctl=ctlbiodata&prog=biodatapersonal"><i class="ti-user"></i> Data Personal</a></li>                          
										<li role="separator" class="divider"></li>
										<li><a href="?rt=login&ctl=ctl&prog=logout"><i class="fa fa-power-off"></i> Logout</a></li>
									</ul>
								';
							}
							if(($_SESSION['tipe']=='operator')){
								if(file_exists(picpegawai.$_SESSION['img'])){
									$pic=picpegawaiload.$_SESSION['img'];
								}else{
									$pic='img/avatars/unknown.png';
								}
								echo '
									<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="'.$pic.'" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">'.$_SESSION['nama'].'</b> </a>
									<ul class="dropdown-menu dropdown-user animated flipInY">
										<li><a href="?rt='.$_SESSION['tipe'].'&ctl=ctlbiodata&prog=biodatapersonal"><i class="ti-user"></i> Data Personal</a></li>                          
										<li role="separator" class="divider"></li>
										<li><a href="?rt=login&ctl=ctl&prog=logout"><i class="fa fa-power-off"></i> Logout</a></li>
									</ul>
								';
							}
														
						?>
                        
                        
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.Megamenu -->
                    <li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- Left navbar-header -->
		<?php 
			include("globals/menu.php");
			print(menu($_SESSION['tipe'],$data['menu'],$data['submenu'])); 
		?>

        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><?=$data['title']?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">                        
                        <ol class="breadcrumb">
                            <?=$data['sitemap']?>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">                                          
					<?=$data['isi']?>                 
                </div>
                <!-- /.row -->
				
				
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul>
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-info">
                                        <input id="checkbox1" type="checkbox" class="fxhdr">
                                        <label for="checkbox1"> Fix Header </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme working">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2022 &copy; <?php echo $row_identitas["idk_namaperusahaan"]; ?> </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
	
	<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				...
			</div>
		</div>
	</div>


    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/tether.min.js"></script>    
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="bootstrap/dist/js/bootstrap-3.3.7.min.js"></script>
    <script src="plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="plugins/bower_components/sidebar-nav/dist/sidebar-nav.js"></script>
	<!-- Draggable-panel -->
	<script src="plugins/bower_components/lobipanel/dist/js/lobipanel.min.js"></script>
    <script>
    $(function() {
        $('.panel').lobiPanel({
            sortable: true,
            reload: false,
            editTitle: false,
			close: false,
			unpin: false
        });
    });
	</script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="plugins/bower_components/counterup/jquery.counterup.min.js"></script>    
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <script src="plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    
	 <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
	<!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
	<!-- end - This is for export functionality only -->
   
    <!--Style Switcher -->
    <script src="plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
	<!-- Sweet-Alert  -->
    <script src="plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
	<!-- Magnific popup JavaScript -->
    <script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>
	
	<script src="js/websocket/config.js"></script>
	<script src="js/websocket/websockets.js"></script>
	
	<?=$data['js']?>
	
</body>
</html>
<?php
	  }
?>