<?php
function _getDesign($file,$content=array()) {
	global $production_status;
	if(file_exists( load_theme . $file ) && !is_dir( load_theme . $file )) {
		$data = $content;
		include_once( load_theme . $file );
	} else {
		_errorPage($status='404');
		/*header('Status: 503 Service Unavailable');
		if($production_status == 'debug') {
			$msg = 'Can not load template file!'.$file;
			
		} else {
			$msg = 'Can not load template file!';
			
		}*/
	}
}

?>

