<?php
function redirect_error_status($status) {
			switch($status) {
			case 403:
				$stat = 'HTTP/1.0 403 Forbidden';
				break;
			case 404:
				$stat = 'HTTP/1.0 404 File Not Found';
				break;
			default:
				$stat = 'HTTP/1.0 500 Internal Server Error';
				break;
			}
	if(!headers_sent()) {
		header($stat);
		exit;
	} else {
		print '<h4>'.$stat.'</h4>';
	}
}
?>