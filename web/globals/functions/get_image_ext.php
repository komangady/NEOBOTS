<?php
function get_image_ext($type) {
	switch($type) {
		case 'image/gif': $out = '.gif'; break;
		case 'image/jpeg': $out = '.jpg'; break;
		case 'image/pjpeg': $out = '.jpg'; break;
		case 'image/png': $out= '.png'; break;
	}
	return (!isset($out) ? false : $out);
}
?>
