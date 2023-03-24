<?php
session_start();
require("trigger.php");
$cookie_name = "log_token";

if(isset($_COOKIE[$cookie_name])) {
	if((!isset($_SESSION['user']) or trim($_SESSION['user']) == '')and(!isset($_SESSION['tipe']) or $_SESSION['tipe']=="")) {
		$sql="	Select * from cookies_history
				inner join user using(id_user)
				where hash_cookies='".$_COOKIE[$cookie_name]."'";
		//echo $sql;
		$result=customQuery($sql);
		$jum=mysql_num_rows($result);
		$hasil=mysql_fetch_array($result);
		
		if($jum>0){
			$_SESSION['tipe']=$hasil['JenisUser'];
			$_SESSION['user']=$hasil['Id_User'];
			
			if($_SESSION['tipe']=='admin'){
				$query="SELECT * FROM admin where id_admin='".$_SESSION['user']."'";
				$cst=customQuery($query);
				$hasil=mysql_fetch_array($cst);
				$_SESSION['nama']=$hasil['nama'];
				$_SESSION['img']=$hasil['foto'];
			}else if($_SESSION['tipe']=='pegawai'){
				$query="SELECT * FROM pegawai where nip='".$_SESSION['user']."'";
				$cst=customQuery($query);
				$hasil=mysql_fetch_array($cst);
				$_SESSION['nama']=$hasil['nama'];
				$_SESSION['img']=$hasil['foto'];
			}	
			
			if(isset($_GET['rt']) && !empty($_GET['rt']) && isset($_GET['ctl']) && !empty($_GET['ctl'])) {
					if(file_exists(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php')) {
						require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php');
						if((function_exists($_GET['prog'])) && ($_GET['rt']==$_SESSION['tipe'])) {
							call_user_func($_GET['prog'],'');
						} else {
							header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
						}
					} else {
						header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
					}		
			} else {
					header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
			}
		}else{
			unset($_COOKIE[$cookie_name]);
			// empty value and expiration one hour before
			$res = setcookie($cookie_name, '', time() - 3600);
			
			if(isset($_GET['rt']) && !empty($_GET['rt']) && isset($_GET['ctl']) && !empty($_GET['ctl'])) {
				if(file_exists(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php')) {
					require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php');
					if(function_exists($_GET['prog'])) {
						call_user_func($_GET['prog'],'');
					} else {
						header('Location: '.site_root.'?rt=login&ctl=ctl&prog=mlogin');
					}
				} else {
					header('Location: '.site_root.'?rt=login&ctl=ctl&prog=mlogin');
				}		
			} else {
				header('Location: '.site_root.'?rt=login&ctl=ctl&prog=mlogin');
			}
		}
	}else{
		if(isset($_GET['rt']) && !empty($_GET['rt']) && isset($_GET['ctl']) && !empty($_GET['ctl'])) {
				if(file_exists(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php')) {
					require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php');
					if((function_exists($_GET['prog'])) && ($_GET['rt']==$_SESSION['tipe'])) {
						call_user_func($_GET['prog'],'');
					} else if((function_exists($_GET['prog'])) && (($_GET['rt']=='login')||($_GET['rt']=='umum'))){
						call_user_func($_GET['prog'],'');
					}
					else {
						header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
					}
				} else {
					header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
				}		
		} else {
				header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
		}
	}
}else{
	if((!isset($_SESSION['user']) or trim($_SESSION['user']) == '')and(!isset($_SESSION['tipe']) or $_SESSION['tipe']=="")) {
		unset($_COOKIE[$cookie_name]);
		// empty value and expiration one hour before
		$res = setcookie($cookie_name, '', time() - 3600);
		
		if(isset($_GET['rt']) && !empty($_GET['rt']) && isset($_GET['ctl']) && !empty($_GET['ctl'])) {
			if(file_exists(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php')) {
				require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php');
				
				if(function_exists($_GET['prog'])) {
					call_user_func($_GET['prog'],'');
				} else {
					header('Location:'.site_root.'?rt=login&ctl=ctl&prog=mlogin');
				}
			} else {
				header('Location: '.site_root.'?rt=login&ctl=ctl&prog=mlogin');
			}		
		} else {
			header('Location: '.site_root.'?rt=login&ctl=ctl&prog=mlogin');
		}
	}else{
		if(isset($_GET['rt']) && !empty($_GET['rt']) && isset($_GET['ctl']) && !empty($_GET['ctl'])) {
				if(file_exists(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php')) {
					require_once(PATH_MODULES.'/'.$_GET['rt'].'/'.$_GET['ctl'].'.php');
					if((function_exists($_GET['prog'])) && ($_GET['rt']==$_SESSION['tipe'])) {
						call_user_func($_GET['prog'],'');
					}else if((function_exists($_GET['prog']))  && (($_GET['rt']=='login')||($_GET['rt']=='umum'))){
						call_user_func($_GET['prog'],'');
					} 
					else {
						header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
					}
				} else {
					header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
				}		
		} else {
				header('Location: '.site_root.'?rt='.$_SESSION['tipe'].'&ctl=ctl&prog=mp');
		}
	}
}

unset($data);
ob_end_flush();
exit;
?>