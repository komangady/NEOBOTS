<?php
function image_error_check($error_code,$file_name,$max_images_size_upload) {
	switch($error_code) {
		case 0: $out = ''; break;
		case 1: $out = 'Error: '.$file_name.' size exceed MAX FILE SIZE in ini.php'; break;
		case 2: $out = 'Error: '.$file_name.' size to big, exceed '.$max_images_size_upload; break;
		case 3: $out = 'Error: '.$file_name.' was only partially uploaded'; break;
		case 4: $out = 'Error: '.$file_name.' No file was uploaded'; break;
		case 6: $out = 'Error: '.$file_name.' can not find a temporary folder'; break;
		case 7: $out = 'Error: '.$file_name.' Failed to write file to disk'; break;
	}
	return $out;
}
?>