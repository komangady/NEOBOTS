<?php  
	function vlogin()
{
	$data = array();
	$data['namefield'][] = 'username';
	if(empty($_POST['username'])) { 
		$data['statusfield'][] = false; 
		$data['msg'][] = 'Masukkan Username';
	}else{
		$data['statusfield'][] = true;
		$data['msg'][] = '';
		
	}
	$data['namefield'][] = 'password';
	if(empty($_POST['password'])) { 
		$data['statusfield'][] = false; 
		$data['msg'][] = 'Masukkan Password';
	}else{
		$data['statusfield'][] = true;
		$data['msg'][] = ''; 
 
	}
	$data['namefield'][] = 'errorsdata';
	if(empty($_POST['username']) or empty($_POST['password'])) { 
		$data['statusfield'][] = false; 
		$data['msg'][] = 'Data belum lengkap';
	}else{
		$usernamenya = TagEncode($_POST['username']);
		$password = md5($_POST['password']);
		$sqluser = "SELECT * FROM user WHERE Username='".$usernamenya."' AND Password='".$password."'";
		$cstuser = customQuery($sqluser);
		$datauser = mysql_num_rows($cstuser);
		$hasil = mysql_fetch_array($cstuser);
		
		if($datauser != 0){
			
			if($hasil['JenisUser'] == 'operator')
			{
				$query="SELECT * FROM tb_operator where id_operator='".$usernamenya."'";
				$cst=customQuery($query);
				$hasil=mysql_fetch_array($cst);
				if($hasil["status_operator"] == '0')
				{
					$data['statusfield'][] = false; 
					$data['msg'][] = '<center>Akun anda sudah tidak aktif<br>Silahkan hubungi admin </center>';
				}
				else
				{
					$data['statusfield'][] = true;
					$data['msg'][] = '';
				}
			}
			else
			{
				$data['statusfield'][] = true;
				$data['msg'][] = '';
			}
		}else{
			$data['statusfield'][] = false; 
			$data['msg'][] = 'Username atau Password Salah';
		} 
	}
	
	if(in_array(false, $data['statusfield'])) {
		return _display('error.php',$content=$data); 
	}else{
			
			$query="SELECT * FROM user where Username='".$usernamenya."' and Password='".$password."'";
			$cst=customQuery($query);
			$hasil=mysql_fetch_array($cst);
			$_SESSION['tipe']=$hasil['JenisUser'];
			$_SESSION['user']=$hasil['Id_User'];
			$_SESSION['username']=$hasil['Username'];
			
			if($_SESSION['tipe']=='admin'){
				$query="SELECT * FROM admin where id_admin='".$_SESSION['user']."'";
				$cst=customQuery($query);
				$hasil=mysql_fetch_array($cst);
				$_SESSION['nama']=$hasil['nama'];
				$_SESSION['img']=$hasil['foto'];
			}else if($_SESSION['tipe']=='operator'){
				$query="SELECT * FROM tb_operator where id_operator='".$_SESSION['user']."'";
				$cst=customQuery($query);
				$hasil=mysql_fetch_array($cst);
				$_SESSION['nama']=$hasil['operator_name'];
				$_SESSION['img']=$hasil['operator_image'];
			}	
			
			if((isset($_POST['ingat'])) && (!empty($_POST['ingat']))){
				
				$cookie_name = "log_token";
				$rnd=substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'),0,15);
				$date=date('Y-m-d H:i:s');
				
				$id=$date.$_SESSION['user'].$rnd;
				$hash=md5($id);
				$sql="	insert into cookies_history(Cookies_ID,id_user,random_char,hash_cookies, waktu)
						values('".$id."','".$_SESSION['user']."','".$rnd."','".$hash."','".$date."')
				";
				
				$result=customQuery($sql);
				
				$cookie_value =$hash;
				$domain=site_root;
				setcookie($cookie_name, $cookie_value, time() + (86400 * 30), $domain);

			}
			
			echo'
			<script type="text/javascript">
				$(window.location).attr(\'href\',\''.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp\');
			</script>
			';
	}	  
}
?>