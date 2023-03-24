<?php
function fileDelete($filepath,$filename) {
	if (file_exists($filepath.$filename)&&$filename!=""&&$filename!="n/a") {
		unlink ($filepath.$filename);
		return TRUE;	
	}else{
		return FALSE;
	}
}
?>