<?php

function _errorPage($status,$msg='') {
	global $header;
	header("HTTP/1.0 404 Not Found");
	$header['content'] = $msg;
	_display('notfound.php',$header);
	return;
}
?>