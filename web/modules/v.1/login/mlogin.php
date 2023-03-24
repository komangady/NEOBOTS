<?php
function mlogin(){
	$data = array();
	$sql_identitas = "SELECT idk_namaperusahaan, idk_namaperusahaan, idk_logogambar, idk_logotext FROM master_identitasperusahaan";
	$result_identitas = customQuery($sql_identitas);
	$row_identitas = mysql_fetch_array($result_identitas);
	$data['isi']='
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<title>'.$row_identitas["idk_namaperusahaan"].'</title>
			<meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--===============================================================================================-->	
			<link rel="icon" type="image/png" sizes="16x16" href="picperusahan/'.$row_identitas["idk_logogambar"].'">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="login_theme/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="login_theme/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="login_theme/vendor/animate/animate.css">
		<!--===============================================================================================-->	
			<link rel="stylesheet" type="text/css" href="login_theme/vendor/css-hamburgers/hamburgers.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="login_theme/vendor/animsition/css/animsition.min.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="login_theme/vendor/select2/select2.min.css">
		<!--===============================================================================================-->	
			<link rel="stylesheet" type="text/css" href="login_theme/vendor/daterangepicker/daterangepicker.css">
		<!--===============================================================================================-->
			<link rel="stylesheet" type="text/css" href="login_theme/css/util.css">
			<link rel="stylesheet" type="text/css" href="login_theme/css/main.css">
		<!--===============================================================================================-->
		
		</head>
		<body>
			
			<div class="limiter">
				<div class="container-login100">
					<div class="wrap-login100">
						<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" action="?rt=login&ctl=ctl&prog=vlogin" id="masuk" name="masuk">
							<span class="login100-form-title">
								Sign In
							</span>

							<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
								<input class="input100" type="text" name="username" placeholder="Username">
								<span class="focus-input100"></span>
							</div>

							<div class="wrap-input100 validate-input" data-validate = "Please enter password">
								<input class="input100" type="password" name="password" placeholder="Password">
								<span class="focus-input100"></span>
							</div>

							<div class="text-right p-t-13 p-b-23">
								<span class="txt1">
									Forgot
								</span>

								<a href="#" class="txt2">
									Username / Password?
								</a>
							</div>

							<div class="container-login100-form-btn">
								<button class="login100-form-btn">
									Sign in
								</button>
								<div id="msg_errorsdata"></div>
							</div>

							<div class="flex-col-c p-t-80 p-b-40">
								
							</div>
						</form>
					</div>
				</div>
			</div>
			

		<!--===============================================================================================-->
			<script src="login_theme/vendor/jquery/jquery-3.2.1.min.js"></script>
		<!--===============================================================================================-->
			<script src="login_theme/vendor/animsition/js/animsition.min.js"></script>
		<!--===============================================================================================-->
			<script src="login_theme/vendor/bootstrap/js/popper.js"></script>
			<script src="login_theme/vendor/bootstrap/js/bootstrap.min.js"></script>
		<!--===============================================================================================-->
			<script src="login_theme/vendor/select2/select2.min.js"></script>
		<!--===============================================================================================-->
			<script src="login_theme/vendor/daterangepicker/moment.min.js"></script>
			<script src="login_theme/vendor/daterangepicker/daterangepicker.js"></script>
		<!--===============================================================================================-->
			<script src="login_theme/vendor/countdowntime/countdowntime.js"></script>
		<!--===============================================================================================-->
			<script src="login_theme/js/main.js"></script>	
		<!--===============================================================================================-->
		
			<script type="text/javascript">
				$(document).ready(function(){
					$(\'#masuk\').submit(function(e) {
						$(\'#msg_errorsdata\').text(\'Please wait...\');
						$.ajax({
							type: "POST",
							url: $(this).attr(\'action\'),
							data: $(this).serialize(),
							success: function(msg){
								$(\'#msg_errorsdata\').html(msg);
							}
						});
						return false;
					});
				});
			</script>
		</body>
		</html>

	';
	
	return _display('login.php',$content=$data);
}
?>