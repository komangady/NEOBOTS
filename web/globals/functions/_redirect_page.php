<?php
function _redirect_page($url,$txt,$error = '') {
	if(!headers_sent()) 
	{
		switch($error) {
			case '301':
				header("HTTP/1.1 301 Moved Permanently"); 
			break;
			
			case '404':
				header("HTTP/1.0 404 Not Found"); 
			break;
		}
		if(!empty($url)) {
			header("Location: ".$url);
			exit;
		}
	} else {
		print '<h4>'.$txt.'. <a href="'.$url.'" title="Click here to continue">Click here to continue</a>.</h4>';
		return;
	}
}
?>