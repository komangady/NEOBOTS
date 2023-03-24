<?php
function aktifitasUser($txt,$lvl){
	$table = 't_alumni_aktifitas';
	$field = "user_aktifitas,desc_aktifitas,tgl_time_aktifitas,user_level";
	$isi = "'".$_SESSION['username_logged']."','".$txt."','".date("Y-m-d H:m:s")."','".$lvl."'";
	$simpan = safeInsert($table,$field,$isi);
	
}
?>