<?php 
	function biodataubahpwdver() {
		$data = array();

		$data['namefield'][] = 'pw';
		if (empty($_POST['pw'])) {
			$data['statusfield'][] = false;
			$data['msg'][] = 'Password empty!';
		} else {
			$pw = md5($_POST['pw']);

			$sql = "SELECT * FROM user WHERE JenisUser = 'operator' AND Username='". $_SESSION['username'] ."' AND Password='". $pw ."'";
			$result = customQuery($sql);
			$hasil = mysql_num_rows($result);

			if ($hasil <= 0) {
				$data['statusfield'][] = false;
				$data['msg'][] = 'Wrong password!';
			} else {
				$data['statusfield'][] = true;
				$data['msg'][] = '';
				
			}
		}

			$data['namefield'][] = 'password';
		if (empty($_POST['password'])) {
			$data['statusfield'][] = false;
			$data['msg'][] = 'Password empty!';
		} else {
					if (preg_match('/[0-9a-zA-Z]/', $_POST['password'])) {
				$data['statusfield'][] = true;
				$data['msg'][] = '';
				$password = $_POST['password'];
			} else {
				$data['statusfield'][] = false;
				$data['msg'][] = 'Password must number/letter';
			}
		}

			$data['namefield'][] = 'repassword';
		if (empty($_POST['repassword'])) {
			$data['statusfield'][] = false;
			$data['msg'][] = 'Password empty!';
		} else {
			if (preg_match('/[0-9a-zA-Z]/', $_POST['repassword'])) {
				if ($password == $_POST['repassword']) {
					$data['statusfield'][] = true;
					$data['msg'][] = '';
					$pass = $_POST['repassword'];
				} else {
					$data['statusfield'][] = false;
					$data['msg'][] = 'Password not match!';
				}
			} else {
				$data['statusfield'][] = false;
				$data['msg'][] = 'Password must number/letter!';
			}
		}

		if (in_array(false, $data['statusfield'])) {
			return _display('error.php', $data);
		} else {
			$password = md5($pass);
			$sql = "UPDATE user SET password='" . $password . "' WHERE JenisUser = 'operator' and Id_User='" . $_SESSION['user'] . "'";
			$result = customQuery($sql);

			if ($result) {
				echo '
					<div class="alert alert-block alert-success fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Success</h4> Password update successfully!</p>
					</div>
					<script> setTimeout(function(){location.reload();}, 2000);</script>
					';
			} else {
				echo '
					<div class="alert alert-block alert-danger fade in">
						<span class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</span>
						<p><h4><i class="fa fa-check-square-o"></i> Failed</h4> Password update failed!</p>
					</div>
					';
			}
		}
	}
?>