<?php
function _display($file,$content=array(),$tplfolder='') {
	global $production_status;
	if(file_exists( load_theme . $tplfolder . strtolower($file) ) && !is_dir( load_theme . $tplfolder . strtolower($file) )) {
		$data = $content;
		include_once( load_theme . $tplfolder . strtolower($file) );
	} else {
		@header('Status: 503 Service Unavailable');
		if($production_status == 'debug') {
			$msg = 'Can not load template file!'.strtolower($file);
			
		} else {
			$msg = 'Can not load template file!';
			
		}
	}
}
/*function _display($file,$content=array()) {
global $production_status;
	if(file_exists( load_theme . $file ) && !is_dir( load_theme . $file )) {
		$data = $content;
		include_once( load_theme . $file );
	} else {
		@header('Status: 503 Service Unavailable');
		if($production_status == 'debug') {
			$msg = 'Can not load template file! '.$file;
			die( site_offline($stats=1,$msg) );
		} else {
			$msg = 'Can not load template file!';
			die( site_offline($stats=1,$msg) );
		}
	}
}*/
?>
